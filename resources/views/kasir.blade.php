<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f2f4f7">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir | VitoMart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<div class="pos-shell" data-sale-url="{{ route('sales.store') }}">
    <header class="topbar">
        <div>
            <h1 class="store-name">{{ strtoupper($store->name ?? 'VITOMART') }}</h1>
            <div class="store-meta">{{ $store->address ?? 'Jl. Contoh No. 123' }} · {{ $store->city ?? 'Jember' }} · Telp. {{ $store->phone ?? '0812-xxxx-xxxx' }}</div>
        </div>
        <div class="header-actions">
            @if(Auth::user()?->role === 'admin')
                <a class="profile-back secondary" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            @endif
            <a class="profile-back" href="{{ route('logout.confirm') }}">Keluar</a>
        </div>
        <div class="transaction-meta">
            No. Transaksi
            <strong class="transaction-number" id="transactionNumber"></strong>
            <span id="currentDate"></span>
        </div>
    </header>

    <main class="work-area">
        <section class="left-column" aria-label="Barang dan keranjang belanja">
            <div class="card">
                <div class="card-heading">
                    <span>Katalog Produk</span>
                    <span class="product-count" id="productCount">0 Produk</span>
                </div>
                <div class="card-body">
                    <details class="product-editor">
                        <summary>Tambah produk manual</summary>
                        <form class="product-form" id="productForm">
                            <div class="product-form-grid">
                                <div class="field">
                                    <label for="newProductName">Nama produk</label>
                                    <input class="form-control" id="newProductName" type="text" maxlength="80" required>
                                </div>
                                <div class="field">
                                    <label for="newProductPrice">Harga (Rp)</label>
                                    <input class="form-control" id="newProductPrice" type="number" min="1" step="1" required>
                                </div>
                                <div class="field">
                                    <label for="newProductCode">Kode produk</label>
                                    <input class="form-control" id="newProductCode" type="text" maxlength="20" placeholder="Otomatis jika kosong">
                                </div>
                                <div class="field">
                                    <label for="newProductBarcode">Barcode</label>
                                    <input class="form-control" id="newProductBarcode" type="text" maxlength="40" placeholder="Opsional">
                                </div>
                                <div class="field">
                                    <label for="newProductImage">URL foto</label>
                                    <input class="form-control" id="newProductImage" type="url" placeholder="Opsional">
                                </div>
                            </div>
                            <button class="button button-primary" type="submit">Simpan Produk</button>
                            <p class="product-form-status" id="productFormStatus" role="status" aria-live="polite"></p>
                        </form>
                    </details>
                    <div class="search-row">
                        <div class="search-wrap">
                            <input class="search-input" type="search" id="searchProduct" placeholder="Cari produk, kode, atau barcode..." autocomplete="off" aria-label="Cari barang">
                        </div>
                        <button class="button button-primary" id="searchButton" type="button">Cari</button>
                    </div>
                    <div class="customer-grid">
                        <div class="field">
                            <label for="customerType">Pelanggan</label>
                            <select class="form-control" id="customerType">
                                <option>Umum</option>
                                <option>Pelanggan Member</option>
                                <option>Member VIP</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="customerPhone">No. Member / HP</label>
                            <input class="form-control" id="customerPhone" type="text" placeholder="Opsional">
                        </div>
                    </div>
                </div>
                <div class="product-results" id="productResults" aria-label="Daftar produk"></div>
            </div>

            <div class="card">
                <div class="card-heading">
                    <span>Keranjang Checkout</span>
                    <span class="item-count" id="itemCount">0 Item</span>
                </div>
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th class="column-number">No</th>
                                <th>Barang</th>
                                <th class="text-right">Harga</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Subtotal</th>
                                <th class="text-center column-action">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <tr><td colspan="6" class="empty-cart">Keranjang masih kosong.<br>Silakan cari atau scan barang.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card saved-cart-card">
                <div class="card-heading">
                    <span>Simpan untuk Nanti</span>
                    <span class="item-count" id="savedItemCount">0 Produk</span>
                </div>
                <div class="saved-cart-list" id="savedCartList" aria-live="polite">
                    <div class="saved-cart-empty">Belum ada produk yang disimpan.</div>
                </div>
            </div>
        </section>

        <aside class="card summary-card" aria-label="Ringkasan pembayaran">
            <div class="card-heading">Ringkasan Pembayaran</div>
            <div class="summary-body">
                <div class="summary-row"><span>Total Item</span><strong id="totalQty">0</strong></div>
                <div class="summary-row"><span>Subtotal</span><strong id="subtotal">Rp 0</strong></div>
                <label class="summary-row" for="discountPercent"><span>Diskon (%)</span><input type="number" id="discountPercent" value="0" min="0" max="100" step="0.1"></label>
                <label class="summary-row" for="discountAmount"><span>Diskon (Rp)</span><input type="number" id="discountAmount" value="0" min="0" step="500"></label>
                <label class="summary-row" for="tax"><span>Pajak / PPN</span><input type="number" id="tax" value="0" min="0" step="500"></label>
                <label class="summary-row" for="otherFee"><span>Biaya Lain</span><input type="number" id="otherFee" value="0" min="0" step="500"></label>
                <div class="total-box">
                    <div class="total-label">TOTAL AKHIR</div>
                    <div class="total-value" id="grandTotal">Rp 0</div>
                </div>
                <div class="payment-box">
                    <label class="payment-label" id="paymentLabel" for="payment">Uang Dibayar</label>
                    <input class="money-input" type="number" id="payment" min="0" step="500" placeholder="0" inputmode="numeric">
                    <div class="payment-label">Metode Pembayaran</div>
                    <div class="payment-method" role="group" aria-label="Metode pembayaran">
                        <button class="active" type="button">Tunai</button>
                        <button type="button">QRIS</button>
                        <button type="button">Debit</button>
                        <button type="button">Kredit</button>
                        <button type="button">E-Wallet</button>
                        <button type="button">Transfer</button>
                    </div>
                    <div class="ewallet-panel" id="ewalletPanel" hidden>
                        <label for="ewalletProvider">Pilih E-Wallet</label>
                        <select id="ewalletProvider">
                            <option>GoPay</option>
                            <option>OVO</option>
                            <option>DANA</option>
                            <option>ShopeePay</option>
                            <option>LinkAja</option>
                        </select>
                        <small class="demo-note">Mode demo: pembayaran tidak dikirim ke aplikasi E-Wallet.</small>
                    </div>
                    <div class="change-box" id="changeBox" aria-live="polite">
                        <div class="change-label" id="changeLabel">KEMBALIAN</div>
                        <div class="change-value" id="change">Rp 0</div>
                    </div>
                </div>
                <div class="action-area">
                    <button class="button button-warning" id="holdButton" type="button">Tahan</button>
                    <button class="button button-danger" id="cancelButton" type="button">Batal</button>
                    <button class="button button-pay" id="payButton" type="button">Bayar &amp; Cetak</button>
                </div>
            </div>
        </aside>
    </main>
</div>
<dialog class="ewallet-dialog" id="ewalletDialog" aria-labelledby="ewalletDialogTitle">
    <div class="ewallet-dialog-content">
        <h2 id="ewalletDialogTitle">Pembayaran E-Wallet (Demo)</h2>
        <p>Konfirmasi ini hanya untuk menguji alur kasir. Tidak ada saldo yang dipotong dan tidak ada pembayaran sungguhan.</p>
        <div class="ewallet-dialog-total"><span id="dialogProvider">GoPay</span> · <span id="dialogAmount">Rp 0</span></div>
        <div class="ewallet-dialog-actions">
            <button class="button button-secondary" id="cancelEwalletButton" type="button">Kembali</button>
            <button class="button button-primary" id="confirmEwalletButton" type="button">Konfirmasi Demo</button>
        </div>
    </div>
</dialog>
<footer class="status-bar">
    <span>Kasir: <strong>Admin</strong></span>
    <span class="status-shortcuts"><span><kbd>F2</kbd> Cari Barang</span><span><kbd>F4</kbd> Bayar</span><span><kbd>ESC</kbd> Batal</span></span>
</footer>
<section class="receipt" id="receipt" aria-hidden="true"></section>


</body>
</html>