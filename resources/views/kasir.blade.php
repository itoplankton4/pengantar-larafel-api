<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f3f5f2">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <meta name="products-url" content="{{ route('products.index') }}">
    <meta name="product-image-base" content="{{ asset('images/products') }}">
    <meta name="default-product-image" content="{{ asset('images/products/product-default.jpg') }}">
    <title>Kasir | {{ $store->name ?? 'ikvimart27' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<main class="pos-shell" data-sale-url="{{ route('sales.store') }}">
    <header class="topbar">
        <div>
            <p class="store-name">{{ $store->name ?? 'ikvimart27' }}</p>
            <div class="store-meta">{{ $store->address ?? '' }}{{ !empty($store->city) ? ', '.$store->city : '' }}</div>
        </div>
        <div class="transaction-meta">
            <span>TRANSAKSI BARU</span>
            <strong class="transaction-number" id="transactionNumber"></strong>
            <span id="currentDate"></span>
        </div>
        <nav class="header-actions" aria-label="Navigasi kasir">
            <a class="profile-back secondary" href="{{ route('profil') }}">Profil</a>
            <a class="profile-back" href="{{ route('logout.confirm') }}">Keluar</a>
        </nav>
    </header>

    <div class="work-area">
        <section class="left-column" aria-label="Katalog dan keranjang">
            <section class="card">
                <div class="card-heading">
                    <span>Pilih Produk</span>
                    <span class="product-count" id="productCount">Memuat produk...</span>
                </div>
                <div class="card-body">
                    <div class="search-row">
                        <div class="search-wrap">
                            <input class="search-input" id="searchProduct" type="search" placeholder="Cari nama, kode, atau scan barcode..." autocomplete="off" aria-label="Cari produk">
                        </div>
                        <button class="button button-primary" id="searchButton" type="button">Cari</button>
                    </div>
                </div>
                <div class="product-results" id="productResults" aria-live="polite">
                    <div class="product-empty">Memuat produk...</div>
                </div>
            </section>

            <section class="card">
                <div class="card-heading">
                    <span>Keranjang Belanja</span>
                    <span class="item-count" id="itemCount">0 Item</span>
                </div>
                <p class="cart-status" id="cartStatus" role="status" aria-live="polite"></p>
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th class="column-number">No.</th>
                                <th>Produk</th>
                                <th class="text-right">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-right">Subtotal</th>
                                <th class="column-action">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <tr><td class="empty-cart" colspan="6">Keranjang masih kosong.<br>Pilih produk atau scan barcode.</td></tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="card">
                <div class="card-heading">
                    <span>Produk Disimpan</span>
                    <span class="product-count" id="savedItemCount">0 Produk</span>
                </div>
                <div class="saved-cart-list" id="savedCartList"></div>
            </section>
        </section>

        <aside class="card summary-card" aria-label="Ringkasan pembayaran">
            <div class="card-heading">Ringkasan Pembayaran</div>
            <div class="summary-body">
                <div class="field">
                    <label for="customerType">Jenis pelanggan</label>
                    <select class="form-control" id="customerType">
                        <option value="Umum">Umum</option>
                        <option value="Member">Member</option>
                        <option value="Grosir">Grosir</option>
                    </select>
                </div>
                <div class="field">
                    <label for="customerPhone">Nomor telepon (opsional)</label>
                    <input class="form-control" id="customerPhone" type="tel" placeholder="08xx xxxx xxxx">
                </div>
                <div class="summary-row">
                    <span>Jumlah barang</span>
                    <strong id="totalQty">0</strong>
                </div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <strong id="subtotal">Rp 0</strong>
                </div>
                <div class="summary-row">
                    <label for="discountPercent">Diskon (%)</label>
                    <input id="discountPercent" type="number" min="0" max="100" step="1" value="0" aria-label="Diskon persen">
                </div>
                <div class="summary-row">
                    <label for="discountAmount">Diskon (Rp)</label>
                    <input id="discountAmount" type="number" min="0" step="500" value="0" aria-label="Diskon rupiah">
                </div>
                <div class="summary-row">
                    <label for="tax">Pajak (Rp)</label>
                    <input id="tax" type="number" min="0" step="500" value="0" aria-label="Pajak rupiah">
                </div>
                <div class="summary-row">
                    <label for="otherFee">Biaya lain (Rp)</label>
                    <input id="otherFee" type="number" min="0" step="500" value="0" aria-label="Biaya lain rupiah">
                </div>
                <div class="total-box">
                    <div class="total-label">TOTAL PEMBAYARAN</div>
                    <div class="total-value" id="grandTotal">Rp 0</div>
                </div>
                <div class="payment-box">
                    <div class="payment-method" role="group" aria-label="Metode pembayaran">
                        <button class="active" type="button">Tunai</button>
                        <button type="button">QRIS</button>
                        <button type="button">E-Wallet</button>
                    </div>
                    <div class="ewallet-panel" id="ewalletPanel" hidden>
                        <label for="ewalletProvider">Pilih e-wallet</label>
                        <select id="ewalletProvider">
                            <option value="GoPay">GoPay</option>
                            <option value="OVO">OVO</option>
                            <option value="DANA">DANA</option>
                        </select>
                        <span class="demo-note">Pembayaran e-wallet mengikuti pengaturan gateway toko.</span>
                    </div>
                    <label class="payment-label" id="paymentLabel" for="payment">Uang Dibayar</label>
                    <input class="money-input" id="payment" type="number" min="0" step="500" value="0" inputmode="numeric">
                    <div class="change-box" id="changeBox">
                        <div class="change-label" id="changeLabel">KEMBALIAN</div>
                        <div class="change-value" id="change">Rp 0</div>
                    </div>
                </div>
                <div class="action-area">
                    <button class="button button-warning" id="holdButton" type="button">Tahan</button>
                    <button class="button button-danger" id="cancelButton" type="button">Batalkan</button>
                    <button class="button button-pay" id="payButton" type="button">Bayar &amp; Cetak Struk</button>
                </div>
            </div>
        </aside>
    </div>
</main>

<dialog class="ewallet-dialog" id="ewalletDialog">
    <div class="ewallet-dialog-content">
        <h2>Konfirmasi pembayaran</h2>
        <p>Pembayaran e-wallet melalui <strong id="dialogProvider"></strong>.</p>
        <div class="ewallet-dialog-total" id="dialogAmount">Rp 0</div>
        <div class="ewallet-dialog-actions">
            <button class="button button-secondary" id="cancelEwalletButton" type="button">Kembali</button>
            <button class="button button-primary" id="confirmEwalletButton" type="button">Lanjutkan</button>
        </div>
    </div>
</dialog>

<section class="receipt" id="receipt" aria-label="Struk"></section>
<footer class="status-bar">
    <span><strong>ikvimart27 POS</strong> · Kasir: {{ auth()->user()->name ?? 'Kasir' }}</span>
    <span class="status-shortcuts"><span><kbd>F2</kbd> Cari produk</span><span><kbd>F4</kbd> Pembayaran</span><span><kbd>Esc</kbd> Batalkan</span></span>
</footer>
</body>
</html>
