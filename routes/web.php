<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

$defaultStore = (object) [
    'name' => 'ikvimart27',
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
use App\Events\OrderPlaced;

Route::get('/test-broadcast', function () {
    $dataTransaksi = [
        'id_order' => 'TRX-' . rand(1000, 9999),
        'total' => 150000,
        'status' => 'Paid'
    ];

    broadcast(new OrderPlaced($dataTransaksi));


    return "Event OrderPlaced berhasil dipicu! Sila cek konsol browser Anda.";
});

Route::get('/products/create', function () {
    return view('products.create');
})->name('products.create');

Route::post('/products', [
    ProductController::class,
    'store'
])->name('products.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function (Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        return redirect()->route('register')->with('status', 'Pendaftaran berhasil. Silakan masuk ke sistem.');
    })->name('register.store');

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

use App\Http\Controllers\ReceiptController;
Route::get('/print-receipt', [ReceiptController::class, 'print'])->name('print.receipt');

// Route Massal Otomatis: 20 Produk Minimarket Populer
Route::get('/tambah-produk-fmcg', function () {
    try {
        Illuminate\Support\Facades\DB::table('products')->insert([
            // --- KATEGORI MIE INSTAN ---
            ['name' => 'Indomie Goreng Spesial', 'price' => 3500, 'stock' => 200, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Indomie Ayam Bawang', 'price' => 3300, 'stock' => 150, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mie Sedaap Goreng', 'price' => 3400, 'stock' => 180, 'created_at' => now(), 'updated_at' => now()],
            
            // --- KATEGORI MINUMAN DINGIN & SEGAR ---
            ['name' => 'Sprite Botol 390ml', 'price' => 5500, 'stock' => 120, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coca Cola Slim Can 250ml', 'price' => 6000, 'stock' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fanta Strawberry 390ml', 'price' => 5500, 'stock' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teh Botol Sosro 450ml', 'price' => 6500, 'stock' => 150, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aqua Air Mineral 600ml', 'price' => 3500, 'stock' => 300, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pocari Sweat Can 330ml', 'price' => 8500, 'stock' => 80, 'created_at' => now(), 'updated_at' => now()],

            // --- KATEGORI SNACK & BISKUIT ---
            ['name' => 'Pringles Original 107g', 'price' => 24500, 'stock' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oreo Vanilla Flavour 119g', 'price' => 9800, 'stock' => 85, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chitato Sapi Panggang 68g', 'price' => 11500, 'stock' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Silverqueen Almond 58g', 'price' => 16500, 'stock' => 40, 'created_at' => now(), 'updated_at' => now()],

            // --- KATEGORI SARAPAN & SUSU ---
            ['name' => 'Meises Ceres Klasik 200g', 'price' => 21000, 'stock' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Susu Ultra Milk Cokelat 250ml', 'price' => 7000, 'stock' => 110, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kopi Kapal Api Mantap 165g', 'price' => 14500, 'stock' => 95, 'created_at' => now(), 'updated_at' => now()],

            // --- KATEGORI KEBUTUHAN HARIAN & SABUN ---
            ['name' => 'Biore Body Wash Refill 450ml', 'price' => 26000, 'stock' => 45, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shampoo Clear Menthol 160ml', 'price' => 28500, 'stock' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pepsodent Pencegah Gigi Berlubang 190g', 'price' => 12500, 'stock' => 75, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tisu Paseo Smart 250 Sheets', 'price' => 15000, 'stock' => 130, 'created_at' => now(), 'updated_at' => now()]
        ]);

        return '
        <div style="max-width:500px; margin:50px auto; padding:30px; border:2px solid #28a745; font-family:sans-serif; text-align:center; border-radius:8px;">
            <h2 style="color:#28a745; margin-top:0;">✓ Sukses Besar!</h2>
            <p style="color:#555; font-size:16px;"><b>20 Produk Pilihan Minimarket</b> telah berhasil disuntikkan langsung ke database.</p>
            <hr style="border:0; border-top:1px solid #eee; margin:20px 0;">
            <a href="/kasir" style="display:inline-block; padding:12px 24px; background:#007bff; color:white; text-decoration:none; border-radius:4px; font-weight:bold;">Kembali Ke Halaman Kasir</a>
        </div>';
    } catch (\Exception $e) {
        return '<div style="color:red; max-width:500px; margin:50px auto; font-family:sans-serif; padding:20px; border:1px solid red;"><b>Gagal Input Data:</b> ' . $e->getMessage() . '</div>';
    }
});
