<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;



class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $title = 'FreezeMart | Profile Akun Anda';

        return view('profile', compact('user', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($profile)
    {
        $user = User::findOrFail($profile ?? Auth::id());
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function updatePhoto(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Maks 2MB
        ]);

        // Ambil file gambar
        $file = $request->file('photo');
        $filename = $file->hashName(); // Generate nama file unik

        // Simpan gambar ke storage (folder 'photos' dalam 'public')
        $file->storeAs('photos', $filename, 'public');

        // Hapus gambar lama jika ada
        if ($user->photo) {
            Storage::disk('public')->delete('photos/' . $user->photo);
        }

        // Simpan hanya nama file di database
        $user->photo = $filename;
        $user->save();

        return response()->json([
            'success' => true,
            'image_url' => asset('storage/photos/' . $user->photo) // Path tetap benar
        ]);
    }

    // Mengupdate nama pengguna
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->name = $request->name;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Nama berhasil diubah');
    }

    // Mengupdate alamat pengguna
    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->address = $request->address;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Alamat berhasil diubah');
    }

    // Mengupdate email pengguna
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = User::findOrFail(Auth::id());
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Email berhasil diubah');
    }

    // Mengupdate nomor telepon pengguna
    public function updateNoHp(Request $request)
    {
        $request->validate([
            'nohp' => 'nullable|string|max:20',
        ]);

        $user = User::findOrFail(Auth::id());
        $user->nohp = $request->nohp;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Nomor HP berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
