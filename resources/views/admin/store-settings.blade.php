<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f2f4f7">
    <title>Pengaturan Toko | VitoMart</title>
    @vite('resources/css/app.css')
</head>
<body>
<main class="profile-page">
    <header class="profile-header">
        <div>
            <p class="profile-eyebrow">PENGATURAN TOKO</p>
            <h1>Konfigurasi Profil Toko</h1>
            <p>Ubah detail toko yang ditampilkan di kasir, profil, dan dokumen operasional.</p>
        </div>
        <div class="header-actions">
            <a class="profile-back secondary" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="profile-back" href="{{ route('kasir') }}">Kasir</a>
        </div>
    </header>

    <section class="profile-card" aria-label="Form pengaturan toko">
        @if (session('status'))
            <p class="profile-photo-status" role="status">{{ session('status') }}</p>
        @endif

        <form action="{{ route('admin.store-settings.update') }}" method="post" class="profile-photo-form">
            @csrf
            <div class="profile-details">
                <div class="profile-detail">
                    <label for="storeName">Nama toko</label>
                    <input id="storeName" name="name" type="text" value="{{ old('name', $store->name ?? 'VitoMart') }}" required>
                    @error('name')
                        <span class="profile-photo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="profile-detail">
                    <label for="storeAddress">Alamat</label>
                    <input id="storeAddress" name="address" type="text" value="{{ old('address', $store->address ?? 'Jl. Contoh No. 123') }}" required>
                    @error('address')
                        <span class="profile-photo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="profile-detail">
                    <label for="storeCity">Kota</label>
                    <input id="storeCity" name="city" type="text" value="{{ old('city', $store->city ?? 'Jember') }}" required>
                    @error('city')
                        <span class="profile-photo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="profile-detail">
                    <label for="storePhone">Telepon</label>
                    <input id="storePhone" name="phone" type="text" value="{{ old('phone', $store->phone ?? '0812-xxxx-xxxx') }}" required>
                    @error('phone')
                        <span class="profile-photo-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="header-actions" style="justify-content:flex-start; margin-top: 1.5rem;">
                <button class="profile-back" type="submit">Simpan perubahan</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>
