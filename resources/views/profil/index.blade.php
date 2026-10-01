<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f2f4f7">
    <title>Profil | Toko Retail Vitoxx</title>
    @vite('resources/css/app.css')
</head>
<body>
<main class="profile-page">
    <header class="profile-header">
        <div>
            <p class="profile-eyebrow">PROFIL TOKO</p>
            <h1>Profil Toko dan Pengelola</h1>
            <p>Informasi toko dan akun pengelola kasir.</p>
        </div>
        <a class="profile-back" href="{{ url('/kasir') }}">Kembali ke kasir</a>
    </header>

    @php($cashierName = $cashier?->name ?? 'Admin')
    <div class="profile-layout">
        <section class="profile-identity" aria-label="Identitas pengelola">
            <div class="profile-avatar" aria-hidden="true">{{ strtoupper(substr($cashierName, 0, 2)) }}</div>
            <p class="profile-role">PENGELOLA KASIR</p>
            <h2>{{ $cashierName }}</h2>
            <span class="profile-status">{{ $cashier ? 'Akun terhubung' : 'Mode lokal' }}</span>
        </section>

        <div>
            <section class="profile-card" aria-labelledby="account-heading">
                <h2 id="account-heading">Informasi Pengelola</h2>
                <dl class="profile-details">
                    <div class="profile-detail">
                        <dt>Nama</dt>
                        <dd>{{ $cashierName }}</dd>
                    </div>
                    <div class="profile-detail">
                        <dt>Email</dt>
                        <dd>{{ $cashier?->email ?? 'Belum diatur' }}</dd>
                    </div>
                    <div class="profile-detail">
                        <dt>Status akun</dt>
                        <dd>{{ $cashier ? 'Terdaftar' : 'Belum menggunakan login' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="profile-card" aria-labelledby="store-heading">
                <h2 id="store-heading">Informasi Toko</h2>
                <dl class="profile-details">
                    <div class="profile-detail">
                        <dt>Nama toko</dt>
                        <dd>{{ $store['name'] }}</dd>
                    </div>
                    <div class="profile-detail">
                        <dt>Alamat</dt>
                        <dd>{{ $store['address'] }}, {{ $store['city'] }}</dd>
                    </div>
                    <div class="profile-detail">
                        <dt>Telepon</dt>
                        <dd>{{ $store['phone'] }}</dd>
                    </div>
                </dl>
            </section>
        </div>
    </div>
</main>
</body>
</html>
