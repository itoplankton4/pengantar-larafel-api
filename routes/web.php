<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'kasir');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau kata sandi tidak sesuai.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'kasir'));
    })->name('login.store');
});

Route::get('/logout', function () {
    $destination = Auth::user()->role === 'admin' ? route('admin.dashboard') : route('kasir');

    return view('auth.logout', compact('destination'));
})->middleware('auth')->name('logout.confirm');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')->with('status', 'Anda berhasil keluar dari sistem.');
})->middleware('auth')->name('logout');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.index')->name('dashboard');
});

Route::middleware('cek.role:admin,kasir')->group(function () {
    Route::view('/kasir', 'kasir')->name('kasir');

    Route::get('/profil', function () {
        return view('profil.index', [
            'cashier' => Auth::user(),
            'store' => [
                'name' => 'Toko Retail Vitoxx',
                'address' => 'Jl. Contoh No. 123',
                'city' => 'Jember',
                'phone' => '0812-xxxx-xxxx',
            ],
        ]);
    })->name('profil');
});
