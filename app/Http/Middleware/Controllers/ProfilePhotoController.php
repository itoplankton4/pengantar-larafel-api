<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = $request->user();
        $oldPhotoPath = $user->profile_photo_path;
        $user->profile_photo_path = $validated['photo']->store("profile-photos/{$user->id}", 'local');
        $user->save();

        if ($oldPhotoPath) {
            Storage::disk('local')->delete($oldPhotoPath);
        }

        return back()->with('status', 'Foto profil berhasil diperbarui.');
    }

    public function show(Request $request)
    {
        $photoPath = $request->user()->profile_photo_path;

        abort_unless($photoPath && Storage::disk('local')->exists($photoPath), 404);

        return Storage::disk('local')->response($photoPath);
    }
}