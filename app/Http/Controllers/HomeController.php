<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Xendit\Configuration;

class HomeController extends Controller
{
    public function landing()
    {
        $data = [
            'title' => 'FreezeMart | Belanja Ceria, Semua Ada di Sini!',
            'categories' => Category::all(),
            'products' => Product::limit(12)->get(),
        ];
        return view('landing', $data);
    }

    public function products(Request $request)
    {
        $products = Product::query();
        if ($request->has('search') && $request->search !== '') {
            $products->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('categories') && is_array($request->categories)) {
            $products->whereHas('category', function ($q) use ($request) {
                $q->whereIn('slug', $request->categories);
            });
        }
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $products->orderBy('created_at', 'asc');
                    break;
                case 'cheapest':
                    $products->orderBy('price', 'asc');
                    break;
                case 'expensive':
                    $products->orderBy('price', 'desc');
                    break;
            }
        } else {
            // Default sorting
            $products->orderBy('created_at', 'desc');
        }

        $data = [
            'title' => 'BelanjaRia | Produk Terbaik yang Kami Tawarkan',
            'products' => $products->get(),
            'categories' => Category::all(),
        ];
        return view('products.index', $data);
    }

    public function showProduct(Product $product)
    {
        $data = [
            'title' => 'BelanjaRia | Produk Terbaik yang Kami Tawarkan',
            'product' => $product,
            'products' => Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get()
        ];
        if (Auth::check()) {
            $data['carts'] = Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get();
        }
        return view('products.show', $data);
    }



    public function login()
    {
        return view('login', [
            'title' => 'BelanjaRia | Masuk ke Akun Anda'
        ]);
    }

    public function register()
    {
        return view('register', [
            'title' => 'BelanjaRia | Daftar Akun BelanjaRia'
        ]);
    }




}
