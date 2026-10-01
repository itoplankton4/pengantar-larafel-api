<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f2f4f7">
    <title>Keluar | Toko Retail Vitoxx</title>
    @vite('resources/css/app.css')
</head>
<body>
<main class="auth-page">
    <section class="auth-shell" aria-labelledby="logout-title">
        <aside class="auth-brand">
            <img class="auth-store-photo" src="{{ asset('store-interior.jpg') }}" alt="Suasana toko retail">
            <div class="auth-brand-top">
                <span class="auth-brand-mark" aria-hidden="true">V</span>
                <span class="auth-brand-name">TOKO RETAIL<br>VITOXX</span>
            </div>
            <div class="auth-brand-main">
                <p class="auth-brand-kicker">SESI PENGGUNA</p>
                <h2>Sampai<br>jumpa.</h2>
                <div class="auth-role-list">
                    <span><b>01</b> KELUAR DENGAN AMAN</span>
                </div>
            </div>
            <div class="auth-brand-footer">
                <span>RETAIL MANAGEMENT</span>
                <span>JEMBER, ID</span>
            </div>
        </aside>

        <div class="auth-panel">
            <div class="auth-panel-top">
                <span>KONFIRMASI SESI</span>
                <span class="auth-secure"><i aria-hidden="true"></i> AKUN AKTIF</span>
            </div>

            <div class="auth-intro">
                <p class="auth-step">{{ strtoupper(auth()->user()->role) }}</p>
                <h1 id="logout-title">Keluar dari akun?</h1>
                <p class="auth-description">Anda masuk sebagai <strong>{{ auth()->user()->name }}</strong>. Sesi kasir akan diakhiri setelah Anda keluar.</p>
            </div>

            <div class="auth-logout-actions">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="button button-primary auth-submit" type="submit">Ya, keluar <span aria-hidden="true">→</span></button>
                </form>
                <a class="auth-cancel" href="{{ $destination }}">Batalkan dan kembali</a>
            </div>
        </div>
    </section>
</main>
</body>
</html>
