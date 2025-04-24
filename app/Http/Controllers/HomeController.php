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
use Illuminate\Auth\Events\PasswordReset;
use Xendit\Configuration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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

        $data = [
            'title' => 'FreezeMart | Produk Terbaik yang Kami Tawarkan',
            'product' => $product,
            'products' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->get(),
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
        // Cart::where('user_id', Auth::user()->id)->where('id', $cart->id)->delete();
        Cart::where('user_id', Auth::id())
            ->where('product_id', $cart->product_id)
            ->delete();
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

        // cart nya dihapus
        // pilih checkout
        $checkout = Checkout::where('external_id', $checkout)->first();

        // Ambil semua order berdasarkan checkout_id
        $orders = Order::where('checkout_id', $checkout->id)->get();

        // Loop setiap order dan kurangi stok produk
        foreach ($orders as $order) {
            $product = Product::find($order->product_id);
            if ($product) {
                $product->quantity -= $order->quantity; // Kurangi stok produk
                $product->save();
            }

            // Hapus produk dari cart setelah pembayaran sukses
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

        // Periksa apakah checkbox 'remember' dicentang
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) { // Tambahkan $remember
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

        return back()->withErrors('status', 'Login Gagal!. Harap periksa kembali email dan password');
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
            'password' => [
                'required',
                'min:8',
                'max:255',
                // Hanya izinkan huruf, angka, dan beberapa simbol umum.
                'regex:/^[A-Za-z0-9!@#$%^*()_+\-=\[\]{};:"\\|,.<>\/?]*$/'
            ],
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

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
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

    public function history(Request $request)
    {
        $status = $request->query('status', 'unpaid'); // Default to 'unpaid' if no status provided

        // Validate status
        $validStatuses = ['unpaid', 'paid', 'processing', 'shipped', 'completed'];
        if (!in_array($status, $validStatuses)) {
            $status = 'unpaid'; // Default to 'unpaid' if invalid status
        }

        $data = [
            'title' => 'Riwayat Pembelian Anda',
            'carts' => Cart::with(['product'])
                ->where('user_id', request()->user()->id)
                ->latest()
                ->limit(10)
                ->get(),
            'orders' => Order::whereHas('checkout', function ($query) use ($status) {
                $query->where('user_id', Auth::user()->id)
                    ->where('status', $status);
            })->with('checkout', 'product')
                ->latest()
                ->get(),
            'status' => $status
        ];

        return view('history.index', $data);
    }
}
