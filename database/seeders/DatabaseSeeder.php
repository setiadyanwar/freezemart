<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Data dummy user

        User::insert([
            [
                'name' => 'Admin FreezeMart',
                'email' => 'admin@test.com',
                'password' => bcrypt('admin'),
                'address' => 'Yogyakarta',
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Setiady Anwar',
                'email' => 'setiady@test.com',
                'password' => bcrypt('password'),
                'address' => 'Lampung',
                'role' => 'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jons',
                'email' => 'jons@test.com',
                'password' => bcrypt('password'),
                'address' => 'Bogor',
                'role' => 'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        Category::insert([
            [
                'name' => 'Makanan Beku Olahan',
                'slug' => Str::slug('Makanan Beku Olahan'),
                'path' => 'category/makanan-beku-olahan.svg',
            ],
            [
                'name' => 'Daging Beku',
                'slug' => Str::slug('Daging Beku'),
                'path' => 'category/daging-beku.svg',
            ],
            [
                'name' => 'Seafood Beku',
                'slug' => Str::slug('Seafood Beku'),
                'path' => 'category/seafood-beku.svg',
            ],
            [
                'name' => 'Sayur Beku',
                'slug' => Str::slug('Sayur Beku'),
                'path' => 'category/sayur-beku.svg',
            ],
            [
                'name' => 'Buah Beku',
                'slug' => Str::slug('Buah Beku'),
                'path' => 'category/buah-beku.svg',
            ],
        ]);

        Product::insert([
            [
                'name' => 'Nugget Ayam',
                'slug' => Str::slug('Nugget Ayam'),
                'price' => 35000,
                'quantity' => 50,
                'image' => 'products/nugget-ayam.jpg',
                'description' => 'Nugget ayam siap goreng dengan rasa lezat.',
                'category_id' => 1,
            ],
            [
                'name' => 'Sosis Sapi',
                'slug' => Str::slug('Sosis Sapi'),
                'price' => 40000,
                'quantity' => 50,
                'image' => 'products/sosis-sapi.jpg',
                'description' => 'Sosis sapi kami dibuat dari daging sapi berkualitas tinggi, dipilih dengan seksama untuk menghasilkan rasa yang luar biasa. Setiap potongan sosis ini diproses secara higienis dan bebas dari bahan pengawet buatan, menjadikannya pilihan sempurna untuk makanan sehat dan lezat.

Dengan tekstur yang lembut dan cita rasa yang kaya, sosis sapi ini cocok untuk berbagai macam hidangan. Nikmati kelezatannya dalam sajian barbeque, tumis sayuran, atau sebagai tambahan dalam masakan pasta favorit Anda. Selain itu, sosis sapi ini juga dapat dijadikan camilan lezat saat dipanggang atau digoreng dengan sedikit minyak zaitun.',
                'category_id' => 1,
            ],
            [
                'name' => 'Daging Sapi Slice',
                'slug' => Str::slug('Daging Sapi Slice'),
                'price' => 120000,
                'quantity' => 50,
                'image' => 'products/daging-sapi-slice.jpg',
                'description' => 'Daging sapi slice segar dan berkualitas, cocok untuk shabu-shabu.',
                'category_id' => 2,
            ],
            [
                'name' => 'Daging Ayam Fillet',
                'slug' => Str::slug('Daging Ayam Fillet'),
                'price' => 60000,
                'quantity' => 50,
                'image' => 'products/daging-ayam-fillet.jpg',
                'description' => 'Daging ayam fillet tanpa tulang, cocok untuk berbagai masakan.',
                'category_id' => 2,
            ],
            [
                'name' => 'Daging Kambing Guling',
                'slug' => Str::slug('Daging Kambing Guling'),
                'price' => 150000,
                'quantity' => 50,
                'image' => 'products/daging-kambing-guling.jpg',
                'description' => 'Daging kambing siap olah dengan kualitas premium.',
                'category_id' => 2,
            ],
            [
                'name' => 'Udang Kupas',
                'slug' => Str::slug('Udang Kupas'),
                'price' => 80000,
                'quantity' => 50,
                'image' => 'products/udang-kupas.jpg',
                'description' => 'Udang kupas segar yang cocok untuk masakan apa saja.',
                'category_id' => 3,
            ],
            [
                'name' => 'Ikan Dori Fillet',
                'slug' => Str::slug('Ikan Dori Fillet'),
                'price' => 90000,
                'quantity' => 50,
                'image' => 'products/ikan-dori-fillet.jpg',
                'description' => 'Ikan dori fillet berkualitas premium.',
                'category_id' => 3,
            ],
            [
                'name' => 'Cumi Ring',
                'slug' => Str::slug('Cumi Ring'),
                'price' => 75000,
                'quantity' => 50,
                'image' => 'products/cumi-ring.jpg',
                'description' => 'Cumi potong ring siap goreng.',
                'category_id' => 3,
            ],
            [
                'name' => 'Wortel Potong',
                'slug' => Str::slug('Wortel Potong'),
                'price' => 15000,
                'quantity' => 50,
                'image' => 'products/wortel-potong.jpg',
                'description' => 'Wortel potong beku yang cocok untuk sop dan tumisan.',
                'category_id' => 4,
            ],
            [
                'name' => 'Jagung Manis Pipil',
                'slug' => Str::slug('Jagung Manis Pipil'),
                'price' => 20000,
                'quantity' => 50,
                'image' => 'products/jagung-manis-pipil.jpg',
                'description' => 'Jagung manis pipil siap pakai untuk masakan Anda.',
                'category_id' => 4,
            ],
            [
                'name' => 'Mangga Beku',
                'slug' => Str::slug('Mangga Beku'),
                'price' => 30000,
                'quantity' => 50,
                'image' => 'products/mangga-beku.jpg',
                'description' => 'Mangga beku berkualitas untuk smoothies dan dessert.',
                'category_id' => 5,
            ],
            [
                'name' => 'Stroberi Beku',
                'slug' => Str::slug('Stroberi Beku'),
                'price' => 40000,
                'quantity' => 50,
                'image' => 'products/stroberi-beku.jpg',
                'description' => 'Stroberi segar beku untuk aneka olahan minuman.',
                'category_id' => 5,
            ],
            [
                'name' => 'Blueberry Beku',
                'slug' => Str::slug('Blueberry Beku'),
                'price' => 45000,
                'quantity' => 50,
                'image' => 'products/blueberry-beku.jpg',
                'description' => 'Blueberry segar yang dibekukan untuk menjaga rasa dan kualitas.',
                'category_id' => 5,
            ],

        ]);

        Cart::insert([
            [
                'user_id' => 2,
                'product_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'product_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
