<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f2f4f7">
    <title>Panel Admin | VitoMart</title>
    @vite('resources/css/app.css')
</head>
<body>
<main class="admin-page">
    <header class="dashboard-header">
        <div>
            <p class="profile-eyebrow">PANEL ADMIN</p>
            <h1>Dashboard Toko</h1>
            <p>Selamat datang, {{ auth()->user()?->name ?? 'Admin' }}. Pantau operasional toko secara real time.</p>
        </div>
        <div class="header-actions">
            <a class="profile-back secondary" href="{{ route('kasir') }}">Buka Kasir</a>
            <a class="profile-back" href="{{ route('logout.confirm') }}">Keluar</a>
        </div>
    </header>

    <section class="stats-grid" aria-label="Ringkasan toko">
        <article class="stat-card primary">
            <div>
                <span class="stat-label">Transaksi hari ini</span>
                <h2 id="salesTodayTransactions">0</h2>
            </div>
            <span class="stat-trend neutral">transaksi</span>
        </article>
        <article class="stat-card success">
            <div>
                <span class="stat-label">Omset hari ini</span>
                <h2 id="salesTodayTotal">Rp 0</h2>
            </div>
            <span class="stat-trend up">hari ini</span>
        </article>
        <article class="stat-card warning">
            <div>
                <span class="stat-label">Omset 7 hari</span>
                <h2 id="salesWeekTotal">Rp 0</h2>
            </div>
            <span class="stat-trend neutral">mingguan</span>
        </article>
        <article class="stat-card accent">
            <div>
                <span class="stat-label">Omset bulan ini</span>
                <h2 id="salesMonthTotal">Rp 0</h2>
            </div>
            <span class="stat-trend up">bulanan</span>
        </article>
    </section>

    <section class="dashboard-grid" aria-label="Performa operasional">
        <div class="panel panel-large sales-chart" id="salesChart" data-endpoint="{{ route('admin.sales.chart') }}">
            <div class="panel-head">
                <h3>Grafik Penjualan</h3>
                <div class="sales-periods" role="group" aria-label="Periode grafik">
                    <button class="is-active" type="button" data-period="daily" aria-pressed="true">Harian</button>
                    <button type="button" data-period="weekly" aria-pressed="false">Mingguan</button>
                    <button type="button" data-period="monthly" aria-pressed="false">Bulanan</button>
                </div>
            </div>
            <div class="sales-chart-summary">
                <strong id="salesChartTotal">Rp 0</strong>
                <span id="salesChartTransactions">0 transaksi</span>
            </div>
            <div class="sales-chart-scroll">
                <div class="sales-chart-bars" id="salesChartBars" aria-live="polite"></div>
            </div>
            <p class="sales-chart-message" id="salesChartMessage" hidden></p>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h3>Operasional toko</h3>
                <span>Live</span>
            </div>
            <div class="status-stack">
                <div class="status-item">
                    <span class="status-dot green"></span>
                    <div>
                        <strong>Kasir aktif</strong>
                        <small id="cashierStatusText">Memuat data...</small>
                    </div>
                </div>
                <div class="status-item">
                    <span class="status-dot amber"></span>
                    <div>
                        <strong>Inventaris</strong>
                        <small id="inventoryStatusText">Memuat data...</small>
                    </div>
                </div>
                <div class="status-item">
                    <span class="status-dot blue"></span>
                    <div>
                        <strong>Pembayaran</strong>
                        <small id="paymentStatusText">Memuat data...</small>
                    </div>
                </div>
                @php($midtransReady = filled(config('services.midtrans.server_key')) && filled(config('services.midtrans.client_key')))
                <div class="status-item">
                    <span class="status-dot {{ $midtransReady ? 'green' : 'amber' }}"></span>
                    <div>
                        <strong>Gateway</strong>
                        <small>{{ $midtransReady ? 'Midtrans aktif dan siap menerima pembayaran' : 'Mode demo aktif, siap dihubungkan ke gateway nyata' }}</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="panel" aria-label="Menu manajemen">
        <div class="panel-head">
            <h3>Menu utama</h3>
            <span>Quick access</span>
        </div>
        <div class="admin-grid" aria-label="Menu admin">
            <a class="admin-card" href="{{ route('kasir') }}">
                <span class="admin-card-label">OPERASIONAL</span>
                <h2>Buka Kasir</h2>
                <p>Masuk ke halaman transaksi penjualan, scanning barang, dan pembayaran.</p>
            </a>
            <a class="admin-card" href="{{ route('profil') }}">
                <span class="admin-card-label">PROFIL</span>
                <h2>Profil Toko</h2>
                <p>Lihat informasi toko, akun, dan data operasional pengelola.</p>
            </a>
            <a class="admin-card" href="{{ route('admin.store-settings') }}">
                <span class="admin-card-label">PENGATURAN</span>
                <h2>Pengaturan Toko</h2>
                <p>Ubah nama toko, alamat, kota, dan kontak utama yang tampil di aplikasi.</p>
            </a>
            <div class="admin-card" aria-label="Ekspor laporan penjualan">
                <span class="admin-card-label">LAPORAN</span>
                <h2>Ekspor Laporan</h2>
                <p>Download laporan penjualan ke CSV atau PDF.</p>
                <div class="admin-export-links">
                    <a href="{{ route('admin.sales.export', ['format' => 'csv']) }}">CSV</a>
                    <a href="{{ route('admin.sales.export', ['format' => 'pdf']) }}">PDF</a>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    const salesChart = document.getElementById('salesChart');
    const salesChartBars = document.getElementById('salesChartBars');
    const salesChartMessage = document.getElementById('salesChartMessage');
    const formatRupiah = (amount) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(Number(amount) || 0);

    async function loadSalesChart(period) {
        salesChart.setAttribute('aria-busy', 'true');
        salesChartMessage.hidden = true;
        try {
            const response = await fetch(`${salesChart.dataset.endpoint}?period=${period}`, { headers: { Accept: 'application/json' } });
            if (!response.ok) throw new Error('Grafik penjualan tidak dapat dimuat.');
            const data = await response.json();
            const summary = data?.summary ?? {};
            const series = Array.isArray(data?.series) ? data.series : [];
            const total = Number(data?.total) || 0;
            const transactions = Number(data?.transactions) || 0;

            document.getElementById('salesTodayTransactions').textContent = Number(summary.today_transactions) || 0;
            document.getElementById('salesTodayTotal').textContent = formatRupiah(summary.today_total ?? 0);
            document.getElementById('salesWeekTotal').textContent = formatRupiah(summary.week_total ?? 0);
            document.getElementById('salesMonthTotal').textContent = formatRupiah(summary.month_total ?? 0);
            document.getElementById('salesChartTotal').textContent = formatRupiah(total);
            document.getElementById('salesChartTransactions').textContent = `${transactions} transaksi`;

            const maximum = Math.max(...series.map((point) => Number(point?.total) || 0), 1);
            salesChartBars.innerHTML = series.map((point) => {
                const value = Number(point?.total) || 0;
                const height = value ? Math.max(3, (value / maximum) * 100) : 0;
                return `<div class="sales-bar-item" title="${point?.label ?? ''}: ${formatRupiah(value)}">
                    <span class="sales-bar-value">${value ? formatRupiah(value) : ''}</span>
                    <div class="sales-bar-track"><i style="height:${height}%"></i></div>
                    <span class="sales-bar-label">${point?.label ?? ''}</span>
                </div>`;
            }).join('');

            salesChartMessage.textContent = transactions ? '' : 'Belum ada transaksi pada periode ini.';
            salesChartMessage.hidden = Boolean(transactions);
        } catch (error) {
            salesChartMessage.textContent = error.message;
            salesChartMessage.hidden = false;
        } finally {
            salesChart.setAttribute('aria-busy', 'false');
        }
    }

    async function loadInventorySummary() {
        try {
            const response = await fetch('{{ route('admin.inventory') }}', { headers: { Accept: 'application/json' } });
            if (!response.ok) throw new Error('Inventory tidak dapat dimuat.');
            const data = await response.json();
            document.getElementById('cashierStatusText').textContent = `${data.total_products} produk aktif`;
            document.getElementById('inventoryStatusText').textContent = data.low_stock_count ? `${data.low_stock_count} item perlu restock` : 'Stok aman';
            document.getElementById('paymentStatusText').textContent = data.out_of_stock_count ? `${data.out_of_stock_count} produk habis` : 'Semua produk tersedia';
        } catch (error) {
            document.getElementById('cashierStatusText').textContent = 'Data tidak tersedia';
            document.getElementById('inventoryStatusText').textContent = 'Data tidak tersedia';
            document.getElementById('paymentStatusText').textContent = 'Data tidak tersedia';
        }
    }

    document.querySelectorAll('[data-period]').forEach((button) => button.addEventListener('click', () => {
        document.querySelectorAll('[data-period]').forEach((periodButton) => {
            const active = periodButton === button;
            periodButton.classList.toggle('is-active', active);
            periodButton.setAttribute('aria-pressed', String(active));
        });
        loadSalesChart(button.dataset.period);
    }));

    loadSalesChart('daily');
    loadInventorySummary();
</script>
</body>
</html>
