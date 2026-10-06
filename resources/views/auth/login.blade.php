<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f2f4f7">
    <title>Login | VitoMart</title>
    @vite('resources/css/app.css')
</head>
<body>
<main class="auth-page">
    <section class="auth-shell" aria-labelledby="login-title">
        <aside class="auth-brand">
            <img class="auth-store-illustration" src="{{ asset('images/online-store.svg') }}" alt="" aria-hidden="true">
            <div class="auth-brand-top">
                <img class="auth-brand-mark" src="{{ asset('images/vm-logo.svg') }}" alt="" aria-hidden="true">
                <span class="auth-brand-name">VITO<br>MART</span>
            </div>
            <div class="auth-brand-main">
                <p class="auth-brand-kicker">SISTEM TOKO · 2026</p>
                <h2>Ruang kerja<br>VitoMart.</h2>
                <div class="auth-role-list" aria-label="Jenis akun">
                    <span><b>01</b> ADMIN</span>
                    <span><b>02</b> KASIR</span>
                </div>
            </div>
            <div class="auth-brand-footer">
                <span>RETAIL MANAGEMENT</span>
                <span>JEMBER, ID</span>
            </div>
        </aside>

        <div class="auth-panel">
            <div class="auth-panel-top">
                <span>AKSES PENGGUNA</span>
                <span class="auth-secure"><i aria-hidden="true"></i> LOGIN AMAN</span>
            </div>

            <div class="auth-intro">
                <p class="auth-step">SELAMAT DATANG KEMBALI</p>
                <h1 id="login-title">Masuk ke sistem</h1>
                <p class="auth-description">Masuk dengan akun Admin atau Kasir untuk melanjutkan.</p>
            </div>
            @if (session('status'))
                <p class="auth-success" role="status">{{ session('status') }}</p>
            @endif

            <div class="auth-role-grid">
                <form class="auth-role-card auth-login-card" method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <h2>Masuk VitoMart</h2>
                    <div class="auth-field">
                        <label for="admin-email">Email</label>
                        <input id="admin-email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" placeholder="Masukkan email" autocapitalize="none" spellcheck="false" required autofocus>
                        @error('email')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="admin-password">Kata sandi</label>
                        <input id="admin-password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi" required>
                        @error('password')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="auth-remember"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
                    <button class="button button-primary auth-submit" type="submit">Masuk <span aria-hidden="true">→</span></button>
                </form>
            </div>

            <aside class="auth-demo" aria-label="Akun demo lokal">
                <div class="auth-demo-heading">
                    <strong>Akun demo lokal</strong>
                    <span>UNTUK PRAKTIKUM</span>
                </div>
                <div class="auth-demo-row"><span>ADMIN</span><code>olivia2024@gmail.com</code><code>olivia2024</code></div>
                <div class="auth-demo-row"><span>KASIR</span><code>itolulu2005@gmail.com</code><code>vito2005</code></div>
            </aside>
            <p class="auth-footnote">Dengan masuk, Anda menyetujui penggunaan sistem toko VitoMart.</p>
        </div>
    </section>
</main>
</body>
</html>
