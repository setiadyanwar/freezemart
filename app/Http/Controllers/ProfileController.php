<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'field' => 'required|in:name,nohp,address', // Ubah alamat -> address
            'value' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->field === 'nohp' && !preg_match('/^\d+$/', $value)) {
                        $fail('Nomor HP harus berupa angka.');
                    }
                },
            ],
        ]);

        $field = $request->field;
        $user->$field = $request->value;
        $user->save();

        return response()->json(['success' => true]);
    }

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
            'image_url' => asset('storage/photos/' . $filename) // Path tetap benar
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
