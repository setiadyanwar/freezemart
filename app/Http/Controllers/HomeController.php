<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Faq;
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
use App\Models\Personalization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Xendit\Invoice\CreateInvoiceRequest;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\PersonalizationDetail;

class HomeController extends Controller
{
    private function getFrequentlyBoughtProducts()
    {
        $recommendedProductIds = DB::table('orders as o1')
            ->join('orders as o2', 'o1.checkout_id', '=', 'o2.checkout_id')
            ->whereColumn('o1.product_id', '!=', 'o2.product_id')
            ->select('o2.product_id', DB::raw('COUNT(*) as frequency'))
            ->groupBy('o2.product_id')
            ->orderByDesc('frequency')
            ->limit(10)
            ->pluck('o2.product_id');

        return Product::whereIn('id', $recommendedProductIds)->get();
    }

    private function getAlsoBoughtProducts($productId)
    {
        $relatedProductIds = DB::table('orders as o1')
            ->join('orders as o2', 'o1.checkout_id', '=', 'o2.checkout_id')
            ->where('o1.product_id', $productId)
            ->where('o2.product_id', '!=', $productId)
            ->select('o2.product_id', DB::raw('COUNT(*) as frequency'))
            ->groupBy('o2.product_id')
            ->orderByDesc('frequency')
            ->limit(8)
            ->pluck('o2.product_id');

        return Product::whereIn('id', $relatedProductIds)->get();
    }


    public function landing()
    {
        $data = [
            'title' => 'FreezeMart | Belanja Ceria, Semua Ada di Sini!',
            'categories' => Category::all(),
            'products' => Product::with('comments')->limit(12)->get(),
            'recommended' => [], // Default kosong
        ];

        if (Auth::check()) {
            $user = Auth::user();

            // Ambil histori pembelian user
            $historiProduk = Product::whereIn('id', function ($query) use ($user) {
                $query->select('product_id')
                    ->from('orders')
                    ->join('checkouts', 'orders.checkout_id', '=', 'checkouts.id')
                    ->where('checkouts.user_id', $user->id);
            })->get();

            // Ambil personalisasi yang terbaru
            $latestPersonalization = Personalization::where('user_id', $user->id)
                ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu terbaru
                ->first();

            // Jika ada personalisasi, ambil rekomendasi berdasarkan input terbaru
            if ($latestPersonalization) {
                $recommendedIds = json_decode($latestPersonalization->recommended_ids);

                // Ambil produk yang direkomendasikan
                $recommendedProducts = Product::with('comments')->whereIn('id', $recommendedIds)->get();

                // Gabungkan produk yang relevan, pertama yang dibeli terakhir
                $relevantProducts = $recommendedProducts->merge($historiProduk)
                    ->unique('id') // Pastikan produk yang sama hanya muncul sekali
                    ->sortByDesc(function ($product) use ($historiProduk) {
                        // Menambahkan logika untuk memprioritaskan produk yang relevan dengan pembelian terakhir
                        return $historiProduk->pluck('id')->contains($product->id) ? 1 : 0;
                    })
                    ->values(); // Mengatur ulang index setelah merge

                // Menyimpan rekomendasi terbaru ke dalam data
                $data['recommended'] = $relevantProducts;
            }

            // Cart tetap dimuat
            $data['carts'] = Cart::with(['product'])->where('user_id', $user->id)->latest()->limit(10)->get();
        }

        return view('landing', $data);
    }

    public function products()
    {
        $products = Product::with('comments'); // Menambahkan with untuk comments

        $data = [
            'title' => 'FreezeMart | Produk Terbaik yang Kami Tawarkan',
            'products' => $products->filter(request(['search', 'categories', 'sort_by']))
                ->paginate(8)
                ->appends(request()->all()), // Semua dalam satu baris
            'categories' => Category::all(),
        ];

        // Menambahkan data cart jika pengguna sudah login
        if (Auth::check()) {
            $data['carts'] = Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get();
        }

        return view('products.index', $data);
    }


    public function showProduct(Product $product)
    {
        // Data dasar
        $data = [
            'title' => 'FreezeMart | Produk Terbaik yang Kami Tawarkan',
            'product' => $product,
            'products' => $this->getAlsoBoughtProducts($product->id),
        ];

        // Ambil average rating & total review
        $ratingData = DB::table('comments')
            ->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_reviews')
            ->where('product_id', $product->id)
            ->first();

        $data['average_rating'] = round($ratingData->average_rating ?? 0, 1);
        $data['total_reviews'] = $ratingData->total_reviews ?? 0;

        // Ambil distribusi rating untuk rating bar
        $ratingCounts = DB::table('comments')
            ->select('rating', DB::raw('COUNT(*) as count'))
            ->where('product_id', $product->id)
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        $total = array_sum($ratingCounts);
        $ratingPercentages = [];

        for ($i = 5; $i >= 1; $i--) {
            $count = $ratingCounts[$i] ?? 0;
            $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
            $ratingPercentages[$i] = [
                'count' => $count,
                'percentage' => $percentage,
            ];
        }

        $data['ratingBars'] = $ratingPercentages;

        // Ambil komentar dengan relasi user, dan paginasi 10 per halaman
        $comments = Comment::with('user')
            ->where('product_id', $product->id)
            ->latest()
            ->paginate(10); // paginate sesuai kebutuhan

        $data['comments'] = $comments;

        // Jika user login, ambil data cart
        if (Auth::check()) {
            $data['carts'] = Cart::with('product')
                ->where('user_id', request()->user()->id)
                ->latest()
                ->limit(5)
                ->get();

            $data['cartCount'] = Cart::where('user_id', request()->user()->id)->count();
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

    // public function buyFromCart(Request $request)
    // {
    //     $products = Product::whereIn('slug', $request->products)
    //         ->orderByRaw("FIELD(slug, '" . implode("','", $request->products) . "')")
    //         ->get();
    //     $quantities = $request->quantities;

    //     // hitung hitungan
    //     $emailPart = explode('@', Auth::user()->email)[0];
    //     $externalId = 'invoice-' . $emailPart . '-' . Str::uuid() . '-' . time();
    //     $admin = 2000;
    //     $amount = $admin;
    //     $qtyAmount = 0;
    //     $indexQty = 0;
    //     $items = [];
    //     $orders = [];

    //     foreach ($products as $product) {
    //         $amount += $product->price * $quantities[$indexQty];
    //         $qtyAmount += $quantities[$indexQty];

    //         $items[] = [
    //             "name" => $product->name,
    //             "quantity" => $quantities[$indexQty],
    //             "price" => $product->price,
    //             "category" => $product->category->name,
    //             "url" => config('app.url') . "/products/$product->slug"
    //         ];

    //         $orders[] = [
    //             'product_id' => $product->id,
    //             'price' => $product->price,
    //             'quantity' => $quantities[$indexQty],
    //             'created_at' => Carbon::now(),
    //             'updated_at' => Carbon::now()
    //         ];

    //         $indexQty++;
    //     }

    //     // setting xendit supaya bisa dipake
    //     Configuration::setXenditKey('');
    //     $invoiceApi = new InvoiceApi();

    //     // set parameter yang dikirim
    //     $invoiceRequest = new CreateInvoiceRequest([
    //         'external_id' => $externalId,
    //         'amount' => $amount,
    //         'currency' => 'IDR',
    //         'description' => 'Pembelian produk sebanyak ' . $qtyAmount . ', dengan total harga Rp ' . number_format($amount, 2, ',', '.'),
    //         'customer' => [
    //             'given_names' => Auth::user()->name,
    //             'email' => Auth::user()->email,
    //         ],
    //         'success_redirect_url' => config('app.url') . "/success/$externalId",
    //         'failure_redirect_url' => config('app.url') . "/failure/$externalId",
    //         'items' => $items,
    //         'fees' => [
    //             [
    //                 'type' => 'ADMIN',
    //                 'value' => $admin,
    //             ]
    //         ]
    //     ]);

    //     // lakukan uji coba
    //     try {
    //         // tarik resultnya
    //         $result = $invoiceApi->createInvoice($invoiceRequest);

    //         // bikin data checkout
    //         $checkout = Checkout::create([
    //             'user_id' => Auth::user()->id,
    //             'service' => $admin,
    //             'price_total' => $amount,
    //             'checkout_link' => $result['invoice_url'],
    //             'external_id' => $externalId,
    //             'status' => $result['status']
    //         ]);

    //         // store data orders + ambil id checkout
    //         foreach ($orders as $order) {
    //             $order['checkout_id'] = $checkout->id;
    //             Order::create($order);
    //         }

    //         // redirect
    //         return redirect($result['invoice_url']);
    //     } catch (\Xendit\XenditSdkException $e) {


    //         return redirect("/failure/$externalId");
    //     }
    // }
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
                "category" => optional($product->category)->name ?? 'Uncategorized',
                "url" => config('app.url') . "/products/$product->slug"
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

        // setting xendit supaya bisa dipake
        Configuration::setXenditKey(config('services.xendit.secret'));
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
            'success_redirect_url' => config('app.url') . "/success/$externalId",
            'failure_redirect_url' => config('app.url') . "/failure/$externalId",
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
            // Tangkap error dan tampilkan
            // Bisa gunakan dd() untuk debug atau log error
            dd($e->getMessage()); 
            dd('General Error: ' . $e->getMessage());

            // Atau log error
            // Log::error('Xendit Error: ' . $e->getMessage());

            // Anda masih bisa mengalihkan user ke halaman failure jika perlu
            // return redirect("/failure/$externalId");
        }
    }


    public function success($checkout)
    {
        // Setting Xendit
        Configuration::setXenditKey(config('services.xendit.secret'));
        $invoiceApi = new InvoiceApi();


        // Get invoice berdasarkan external_id
        $result = $invoiceApi->getInvoices(null, $checkout);

        // Update status checkout dengan e-wallet yang dipilih
        Checkout::where('external_id', $checkout)->update([
            'status' => $result[0]['status'],
            'payment_method' => $result[0]['payment_method']
        ]);

        // Pilih checkout
        $checkout = Checkout::where('external_id', $checkout)->first();

        // Update shipment_status semua order jadi 'packed'
        Order::where('checkout_id', $checkout->id)
            ->update(['shipment_status' => 'Packed']);

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
            Cart::where('user_id', Auth::id())
                ->where('product_id', $order->product_id)
                ->delete();
        }

        return view('payments.success', [
            'title' => 'FreezeMart | Pesanan Anda Berhasil',
            'checkout' => $checkout
        ]);
    }


    public function failure($checkout)
    {
        return view('payments.failure', [
            'title' => 'FreezeMart | Pesanan Anda Gagal'
        ]);
    }

    public function faq()
    {
        $data = [
            'title' => 'Freezemart | FAQ',
            'faqs' => Faq::latest()->get(),
        ];
        return view('faq.index', $data);
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

        return redirect()->back()->withErrors([
            'status' => 'Login Gagal! Harap periksa kembali email dan password.',
        ]);

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
            'phone' => 'required|numeric|digits_between:11,13',
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
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        // Kirim pesan sambutan dari admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->sendMessageTo($user, 'Welcome di Freezemart! Kalau ada yang bikin bingung atau mau tanya-tanya, feel free buat hubungi kami ya 👋');
        }

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

        $data = [
            'title' => 'FreezeMart | Profil Pengguna',
            'user' => $user,
            // Misalnya menampilkan checkout yang pernah dilakukan
            'checkouts' => Checkout::where('user_id', $user->id)->latest()->get(),
            'orders' => Order::with('product')->whereIn('checkout_id', function ($query) use ($user) {
                $query->select('id')
                    ->from('checkouts')
                    ->where('user_id', $user->id);
            })->latest()->get(),
        ];

        return view('profile', $data);
    }

    public function history(Request $request)
    {
        $validStatuses = ['unpaid', 'packed', 'shipped', 'completed'];
        $status = strtolower($request->query('status')) ?? 'unpaid';

        if (!in_array($status, $validStatuses)) {
            $status = 'unpaid';
        }

        $orders = Order::whereHas('checkout', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->where('shipment_status', ucfirst($status)) // 'Packed', 'Shipped', etc (huruf besar)
            ->with([
                'checkout',
                'product.comments' => function ($query) {
                    $query->where('user_id', Auth::id());
                }
            ])
            ->latest()
            ->get()
            ->groupBy(fn($order) => $order->created_at->format('Y-m-d H:i'));

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->limit(10)
            ->get();

        $data = [
            'title'         => 'Riwayat Pembelian',
            'carts'         => $carts,
            'groupedOrders' => $orders,
            'status'        => $status,
        ];

        return view('history.index', $data);
    }


    public function actionComments(Request $request)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string|max:1000',
            'product_id' => 'required|exists:products,id',
        ]);

        // Simpan comment
        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'comment_text' => $request->description,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function personalize(Request $request)
    {
        $user = Auth::user();
        $inputText = $request->input('input');
        $priceFilter = $request->input('price'); // lt50, 50to100, gt100

        // Ubah filter harga jadi angka
        $hargaMaks = match ($priceFilter) {
            'lt50' => 50000,
            '50to100' => 100000,
            'gt100' => PHP_INT_MAX,
            default => PHP_INT_MAX
        };

        // Ambil produk dari database
        $produk = Product::select('id', 'name', 'description', 'price', 'image')->get()->toArray();

        // Ambil histori pembelian user (via orders -> checkouts)
        $historiProduk = Product::whereIn('id', function ($query) use ($user) {
            $query->select('product_id')
                ->from('orders')
                ->join('checkouts', 'orders.checkout_id', '=', 'checkouts.id')
                ->where('checkouts.user_id', $user->id);
        })->get();

        // Bangun profil teks dari histori pembelian
        // Cek apakah histori produk tidak kosong
        $profilPengguna = $historiProduk->isNotEmpty()
            ? $historiProduk->map(function ($p) {
                return $p->description . ' ' . $p->name . ' Rp' . $p->price;
            })->implode('. ')
            : ''; // Jika kosong, profil pengguna di-set kosong

        // Kirim ke Flask API untuk mendapatkan rekomendasi produk
        $response = Http::post('http://127.0.0.1:5001/recommend', [
            'produk' => $produk,
            'input_teks' => $inputText,
            'harga_maks' => $hargaMaks,
            'user_profile' => $profilPengguna, // Data profil pengguna
        ]);

        // Jika API Flask tidak berhasil
        if (!$response->successful()) {
            return back()->with('error', 'Gagal mengambil rekomendasi. Coba lagi nanti.');
        }

        // Ambil hasil rekomendasi dari API Flask
        $recommended = $response->json();

        $recommendedIds = collect($recommended)->pluck('id')->toArray();

        // Ambil produk yang direkomendasikan dari database
        $similarityMap = collect($recommended)->mapWithKeys(function ($item) {
            return [$item['id'] => $item['similarity']];
        });

        $recommendedProducts = Product::with('comments')
            ->whereIn('id', $recommendedIds)
            ->get()
            ->map(function ($product) use ($similarityMap) {
                $product->similarity = $similarityMap[$product->id] ?? null;
                return $product;
            })
            ->sortByDesc('similarity') // ⬅️ sort dari similarity paling tinggi
            ->values(); // reset index (optional, supaya clean);


        // Simpan personalisasi di database
        $personalization = Personalization::create([
            'user_id' => $user->id,
            'input_text' => $inputText,
            'user_profile' => $profilPengguna ?? '', // Fallback profil pengguna jika kosong
            'recommended_ids' => json_encode($recommendedIds),
            'price_filter' => $hargaMaks,
        ]);

        // Simpan detail similarity ke personalization_details
        foreach ($recommended as $item) {
            PersonalizationDetail::create([
                'personalization_id' => $personalization->id,
                'product_id' => $item['id'],
                'similarity' => $item['similarity'],
            ]);
        }

        // Return hasil rekomendasi ke tampilan
        return view('landing', [
            'title' => 'Freezemart | Hasil Rekomendasi',
            'products' => Product::with('comments')->filter(request(['categories']))->limit(10)->get(),
            'recommended' => $recommendedProducts,
            'categories' => Category::all()
        ]);
    }
}
