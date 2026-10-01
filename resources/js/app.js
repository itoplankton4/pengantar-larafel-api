import './bootstrap';

const products = [
        { id: 1, code: 'BRG001', barcode: '899123456001', name: 'Indomie Goreng', price: 3500 },
        { id: 2, code: 'BRG002', barcode: '899123456002', name: 'Aqua 600ml', price: 4000 },
        { id: 3, code: 'BRG003', barcode: '899123456003', name: 'Teh Botol Sosro', price: 5000 },
        { id: 4, code: 'BRG004', barcode: '899123456004', name: 'Beras 5 Kg', price: 75000 },
        { id: 5, code: 'BRG005', barcode: '899123456005', name: 'Minyak Goreng 1 Liter', price: 18000 },
        { id: 6, code: 'BRG006', barcode: '899123456006', name: 'Gula Pasir 1 Kg', price: 17000 },
        { id: 7, code: 'BRG007', barcode: '899123456007', name: 'Mie Sedaap Goreng', price: 3500 },
        { id: 8, code: 'BRG008', barcode: '899123456008', name: 'Air Mineral 1.5 Liter', price: 6000 },
        { id: 9, code: 'BRG009', barcode: '899123456009', name: 'Le Minerale 600ml', price: 4000 },
        { id: 10, code: 'BRG010', barcode: '899123456010', name: 'Teh Pucuk Harum 350ml', price: 4000 },
        { id: 11, code: 'BRG011', barcode: '899123456011', name: 'Kopi Kapal Api', price: 1500 },
        { id: 12, code: 'BRG012', barcode: '899123456012', name: 'Susu UHT Cokelat 250ml', price: 6500 },
        { id: 13, code: 'BRG013', barcode: '899123456013', name: 'Roti Tawar', price: 16000 },
        { id: 14, code: 'BRG014', barcode: '899123456014', name: 'Telur Ayam 1 Kg', price: 28000 },
        { id: 15, code: 'BRG015', barcode: '899123456015', name: 'Sabun Mandi', price: 4000 },
        { id: 16, code: 'BRG016', barcode: '899123456016', name: 'Pasta Gigi', price: 12000 },
        { id: 17, code: 'BRG017', barcode: '899123456017', name: 'Tisu Wajah', price: 8000 },
        { id: 18, code: 'BRG018', barcode: '899123456018', name: 'Keripik Kentang', price: 9500 },
        { id: 19, code: 'BRG019', barcode: '899123456019', name: 'Biskuit Cokelat', price: 8500 },
        { id: 20, code: 'BRG020', barcode: '899123456020', name: 'Kecap Manis', price: 13500 },
        { id: 21, code: 'BRG021', barcode: '899123456021', name: 'Saus Sambal', price: 11000 },
        { id: 22, code: 'BRG022', barcode: '899123456022', name: 'Sabun Cuci Piring 750ml', price: 12000 },
        { id: 23, code: 'BRG023', barcode: '899123456023', name: 'Deterjen Bubuk 1 Kg', price: 18000 },
        { id: 24, code: 'BRG024', barcode: '899123456024', name: 'Shampoo Sachet', price: 1000 },
        { id: 25, code: 'BRG025', barcode: '899123456025', name: 'Susu Kental Manis 370ml', price: 13000 },
        { id: 26, code: 'BRG026', barcode: '899123456026', name: 'Kopi Sachet', price: 1500 },
        { id: 27, code: 'BRG027', barcode: '899123456027', name: 'Air Galon Isi Ulang', price: 7000 },
    ];
    const cart = [];
    const searchInput = document.getElementById('searchProduct');
    const resultBox = document.getElementById('productResults');
    const rupiah = (value) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value);
    const escapeHtml = (value) => String(value).replace(/[&<>"']/g, (character) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[character]);

    function newTransactionNumber() {
        const date = new Date();
        const stamp = [date.getFullYear(), String(date.getMonth() + 1).padStart(2, '0'), String(date.getDate()).padStart(2, '0')].join('');
        return `TRX-${stamp}-${String(Math.floor(Math.random() * 900) + 100)}`;
    }

    function searchProducts() {
        const keyword = searchInput.value.trim().toLocaleLowerCase('id');
        if (!keyword) {
            resultBox.style.display = 'none';
            return;
        }
        const matches = products.filter((product) => [product.name, product.code, product.barcode].some((value) => value.toLocaleLowerCase('id').includes(keyword)));
        const exactBarcode = products.find((product) => product.barcode === keyword || product.code.toLocaleLowerCase('id') === keyword);
        if (exactBarcode && /^\d+$/.test(keyword)) {
            addToCart(exactBarcode.id);
            return;
        }
        resultBox.innerHTML = matches.length ? matches.map((product) => `
            <div class="product-result" role="option" tabindex="0" data-product-id="${product.id}">
                <div><div class="product-name">${escapeHtml(product.name)}</div><div class="product-code">${escapeHtml(product.code)} · ${escapeHtml(product.barcode)}</div></div>
                <div class="product-price">${rupiah(product.price)}</div>
            </div>`).join('') : '<div class="product-result">Barang tidak ditemukan</div>';
        resultBox.style.display = 'block';
        resultBox.querySelectorAll('[data-product-id]').forEach((result) => {
            result.addEventListener('click', () => addToCart(Number(result.dataset.productId)));
            result.addEventListener('keydown', (event) => { if (event.key === 'Enter') addToCart(Number(result.dataset.productId)); });
        });
    }

    function addToCart(productId) {
        const product = products.find((item) => item.id === productId);
        if (!product) return;
        const existing = cart.find((item) => item.id === productId);
        if (existing) existing.qty += 1;
        else cart.push({ ...product, qty: 1 });
        searchInput.value = '';
        resultBox.style.display = 'none';
        renderCart();
        searchInput.focus();
    }

    function renderCart() {
        const body = document.getElementById('cartBody');
        if (!cart.length) {
            body.innerHTML = '<tr><td colspan="6" class="empty-cart">Keranjang masih kosong.<br>Silakan cari atau scan barang.</td></tr>';
        } else {
            body.innerHTML = cart.map((item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><div class="cart-name">${escapeHtml(item.name)}</div><div class="cart-code">${escapeHtml(item.code)}</div></td>
                    <td class="text-right">${rupiah(item.price)}</td>
                    <td><div class="qty-control"><button type="button" aria-label="Kurangi ${escapeHtml(item.name)}" data-change="-1" data-id="${item.id}">−</button><input type="number" min="1" value="${item.qty}" aria-label="Jumlah ${escapeHtml(item.name)}" data-qty-id="${item.id}"><button type="button" aria-label="Tambah ${escapeHtml(item.name)}" data-change="1" data-id="${item.id}">+</button></div></td>
                    <td class="text-right"><strong>${rupiah(item.price * item.qty)}</strong></td>
                    <td class="text-center"><button class="remove-button" type="button" aria-label="Hapus ${escapeHtml(item.name)}" data-remove-id="${item.id}">×</button></td>
                </tr>`).join('');
            body.querySelectorAll('[data-change]').forEach((button) => button.addEventListener('click', () => changeQty(Number(button.dataset.id), Number(button.dataset.change))));
            body.querySelectorAll('[data-qty-id]').forEach((input) => input.addEventListener('change', () => updateQty(Number(input.dataset.qtyId), input.value)));
            body.querySelectorAll('[data-remove-id]').forEach((button) => button.addEventListener('click', () => removeItem(Number(button.dataset.removeId))));
        }
        calculateTotal();
    }

    function changeQty(id, amount) {
        const item = cart.find((entry) => entry.id === id);
        if (!item) return;
        item.qty += amount;
        if (item.qty <= 0) removeItem(id);
        else renderCart();
    }

    function updateQty(id, value) {
        const item = cart.find((entry) => entry.id === id);
        if (!item) return;
        item.qty = Math.max(1, Number.parseInt(value, 10) || 1);
        renderCart();
    }

    function removeItem(id) {
        const index = cart.findIndex((entry) => entry.id === id);
        if (index !== -1) cart.splice(index, 1);
        renderCart();
    }

    function getTotals() {
        const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
        const percent = Math.min(100, Math.max(0, Number(document.getElementById('discountPercent').value) || 0));
        const discount = subtotal * percent / 100 + Math.max(0, Number(document.getElementById('discountAmount').value) || 0);
        const tax = Math.max(0, Number(document.getElementById('tax').value) || 0);
        const fee = Math.max(0, Number(document.getElementById('otherFee').value) || 0);
        return { subtotal, grandTotal: Math.max(0, Math.round(subtotal - discount + tax + fee)), qty: cart.reduce((sum, item) => sum + item.qty, 0) };
    }

    function calculateTotal() {
        const totals = getTotals();
        document.getElementById('totalQty').textContent = totals.qty;
        document.getElementById('itemCount').textContent = `${totals.qty} Item`;
        document.getElementById('subtotal').textContent = rupiah(totals.subtotal);
        document.getElementById('grandTotal').textContent = rupiah(totals.grandTotal);
        calculateChange();
    }

    function calculateChange() {
        const total = getTotals().grandTotal;
        const isEwallet = document.querySelector('.payment-method button.active').textContent.trim() === 'E-Wallet';
        const paymentInput = document.getElementById('payment');
        const changeBox = document.getElementById('changeBox');
        document.getElementById('paymentLabel').textContent = isEwallet ? 'Total E-Wallet' : 'Uang Dibayar';
        paymentInput.readOnly = isEwallet;
        if (isEwallet) {
            paymentInput.value = total;
            changeBox.hidden = true;
            return;
        }
        changeBox.hidden = false;
        const payment = Math.max(0, Number(document.getElementById('payment').value) || 0);
        const difference = payment - total;
        changeBox.classList.toggle('short-payment', difference < 0 && payment > 0);
        document.getElementById('changeLabel').textContent = difference < 0 && payment > 0 ? 'UANG KURANG' : 'KEMBALIAN';
        document.getElementById('change').textContent = rupiah(Math.abs(difference));
    }

    function resetTransaction() {
        cart.splice(0, cart.length);
        ['payment', 'discountPercent', 'discountAmount', 'tax', 'otherFee', 'customerPhone'].forEach((id) => {
            const input = document.getElementById(id);
            input.value = id === 'customerPhone' ? '' : '0';
        });
        document.getElementById('customerType').selectedIndex = 0;
        document.querySelectorAll('.payment-method button').forEach((button) => button.classList.toggle('active', button.textContent.trim() === 'Tunai'));
        document.getElementById('ewalletPanel').hidden = true;
        document.getElementById('ewalletDialog').close();
        renderCart();
        document.getElementById('transactionNumber').textContent = newTransactionNumber();
    }

    function holdTransaction() {
        if (!cart.length) {
            alert('Tidak ada transaksi untuk ditahan.');
            return;
        }
        const held = JSON.parse(localStorage.getItem('kasir-held-transactions') || '[]');
        held.push({ number: document.getElementById('transactionNumber').textContent, items: cart.map((item) => ({ ...item })), customer: document.getElementById('customerType').value, createdAt: new Date().toISOString() });
        localStorage.setItem('kasir-held-transactions', JSON.stringify(held));
        alert('Transaksi disimpan di browser. Silakan lanjutkan dengan transaksi baru.');
        resetTransaction();
    }

    function cancelTransaction() {
        if (!cart.length && !Number(document.getElementById('payment').value)) return;
        if (!confirm('Batalkan transaksi ini?')) return;
        resetTransaction();
    }

    function processPayment() {
        if (!cart.length) {
            alert('Keranjang masih kosong.');
            return;
        }
        const totals = getTotals();
        const method = document.querySelector('.payment-method button.active').textContent.trim();
        if (method === 'E-Wallet') {
            document.getElementById('dialogProvider').textContent = document.getElementById('ewalletProvider').value;
            document.getElementById('dialogAmount').textContent = rupiah(totals.grandTotal);
            document.getElementById('ewalletDialog').showModal();
            return;
        }
        const paid = Number(document.getElementById('payment').value) || 0;
        if (paid < totals.grandTotal) {
            document.getElementById('payment').focus();
            alert('Uang pembayaran masih kurang.');
            return;
        }
        completePayment(method, paid);
    }

    function completePayment(method, paid, isDemo = false) {
        const totals = getTotals();
        const receipt = document.getElementById('receipt');
        const demoNotice = isDemo ? '<p class="receipt-demo">SIMULASI - PEMBAYARAN TIDAK DIPROSES</p>' : '';
        receipt.innerHTML = `<h1>TOKO RETAIL VITOXX</h1><p>Jl. Contoh No. 123 · Jember</p>${demoNotice}<div class="receipt-rule"></div><div class="receipt-row"><span>${escapeHtml(document.getElementById('transactionNumber').textContent)}</span><span>${new Date().toLocaleString('id-ID')}</span></div><div class="receipt-rule"></div>${cart.map((item) => `<div class="receipt-item"><div>${escapeHtml(item.name)} × ${item.qty}</div><div class="receipt-row"><span>${rupiah(item.price)} / item</span><strong>${rupiah(item.price * item.qty)}</strong></div></div>`).join('')}<div class="receipt-rule"></div><div class="receipt-row"><span>Subtotal</span><strong>${rupiah(totals.subtotal)}</strong></div><div class="receipt-row"><span>Total</span><strong>${rupiah(totals.grandTotal)}</strong></div><div class="receipt-row"><span>Bayar (${escapeHtml(method)})</span><strong>${rupiah(paid)}</strong></div>${isDemo ? '' : `<div class="receipt-row"><span>Kembalian</span><strong>${rupiah(paid - totals.grandTotal)}</strong></div>`}<div class="receipt-rule"></div><p>Terima kasih telah berbelanja</p>`;
        window.print();
    }

    document.getElementById('searchButton').addEventListener('click', searchProducts);
    searchInput.addEventListener('input', searchProducts);
    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            const exact = products.find((product) => product.barcode === searchInput.value.trim() || product.code.toLocaleLowerCase('id') === searchInput.value.trim().toLocaleLowerCase('id'));
            if (exact) addToCart(exact.id);
            else searchProducts();
        }
        if (event.key === 'ArrowDown') resultBox.querySelector('.product-result[tabindex]')?.focus();
    });
    document.addEventListener('click', (event) => {
        if (!event.target.closest('.search-wrap') && event.target.id !== 'searchButton') resultBox.style.display = 'none';
    });
    ['discountPercent', 'discountAmount', 'tax', 'otherFee'].forEach((id) => document.getElementById(id).addEventListener('input', calculateTotal));
    document.getElementById('payment').addEventListener('input', calculateChange);
    document.querySelectorAll('.payment-method button').forEach((button) => button.addEventListener('click', () => {
        const wasEwallet = document.querySelector('.payment-method button.active').textContent.trim() === 'E-Wallet';
        document.querySelectorAll('.payment-method button').forEach((option) => option.classList.remove('active'));
        button.classList.add('active');
        const isEwallet = button.textContent.trim() === 'E-Wallet';
        document.getElementById('ewalletPanel').hidden = !isEwallet;
        if (!isEwallet && wasEwallet) document.getElementById('payment').value = '';
        calculateChange();
    }));
    document.getElementById('cancelEwalletButton').addEventListener('click', () => document.getElementById('ewalletDialog').close());
    document.getElementById('confirmEwalletButton').addEventListener('click', () => {
        const provider = document.getElementById('ewalletProvider').value;
        document.getElementById('ewalletDialog').close();
        completePayment(`E-Wallet ${provider} (Demo)`, getTotals().grandTotal, true);
    });
    document.getElementById('holdButton').addEventListener('click', holdTransaction);
    document.getElementById('cancelButton').addEventListener('click', cancelTransaction);
    document.getElementById('payButton').addEventListener('click', processPayment);
    document.addEventListener('keydown', (event) => {
        if (event.key === 'F2') { event.preventDefault(); searchInput.focus(); }
        if (event.key === 'F4') { event.preventDefault(); document.getElementById('payment').focus(); }
        if (event.key === 'Escape') { resultBox.style.display = 'none'; cancelTransaction(); }
    });
    window.addEventListener('afterprint', resetTransaction);
    document.getElementById('transactionNumber').textContent = newTransactionNumber();
    document.getElementById('currentDate').textContent = new Date().toLocaleString('id-ID');
    renderCart();
