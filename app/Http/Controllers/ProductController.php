<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Ambil file gambar
        $file = $request->file('image');

        // Inisialisasi ImageManager
        $manager = new ImageManager(new Driver());

        // Baca gambar yang diunggah
        $image = $manager->read($file);

        // Ubah ukuran maksimal menjadi 1200 x 1200
        $image->scaleDown(width: 1200, height: 1200);

        // Buat nama file unik
        $filename = uniqid('product_') . '.jpg';

        // Simpan gambar hasil manipulasi
        Storage::disk('public')->put(
            'products/' . $filename,
            (string) $image->toJpeg(quality: 80)
        );

        // Contoh respons
        return back()->with(
            'success',
            'Gambar berhasil diunggah: ' . $filename
        );
    }
}
