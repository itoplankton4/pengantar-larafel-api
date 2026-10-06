<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard POS - VitoMart</title>
    <!-- Menggunakan Bootstrap 5 untuk tampilan rapi dan modern -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <!-- Menggunakan Bootstrap Icons untuk ikon menu -->
    <link rel="stylesheet" href="https://jsdelivr.net">
    <style>
        body { background-color: #f8fafc; font-family: 'Segoe UI', system-ui, sans-serif; }
        .hero-section { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white; padding: 60px 0; border-radius: 0 0 24px 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .menu-card { transition: all 0.3s ease; border: 1px solid #e2e8f0; border-radius: 12px; height: 100%; cursor: pointer; text-decoration: none; color: inherit; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-color: #3b82f6; }
        .icon-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-bottom: 15px; }
    </style>
</head>
<body>

    <!-- HERO / BANNER ATAS -->
    <div class="hero-section text-center mb-5">
        <div class="container">
            <h1 class="display-5 fw-bold">MINIMARKET POS SYSTEM</h1>
            <p class="lead text-secondary-emphasis text-white-50">Selamat Datang di Sistem Manajemen Kasir Retail Toko Makmur</p>
            <div class="badge bg-primary px-3 py-2 mt-2">Versi Aplikasi Laravel 13</div>
        </div>
    </div>

    <!-- UTAMA MENU GRID (Berdasarkan Modul Hal 24) -->
    <div class="container mb-5">
        <h4 class="fw-bold text-dark mb-4"><i class="bi bi-grid-fill me-2 text-primary"></i>Modul Menu Kasir</h4>
        <div class="row g-4">
            
            <!-- MENU 1: TRANSAKSI BARU (Membuka Halaman Kasir) -->
            <div class="col-md-4">
                <a href="{{ url('/kasir') }}" class="card menu-card p-4">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-cart-plus-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Transaksi Baru</h5>
                    <p class="text-muted small mb-0">Buka mesin kasir POS untuk melayani scan barcode barang, input diskon, dan pembayaran pelanggan.</p>
                </a>
            </div>

            <!-- MENU 2: TRANSAKSI DITAHAN (Fitur Rekomendasi Modul) -->
            <div class="col-md-4">
                <div class="card menu-card p-4" onclick="alert('Fitur Transaksi Ditahan (Parkir Transaksi) sedang dalam pengembangan.')">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-pause-btn-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Transaksi Ditahan</h5>
                    <p class="text-muted small mb-0">Melihat daftar transaksi belanja pelanggan yang sedang ditangguhkan/diparkir sementara.</p>
                </div>
            </div>

            <!-- MENU 3: RIWAYAT TRANSAKSI -->
            <div class="col-md-4">
                <div class="card menu-card p-4" onclick="alert('Fitur Riwayat Transaksi sedang dalam pengembangan.')">
                    <div class="icon-box bg-success bg-opacity-10 text-success">
                        <i class="bi bi-clock-history fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Riwayat Transaksi</h5>
                    <p class="text-muted small mb-0">Melihat kembali nota penjualan lama, total omset harian kasir, dan audit cetak ulang struk.</p>
                </div>
            </div>

            <!-- MENU 4: RETUR PENJUALAN -->
            <div class="col-md-4">
                <div class="card menu-card p-4" onclick="alert('Fitur Retur Penjualan sedang dalam pengembangan.')">
                    <div class="icon-box bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-arrow-counterclockwise fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Retur Penjualan</h5>
                    <p class="text-muted small mb-0">Prosedur pengembalian barang rusak dari konsumen serta klaim garansi produk.</p>
                </div>
            </div>

            <!-- MENU 5: TUTUP KASIR -->
            <div class="col-md-4">
                <div class="card menu-card p-4" onclick="alert('Fitur Tutup Kasir sedang dalam pengembangan.')">
                    <div class="icon-box bg-info bg-opacity-10 text-info">
                        <i class="bi bi-journal-check fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Tutup Kasir (Sesi)</h5>
                    <p class="text-muted small mb-0">Menghitung akumulasi saldo awal modal dengan pendapatan QRIS, tunai, dan debit sebelum serah terima shift.</p>
                </div>
            </div>

            <!-- MENU 6: PENGATURAN PRODUK -->
            <div class="col-md-4">
                <div class="card menu-card p-4" onclick="alert('Fitur Manajemen Produk sedang dalam pengembangan.')">
                    <div class="icon-box bg-secondary bg-opacity-10 text-secondary">
                        <i class="bi bi-box-seam-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Manajemen Barang</h5>
                    <p class="text-muted small mb-0">Melihat ketersediaan stok gudang minimarket, harga jual produk, dan sinkronisasi nomor barcode.</p>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center text-muted py-4 border-top bg-white">
        <p class="small mb-0">&copy; 2026 VitoMart. UPT Praktikum Pemrograman Web.</p>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://jsdelivr.net"></script>
</body>
</html>
