<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Checkout;
use Xendit\Configuration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Xendit\Invoice\CreateInvoiceRequest;

class HomeController extends Controller
{
    public function landing()
    {
        $data = [
            'title' => 'FreezeMart | Belanja Ceria, Semua Ada di Sini!',
            'categories' => Category::all(),
            'products' => Product::limit(12)->get(),
        ];
        if (Auth::check()) {
            $data['carts'] = Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get();
        }
        return view('landing', $data);
    }

    public function products()
    {
        $products = Product::query();

        $data = [
            'title' => 'FreezeMart | Produk Terbaik yang Kami Tawarkan',
            'products' => $products->filter(request(['search', 'categories', 'sort_by']))->paginate(8)->appends(request()->all()),
            'categories' => Category::all(),
        ];
        if (Auth::check()) {
            $data['carts'] = Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get();
        }
        return view('products.index', $data);
    }

    public function showProduct(Product $product)
    {
        $totalComments = Comment::where('product_id', $product->id)->count();

        $comments = Comment::where('product_id', $product->id)
            ->whereNull('parent_id') // Hanya ambil komentar utama
            ->latest()
            ->paginate(6); // Paginate 3 komentar per halaman

        $data = [
            'title' => 'FreezeMart | Produk Terbaik yang Kami Tawarkan',
            'product' => $product,
            'products' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->get(),
            'comments' => $comments,
            'totalComments' => $totalComments,
        ];

        if (Auth::check()) {
            // Untuk dropdown cart, batasi hanya 5 item saja
            $data['carts'] = Cart::with('product')
                ->where('user_id', request()->user()->id)
                ->latest()
                ->limit(5)
                ->get();

            // Dapatkan total item di cart untuk badge
            $data['cartCount'] = Cart::where('user_id', request()->user()->id)->count();

            $data['carts'] = Cart::with(['product'])
                ->where('user_id', request()->user()->id)
                ->latest()
                ->limit(10)
                ->get();
        }

        return view('products.show', $data);
    }


    public function carts()
    {
        $data = [
            'title' => 'FreezeMart | Produk di Keranjang Anda',
            // Data untuk dropdown (header) batasi hanya 5 item
            'carts'    => Cart::with('product')
                ->where('user_id', request()->user()->id)
                ->latest()
                ->limit(5)
                ->get(),
            // Data lengkap untuk tampilan halaman cart
            'myCarts'  => Cart::with('product')
                ->where('user_id', request()->user()->id)
                ->latest()
                ->get(),
            // Total item di cart untuk badge
            'cartCount' => Cart::where('user_id', request()->user()->id)->count()

        ];
        return view('carts.index', $data);
    }

    public function addToCart(Product $product)
    {
        Cart::create([
            'user_id' => Auth::user()->id, // tergantung yg login
            'product_id' => $product->id
        ]);
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function removeCart(Cart $cart)
    {
        Cart::where('user_id', Auth::user()->id)->where('id', $cart->id)->delete();
        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function buyFromCart(Request $request)
    {
        $products = Product::whereIn('slug', $request->products)
            ->orderByRaw("FIELD(slug, '" . implode("','", $request->products) . "')")
            ->get();
        $quantities = $request->quantities;

        // hitung hitungan
        $emailPart = explode('@', Auth::user()->email)[0];
        $externalId = 'invoice-' . $emailPart . '-' . Str::uuid() . '-' . time();
        $admin = 2000;
        $amount = $admin;
        $qtyAmount = 0;
        $indexQty = 0;
        $items = [];
        $orders = [];

        foreach ($products as $product) {
            $amount += $product->price * $quantities[$indexQty];
            $qtyAmount += $quantities[$indexQty];

            $items[] = [
                "name" => $product->name,
                "quantity" => $quantities[$indexQty],
                "price" => $product->price,
                "category" => $product->category->name,
                "url" => env('APP_URL') . "/products/$product->slug"
            ];

            $orders[] = [
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $quantities[$indexQty],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            $indexQty++;
        }

        // setting xenditnya supaya bisa dipake
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
        $invoiceApi = new InvoiceApi();

        // set parameter yang dikirim
        $invoiceRequest = new CreateInvoiceRequest([
            'external_id' => $externalId,
            'amount' => $amount,
            'currency' => 'IDR',
            'description' => 'Pembelian produk sebanyak ' . $qtyAmount . ', dengan total harga Rp ' . number_format($amount, 2, ',', '.'),
            'customer' => [
                'given_names' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'success_redirect_url' => env('APP_URL') . "/success/$externalId",
            'failure_redirect_url' => env('APP_URL') . "/failure/$externalId",
            'items' => $items,
            'fees' => [
                [
                    'type' => 'ADMIN',
                    'value' => $admin,
                ]
            ]
        ]);

        // lakukan uji coba
        try {
            // tarik resultnya
            $result = $invoiceApi->createInvoice($invoiceRequest);

            // bikin data checkout
            $checkout = Checkout::create([
                'user_id' => Auth::user()->id,
                'service' => $admin,
                'price_total' => $amount,
                'checkout_link' => $result['invoice_url'],
                'external_id' => $externalId,
                'status' => $result['status']
            ]);

            // store data orders + ambil id checkout
            foreach ($orders as $order) {
                $order['checkout_id'] = $checkout->id;
                Order::create($order);
            }

            // redirect
            return redirect($result['invoice_url']);
        } catch (\Xendit\XenditSdkException $e) {
            return redirect("/failure/$externalId");
        }
    }


    public function success($checkout)
    {
        // setting xenditnya supaya bisa dipake
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
        $invoiceApi = new InvoiceApi();

        // get invoice berdasarkan external_id
        $result = $invoiceApi->getInvoices(null, $checkout);
        // ubah status checkout
        Checkout::where('external_id', $checkout)->update([
            'status' => $result[0]['status']
        ]);

        // cart nya kita hapus
        // pilih checkout
        $checkout = Checkout::where('external_id', $checkout)->first();
        // dapetin mana yg diorder
        $orders = Order::where('checkout_id', $checkout->id)->get();
        foreach ($orders as $order) {
            Cart::where('user_id', Auth::user()->id)->where('product_id', $order->product_id)->delete();
        }

        return view('payments.success', [
            'title' => 'FreezeMart | Pesanan Anda Berhasil'
        ]);
    }

    public function failure($checkout)
    {
        return view('payments.failure', [
            'title' => 'FreezeMart | Pesanan Anda Gagal'
        ]);
    }

    public function checkouts()
    {
        $data = [
            'title' => 'Pembelian Anda',
            'carts' => Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get(),
            'checkouts' => Checkout::where('user_id', Auth::user()->id)->latest()->get()
        ];
        return view('checkouts.index', $data);
    }

    public function login()
    {
        return view('login', [
            'title' => 'FreezeMart | Masuk ke Akun Anda'
        ]);
    }

    public function actionLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika user adalah admin, redirect ke dashboard admin
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            // Kirim pesan sukses setelah login
            session()->flash('message', 'Selamat datang, ' . Auth::user()->name . '! Anda berhasil login.');


            // Jika user biasa, redirect ke home
            return redirect('/');
        }

        return back()->with('status', 'Login Gagal!. Harap periksa kembali email dan password');
    }

    public function register()
    {
        return view('register', [
            'title' => 'FreezeMart | Daftar Akun FreezeMart'
        ]);
    }

    public function actionRegister(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:255',
            'password_confirm' => 'required|min:8|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        // Kirim pesan sukses setelah register
        session()->flash('message', 'Akun berhasil dibuat. Selamat datang, ' . $user->name . '!');


        return redirect('/');
    }

    public function actionLogout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Kirim pesan sukses setelah logout
        session()->flash('message', 'Anda berhasil logout.');

        return redirect('/');
    }

    public function profile()
    {
        $user = Auth::user();
        $title = 'FreezeMart | Profile Akun Anda';

        return view('profile', compact('user', 'title'));
    }

    public function actionComments(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'comment_text' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id' // Validasi parent_id jika ada
        ]);

        // Simpan komentar baru
        Comment::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'comment_text' => $request->comment_text,
            'parent_id' => $request->parent_id // Menyimpan parent_id jika ini reply
        ]);

        // Ambil slug produk berdasarkan product_id
        $product = Product::findOrFail($request->product_id);

        return redirect('/products/' . $product->slug)
            ->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function comments(Product $product)
    {
        $comments = Comment::where('product_id', $product->id)
            ->latest()
            ->get()
            ->map(
                function ($comment) {
                    $comment->formatted_date = Carbon::parse($comment->created_at)->translatedFormat('d F Y');
                    return $comment;
                }
            );

        $data = [
            'title' => 'FreezeMart | Produk Terbaik yang Kami Tawarkan',
            'product' => $product,
            'products' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->get(),
            'comments' => $comments
        ];

        if (Auth::check()) {
            $data['carts'] = Cart::with(['product'])
                ->where('user_id', request()->user()->id)
                ->latest()
                ->limit(10)
                ->get();
        }

        return view('comments.index', $data);
    }
}
