<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProfilePhotoController;

$defaultStore = (object) [
    'name' => 'VitoMart',
    'address' => 'Jl. ell tarri seba',
    'city' => 'menia',
    'phone' => '081275054954',
];

$resolveStore = function () use ($defaultStore) {
    if (! Schema::hasTable('store_settings')) {
        return $defaultStore;
    }

    return \App\Models\StoreSetting::query()->latest()->first() ?? $defaultStore;
};

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

    $loginWithRole = function (Request $request, ?string $requiredRole = null) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (! $user || ! in_array($user->role, ['admin', 'kasir'], true) || ($requiredRole && $user->role !== $requiredRole)) {
            return back()->withErrors([
                'email' => $requiredRole === 'admin'
                    ? 'Akun Admin tidak ditemukan atau kata sandi salah.'
                    : ($requiredRole === 'kasir' ? 'Akun Kasir tidak ditemukan atau kata sandi salah.' : 'Akun tidak ditemukan atau tidak memiliki akses.'),
            ])->onlyInput('email');
        }

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau kata sandi tidak sesuai.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'kasir');
    };

    Route::post('/login/admin', function (Request $request) use ($loginWithRole) {
        return $loginWithRole($request, 'admin');
    })->name('login.admin');

    Route::post('/login/kasir', function (Request $request) use ($loginWithRole) {
        return $loginWithRole($request, 'kasir');
    })->name('login.kasir');

    Route::post('/login', function (Request $request) use ($loginWithRole) {
        return $loginWithRole($request);
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

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () use ($resolveStore) {
    Route::get('/sales-chart', [SalesController::class, 'chart'])->name('sales.chart');
    Route::get('/sales/items', [SalesController::class, 'itemsReport'])->name('sales.items');
    Route::get('/sales/export/{format}', [SalesController::class, 'export'])->name('sales.export');
    Route::get('/inventory', [\App\Http\Controllers\ProductController::class, 'inventorySummary'])->name('inventory');
    Route::get('/store-settings', function () use ($resolveStore) {
        $store = $resolveStore();

        return view('admin.store-settings', compact('store'));
    })->name('store-settings');
    Route::post('/store-settings', function (Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
        ]);

        if (! Schema::hasTable('store_settings')) {
            return redirect()->route('admin.store-settings')->with('status', 'Tabel store_settings belum dibuat. Jalankan migrasi database terlebih dahulu.');
        }

        $store = \App\Models\StoreSetting::query()->latest()->first();

        if ($store) {
            $store->fill($data);
            $store->save();
        } else {
            $store = \App\Models\StoreSetting::create($data);
        }

        return redirect()->route('admin.store-settings')->with('status', 'Pengaturan toko berhasil disimpan.');
    })->name('store-settings.update');
    Route::post('/products/{product}/restock', [\App\Http\Controllers\ProductController::class, 'restock'])->name('products.restock');
    Route::view('/', 'admin.index')->name('dashboard');
    Route::apiResource('products', \App\Http\Controllers\ProductController::class);
});

Route::post('/payment/checkout', [SalesController::class, 'checkout'])->name('payment.checkout');
Route::post('/payment/callback', [SalesController::class, 'callback'])->name('payment.callback');

Route::middleware('cek.role:admin,kasir')->group(function () use ($resolveStore) {
    Route::get('/kasir', function () use ($resolveStore) {
        $store = $resolveStore();

        return view('kasir', compact('store'));
    })->name('kasir');
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
    Route::get('/sales/{sale}/receipt', [SalesController::class, 'receipt'])->name('sales.receipt');

    Route::get('/profil', function () use ($resolveStore) {
        $store = $resolveStore();

        return view('profil.index', [
            'cashier' => Auth::user(),
            'store' => $store,
        ]);
    })->name('profil');
    Route::post('/profil/foto', [ProfilePhotoController::class, 'update'])->name('profil.photo.update');
    Route::get('/profil/foto', [ProfilePhotoController::class, 'show'])->name('profil.photo');
});
