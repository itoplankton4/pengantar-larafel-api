<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f2f4f7">
    <title>Profil | VitoMart</title>
    @vite('resources/css/app.css')
</head>
<body>
<main class="profile-page">
    <header class="profile-header">
        <div>
            <p class="profile-eyebrow">PROFIL TOKO</p>
            <h1>Profil Toko dan Pengelola</h1>
            <p>Informasi toko, status akun, dan aktivitas operasional kasir.</p>
        </div>
        <div class="header-actions">
            @if(Auth::user()?->role === 'admin')
                <a class="profile-back secondary" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            @else
                <a class="profile-back secondary" href="{{ route('kasir') }}">Buka Kasir</a>
            @endif
            <a class="profile-back" href="{{ route('logout.confirm') }}">Keluar</a>
        </div>
    </header>

    @php($cashierName = $cashier?->name ?? 'Admin')
    <div class="profile-layout">
        <section class="profile-identity" aria-label="Identitas pengelola">
            <div class="profile-avatar" id="profileAvatar">
                <img class="profile-avatar-photo" id="profileAvatarPhoto" src="{{ $cashier?->profile_photo_path ? route('profil.photo') : '' }}" alt="Foto profil {{ $cashierName }}" @if (! $cashier?->profile_photo_path) hidden @endif>
                <span id="profileAvatarInitials" @if ($cashier?->profile_photo_path) hidden @endif>{{ strtoupper(substr($cashierName, 0, 2)) }}</span>
            </div>
            <p class="profile-role">PENGELOLA KASIR</p>
            <h2>{{ $cashierName }}</h2>
            <span class="profile-status">{{ $cashier ? 'Akun terhubung' : 'Mode lokal' }}</span>

            @if (session('status'))
                <p class="profile-photo-status" role="status">{{ session('status') }}</p>
            @endif
            <form class="profile-photo-form" action="{{ route('profil.photo.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="profilePhotoInput">Foto profil</label>
                <input class="profile-photo-input" id="profilePhotoInput" name="photo" type="file" accept="image/jpeg,image/png,image/webp" required>
                @error('photo')
                    <span class="profile-photo-error">{{ $message }}</span>
                @enderror
                <small>JPG, PNG, atau WebP. Maksimal 2 MB.</small>
                <button class="profile-back" type="submit">Unggah Foto</button>
            </form>

            <div class="profile-metric-grid">
                <div class="mini-metric">
                    <span>Jam kerja</span>
                    <strong>8.5 jam</strong>
                </div>
                <div class="mini-metric">
                    <span>Transaksi</span>
                    <strong>184</strong>
                </div>
                <div class="mini-metric">
                    <span>Pelayanan</span>
                    <strong>94%</strong>
                </div>
            </div>
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
                        <dt>Peran</dt>
                        <dd>{{ $cashier?->role ?? 'Admin' }}</dd>
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
                        <dd>{{ $store->name ?? 'VitoMart' }}</dd>
                    </div>
                    <div class="profile-detail">
                        <dt>Alamat</dt>
                        <dd>{{ $store->address ?? 'Jl. Contoh No. 123' }}, {{ $store->city ?? 'Jember' }}</dd>
                    </div>
                    <div class="profile-detail">
                        <dt>Telepon</dt>
                        <dd>{{ $store->phone ?? '0812-xxxx-xxxx' }}</dd>
                    </div>
                    <div class="profile-detail">
                        <dt>Catatan</dt>
                        <dd>Operasional retail siap digunakan untuk transaksi harian dan monitoring sederhana.</dd>
                    </div>
                </dl>
            </section>
        </div>
    </div>
</main>
<script>
    const profilePhotoInput = document.getElementById('profilePhotoInput');
    profilePhotoInput.addEventListener('change', () => {
        const [file] = profilePhotoInput.files;
        if (!file) return;
        const preview = document.getElementById('profileAvatarPhoto');
        preview.src = URL.createObjectURL(file);
        preview.hidden = false;
        document.getElementById('profileAvatarInitials').hidden = true;
    });
</script>
</body>
</html>
