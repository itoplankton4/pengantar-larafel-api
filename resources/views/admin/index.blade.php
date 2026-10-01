<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f2f4f7">
    <title>Panel Admin | Toko Retail Vitoxx</title>
    @vite('resources/css/app.css')
</head>
<body>
<main class="profile-page">
    <header class="profile-header">
        <div>
            <p class="profile-eyebrow">PANEL ADMIN</p>
            <h1>Pengelolaan Toko</h1>
            <p>Selamat datang, {{ auth()->user()->name }}.</p>
        </div>
        <a class="profile-back" href="{{ route('logout.confirm') }}">Keluar</a>
    </header>

    <section class="admin-grid" aria-label="Menu admin">
        <a class="admin-card" href="{{ route('kasir') }}">
            <span class="admin-card-label">OPERASIONAL</span>
            <h2>Buka Kasir</h2>
            <p>Masuk ke halaman transaksi penjualan.</p>
        </a>
        <a class="admin-card" href="{{ route('profil') }}">
            <span class="admin-card-label">AKUN</span>
            <h2>Profil Toko</h2>
            <p>Lihat informasi toko dan pengelola.</p>
        </a>
    </section>
</main>
</body>
</html>
