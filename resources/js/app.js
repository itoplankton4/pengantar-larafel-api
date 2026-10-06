import './bootstrap';

const products = [
        { id: 1, code: 'BRG001', barcode: '899123456001', name: 'Indomie Goreng', price: 3500, stock: 40 },
        { id: 2, code: 'BRG002', barcode: '899123456002', name: 'Aqua 600ml', price: 4000, stock: 50 },
        { id: 3, code: 'BRG003', barcode: '899123456003', name: 'Teh Botol Sosro', price: 5000, stock: 35 },
        { id: 4, code: 'BRG004', barcode: '899123456004', name: 'Beras 5 Kg', price: 75000, stock: 20 },
        { id: 5, code: 'BRG005', barcode: '899123456005', name: 'Minyak Goreng 1 Liter', price: 18000, stock: 25 },
        { id: 6, code: 'BRG006', barcode: '899123456006', name: 'Gula Pasir 1 Kg', price: 17000, stock: 30 },
        { id: 7, code: 'BRG007', barcode: '899123456007', name: 'Mie Sedaap Goreng', price: 3500, stock: 45 },
        { id: 8, code: 'BRG008', barcode: '899123456008', name: 'Air Mineral 1.5 Liter', price: 6000, stock: 55 },
        { id: 9, code: 'BRG009', barcode: '899123456009', name: 'Le Minerale 600ml', price: 4000, stock: 40 },
        { id: 10, code: 'BRG010', barcode: '899123456010', name: 'Teh Pucuk Harum 350ml', price: 4000, stock: 38 },
        { id: 11, code: 'BRG011', barcode: '899123456011', name: 'Kopi Kapal Api', price: 1500, stock: 60 },
        { id: 12, code: 'BRG012', barcode: '899123456012', name: 'Susu UHT Cokelat 250ml', price: 6500, stock: 32 },
        { id: 13, code: 'BRG013', barcode: '899123456013', name: 'Roti Tawar', price: 16000, stock: 18 },
        { id: 14, code: 'BRG014', barcode: '899123456014', name: 'Telur Ayam 1 Kg', price: 28000, stock: 22 },
        { id: 15, code: 'BRG015', barcode: '899123456015', name: 'Sabun Mandi', price: 4000, stock: 36 },
        { id: 16, code: 'BRG016', barcode: '899123456016', name: 'Pasta Gigi', price: 12000, stock: 24 },
        { id: 17, code: 'BRG017', barcode: '899123456017', name: 'Tisu Wajah', price: 8000, stock: 28 },
        { id: 18, code: 'BRG018', barcode: '899123456018', name: 'Keripik Kentang', price: 9500, stock: 34 },
        { id: 19, code: 'BRG019', barcode: '899123456019', name: 'Biskuit Cokelat', price: 8500, stock: 31 },
        { id: 20, code: 'BRG020', barcode: '899123456020', name: 'Kecap Manis', price: 13500, stock: 27 },
        { id: 21, code: 'BRG021', barcode: '899123456021', name: 'Saus Sambal', price: 11000, stock: 29 },
        { id: 22, code: 'BRG022', barcode: '899123456022', name: 'Sabun Cuci Piring 750ml', price: 12000, stock: 26 },
        { id: 23, code: 'BRG023', barcode: '899123456023', name: 'Deterjen Bubuk 1 Kg', price: 18000, stock: 21 },
        { id: 24, code: 'BRG024', barcode: '899123456024', name: 'Shampoo Sachet', price: 1000, stock: 70 },
        { id: 25, code: 'BRG025', barcode: '899123456025', name: 'Susu Kental Manis 370ml', price: 13000, stock: 33 },
        { id: 26, code: 'BRG026', barcode: '899123456026', name: 'Kopi Sachet', price: 1500, stock: 68 },
        { id: 27, code: 'BRG027', barcode: '899123456027', name: 'Air Galon Isi Ulang', price: 7000, stock: 18 },
        { id: 28, code: 'BRG028', barcode: '899123456028', name: 'Mi Kuah Ayam Bawang', price: 3500, stock: 42 },
        { id: 29, code: 'BRG029', barcode: '899123456029', name: 'Minuman Cola 390ml', price: 6000, stock: 39 },
        { id: 30, code: 'BRG030', barcode: '899123456030', name: 'Susu UHT Full Cream 1 Liter', price: 19000, stock: 20 },
        { id: 31, code: 'BRG031', barcode: '899123456031', name: 'Yogurt Stroberi 180ml', price: 8000, stock: 25 },
        { id: 32, code: 'BRG032', barcode: '899123456032', name: 'Margarin 200g', price: 7000, stock: 30 },
        { id: 33, code: 'BRG033', barcode: '899123456033', name: 'Tepung Terigu 1 Kg', price: 12000, stock: 23 },
        { id: 34, code: 'BRG034', barcode: '899123456034', name: 'Garam Dapur 500g', price: 4000, stock: 36 },
        { id: 35, code: 'BRG035', barcode: '899123456035', name: 'Sarden Kaleng 155g', price: 14000, stock: 24 },
        { id: 36, code: 'BRG036', barcode: '899123456036', name: 'Wafer Cokelat 140g', price: 9000, stock: 28 },
        { id: 37, code: 'BRG037', barcode: '899123456037', name: 'Tisu Toilet 10 Roll', price: 25000, stock: 17 },
        { id: 38, code: 'BRG038', barcode: '899123456038', name: 'Pembersih Lantai 800ml', price: 14000, stock: 22 },
        { id: 39, code: 'BRG039', barcode: '899123456039', name: 'Baterai AA 2 pcs', price: 15000, stock: 19 },
        { id: 40, code: 'BRG040', barcode: '899123456040', name: 'Madu Murni 250g', price: 28000, stock: 12 },
        { id: 41, code: 'BRG041', barcode: '899123456041', name: 'Spons Cuci Piring 2 pcs', price: 5000, stock: 35 },
        { id: 42, code: 'BRG042', barcode: '899123456042', name: 'Selai Kacang 340g', price: 28000, stock: 14 },
        { id: 43, code: 'ALF-043', barcode: '899123456043', name: 'Kue Ulang Tahun', price: 120000, stock: 8, image: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=900&q=80' },
        { id: 44, code: 'ALF-044', barcode: '899123456044', name: 'Ayam Geprek', price: 22000, stock: 15, image: 'https://images.unsplash.com/photo-1562967916-eb82221dfb92?auto=format&fit=crop&w=900&q=80' },
        { id: 45, code: 'ALF-045', barcode: '899123456045', name: 'Ikan Bakar', price: 25000, stock: 10, image: 'https://images.unsplash.com/photo-1534939561126-855b8675edd7?auto=format&fit=crop&w=900&q=80' },
    ];
    const productImages = [
        'indomie-goreng.jpg', 'aqua-600.jpg', 'teh-botol-sosro.jpg', 'rice.jpg', 'oil.jpg', 'sugar.jpg', 'mie-sedaap.jpg',
        'water.jpg', 'le-minerale.jpg', 'teh-pucuk.jpg', 'kopi-kapal-api.jpg', 'cokelat-uht.jpg', 'bread.jpg', 'eggs.jpg',
        'soap.jpg', 'toothpaste.jpg', 'tissue.jpg', 'chips.jpg', 'cookies.jpg', 'soy-sauce.jpg',
        'chili-sauce.jpg', 'dish-soap.jpg', 'detergent.jpg', 'shampoo.jpg', 'susu-kental-manis.jpg', 'kopi-sachet.jpg', 'gallon.jpg',
        'noodle-soup.jpg', 'cola-bottle.jpg', 'milk-full-cream.jpg', 'yogurt-cup.jpg', 'margarine.jpg', 'flour.jpg', 'salt.jpg',
        'sardines.jpg', 'chocolate-wafer.jpg', 'toilet-tissue.jpg', 'floor-cleaner.jpg', 'aa-batteries.jpg', 'honey.jpg', 'dish-sponge.jpg', 'peanut-butter.jpg',
        'kue-ulang-tahun.svg', 'ayam-geprek.svg', 'ikan-bakar.svg',
    ];
    const realisticProductImages = {
        43: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=900&q=80',
        44: 'https://images.unsplash.com/photo-1562967916-eb82221dfb92?auto=format&fit=crop&w=900&q=80',
        45: 'https://images.unsplash.com/photo-1534939561126-855b8675edd7?auto=format&fit=crop&w=900&q=80',
    };
    const realisticFruitVegetableImages = [
        { keywords: ['apel', 'apple'], image: 'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?auto=format&fit=crop&w=900&q=80' },
        { keywords: ['pisang', 'banana'], image: 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?auto=format&fit=crop&w=900&q=80' },
        { keywords: ['jeruk', 'orange'], image: 'https://images.unsplash.com/photo-1547514701-42782101795e?auto=format&fit=crop&w=900&q=80' },
        { keywords: ['mangga', 'mango'], image: 'https://images.unsplash.com/photo-1553279768-865429fa0078?auto=format&fit=crop&w=900&q=80' },
        { keywords: ['tomat', 'tomato'], image: 'https://images.unsplash.com/photo-1546094096-0df4bcaaa337?auto=format&fit=crop&w=900&q=80' },
        { keywords: ['wortel', 'carrot'], image: 'https://images.unsplash.com/photo-1447175008436-054170c2e979?auto=format&fit=crop&w=900&q=80' },
        { keywords: ['bayam', 'spinach'], image: 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?auto=format&fit=crop&w=900&q=80' },
        { keywords: ['cabai', 'chili', 'pepper'], image: 'https://images.unsplash.com/photo-1582515073490-39981397c445?auto=format&fit=crop&w=900&q=80' },
        { keywords: ['sayur', 'vegetable', 'salad', 'brokoli', 'kale'], image: 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=900&q=80' },
    ];
    const customProductStorageKey = 'vitomart-custom-products';
    const defaultProductImage = '/images/products/product-default.jpg';

    function normalizeProductName(value = '') {
        return String(value)
            .toLowerCase('id')
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
    }

    function getProductImage(product) {
        if (product && product.image) return product.image;
        if (product && product.id && realisticProductImages[product.id]) return realisticProductImages[product.id];

        const productName = normalizeProductName(product?.name || '');
        const fruitVegetableMatch = realisticFruitVegetableImages.find((entry) =>
            entry.keywords.some((keyword) => productName.includes(normalizeProductName(keyword)))
        );
        if (fruitVegetableMatch) return fruitVegetableMatch.image;

        const fallback = product && product.id ? productImages[product.id - 1] : null;
        return fallback ? `/images/products/${fallback}` : defaultProductImage;
    }

    async function loadProductsFromServer() {
        try {
            const response = await fetch('/products', { headers: { Accept: 'application/json' } });
            if (!response.ok) return;
            const serverProducts = await response.json();
            serverProducts.forEach((product) => {
                const existing = products.find((item) => item.id === Number(product.id) || item.code === product.code || item.barcode === product.barcode);
                if (!existing) {
                    products.push({
                        id: Number(product.id),
                        code: product.code,
                        barcode: product.barcode || '',
                        name: product.name,
                        price: Number(product.price),
                        stock: Number(product.stock || 0),
                        image: product.image || defaultProductImage,
                    });
                }
            });
        } catch {
            // Keep fallback product catalog when the backend is unavailable.
        }
    }

    function isAllowedProductImage(image) {
        try {
            return ['http:', 'https:'].includes(new URL(image, window.location.origin).protocol);
        } catch {
            return false;
        }
    }

    function loadCustomProducts() {
        try {
            const savedProducts = JSON.parse(localStorage.getItem(customProductStorageKey) || '[]');
            if (!Array.isArray(savedProducts)) return [];
            return savedProducts.filter((product) => product && Number.isSafeInteger(product.id) && product.id > 0
                && typeof product.name === 'string' && product.name.trim()
                && typeof product.code === 'string' && typeof product.barcode === 'string'
                && Number.isFinite(product.price) && product.price > 0
                && typeof product.image === 'string' && isAllowedProductImage(product.image));
        } catch {
            return [];
        }
    }

    loadCustomProducts().forEach((product) => {
        if (!products.some((existing) => existing.id === product.id || existing.code === product.code || existing.barcode === product.barcode)) {
            products.push({ ...product, isManual: true });
        }
    });
    const savedCartStorageKey = 'vitomart-saved-cart';

    function loadSavedCart() {
        try {
            const items = JSON.parse(localStorage.getItem(savedCartStorageKey) || '[]');
            if (!Array.isArray(items)) return [];
            return items.filter((item) => item && Number.isSafeInteger(item.id) && item.id > 0
                && typeof item.name === 'string' && typeof item.code === 'string'
                && Number.isFinite(item.price) && item.price > 0
                && Number.isSafeInteger(item.qty) && item.qty > 0);
        } catch {
            return [];
        }
    }

    const cart = [];
    const savedCart = loadSavedCart();
    const searchInput = document.getElementById('searchProduct');
    const resultBox = document.getElementById('productResults');
    const rupiah = (value) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value);
    const escapeHtml = (value) => String(value).replace(/[&<>"']/g, (character) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[character]);

    function newTransactionNumber() {
        const date = new Date();
        const stamp = [date.getFullYear(), String(date.getMonth() + 1).padStart(2, '0'), String(date.getDate()).padStart(2, '0')].join('');
        return `TRX-${stamp}-${String(Math.floor(Math.random() * 900) + 100)}`;
    }

    function renderProductResults(matches) {
        resultBox.innerHTML = matches.length ? matches.map((product) => {
            const image = getProductImage(product);
            return `
            <button class="product-result" type="button" data-product-id="${product.id}" aria-label="Tambah ${escapeHtml(product.name)}, ${rupiah(product.price)}">
                <span class="product-art"><img class="product-photo" src="${escapeHtml(image)}" alt="${escapeHtml(product.name)}" loading="lazy" decoding="async"></span>
                <span class="product-info">
                    <span class="product-name">${escapeHtml(product.name)}</span>
                    <span class="product-code">${escapeHtml(product.code)}</span>
                    <span class="product-price">${rupiah(product.price)}</span>
                </span>
            </button>`;
        }).join('') : '<div class="product-empty">Produk tidak ditemukan</div>';
        document.getElementById('productCount').textContent = `${matches.length} Produk`;
        resultBox.querySelectorAll('[data-product-id]').forEach((result) => {
            result.addEventListener('click', () => addToCart(Number(result.dataset.productId)));
        });
    }

    function showAllProducts() {
        renderProductResults(products);
    }

    function searchProducts() {
        const keyword = searchInput.value.trim().toLocaleLowerCase('id');
        if (!keyword) {
            showAllProducts();
            return;
        }
        const matches = products.filter((product) => [product.name, product.code, product.barcode].some((value) => value.toLocaleLowerCase('id').includes(keyword)));
        const exactBarcode = products.find((product) => product.barcode === keyword || product.code.toLocaleLowerCase('id') === keyword);
        if (exactBarcode && /^\d+$/.test(keyword)) {
            addToCart(exactBarcode.id);
            return;
        }
        renderProductResults(matches);
    }

    function addToCart(productId) {
        const product = products.find((item) => item.id === productId);
        if (!product) return;
        const existing = cart.find((item) => item.id === productId);
        if (existing) existing.qty += 1;
        else cart.push({ ...product, qty: 1 });
        searchInput.value = '';
        showAllProducts();
        renderCart();
        searchInput.focus();
    }

    function renderCart() {
        const body = document.getElementById('cartBody');
        if (!cart.length) {
            body.innerHTML = '<tr><td colspan="6" class="empty-cart">Keranjang masih kosong.<br>Pilih produk di katalog atau scan barcode.</td></tr>';
        } else {
            body.innerHTML = cart.map((item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><div class="cart-name">${escapeHtml(item.name)}</div><div class="cart-code">${escapeHtml(item.code)}</div></td>
                    <td class="text-right">${rupiah(item.price)}</td>
                    <td><div class="qty-control"><button type="button" aria-label="Kurangi ${escapeHtml(item.name)}" data-change="-1" data-id="${item.id}">−</button><input type="number" min="1" value="${item.qty}" aria-label="Jumlah ${escapeHtml(item.name)}" data-qty-id="${item.id}"><button type="button" aria-label="Tambah ${escapeHtml(item.name)}" data-change="1" data-id="${item.id}">+</button></div></td>
                    <td class="text-right"><strong>${rupiah(item.price * item.qty)}</strong></td>
                    <td class="text-center"><div class="cart-actions"><button class="save-item-button" type="button" data-save-id="${item.id}">Simpan</button><button class="remove-button" type="button" aria-label="Hapus ${escapeHtml(item.name)} dari checkout" data-remove-id="${item.id}">×</button></div></td>
                </tr>`).join('');
            body.querySelectorAll('[data-change]').forEach((button) => button.addEventListener('click', () => changeQty(Number(button.dataset.id), Number(button.dataset.change))));
            body.querySelectorAll('[data-qty-id]').forEach((input) => input.addEventListener('change', () => updateQty(Number(input.dataset.qtyId), input.value)));
            body.querySelectorAll('[data-remove-id]').forEach((button) => button.addEventListener('click', () => removeItem(Number(button.dataset.removeId))));
            body.querySelectorAll('[data-save-id]').forEach((button) => button.addEventListener('click', () => saveForLater(Number(button.dataset.saveId))));
        }
        calculateTotal();
    }

    function persistSavedCart() {
        try {
            localStorage.setItem(savedCartStorageKey, JSON.stringify(savedCart));
            return true;
        } catch {
            document.getElementById('savedCartList').setAttribute('data-error', 'Penyimpanan browser penuh. Produk belum disimpan.');
            return false;
        }
    }

    function renderSavedCart() {
        const list = document.getElementById('savedCartList');
        list.removeAttribute('data-error');
        document.getElementById('savedItemCount').textContent = `${savedCart.reduce((sum, item) => sum + item.qty, 0)} Produk`;
        if (!savedCart.length) {
            list.innerHTML = '<div class="saved-cart-empty">Belum ada produk yang disimpan.</div>';
            return;
        }
        list.innerHTML = savedCart.map((item) => {
            const image = getProductImage(item);
            return `<div class="saved-cart-item">
                <img class="saved-cart-photo" src="${escapeHtml(image)}" alt="${escapeHtml(item.name)}" loading="lazy">
                <div class="saved-cart-info"><strong>${escapeHtml(item.name)}</strong><span>${item.qty} × ${rupiah(item.price)} · ${rupiah(item.qty * item.price)}</span></div>
                <div class="saved-cart-actions"><button class="restore-saved-button" type="button" data-restore-id="${item.id}">Checkout</button><button class="remove-button" type="button" aria-label="Hapus ${escapeHtml(item.name)} dari simpan nanti" data-delete-saved-id="${item.id}">×</button></div>
            </div>`;
        }).join('');
        list.querySelectorAll('[data-restore-id]').forEach((button) => button.addEventListener('click', () => restoreSavedItem(Number(button.dataset.restoreId))));
        list.querySelectorAll('[data-delete-saved-id]').forEach((button) => button.addEventListener('click', () => deleteSavedItem(Number(button.dataset.deleteSavedId))));
    }

    function saveForLater(id) {
        const cartIndex = cart.findIndex((item) => item.id === id);
        if (cartIndex === -1) return;
        const item = cart[cartIndex];
        const savedItem = savedCart.find((entry) => entry.id === id);
        if (savedItem) savedItem.qty += item.qty;
        else savedCart.push({ ...item });
        if (!persistSavedCart()) {
            if (savedItem) savedItem.qty -= item.qty;
            else savedCart.pop();
            return;
        }
        cart.splice(cartIndex, 1);
        renderCart();
        renderSavedCart();
    }

    function restoreSavedItem(id) {
        const savedIndex = savedCart.findIndex((item) => item.id === id);
        if (savedIndex === -1) return;
        const item = savedCart[savedIndex];
        const cartItem = cart.find((entry) => entry.id === id);
        if (cartItem) cartItem.qty += item.qty;
        else cart.push({ ...item });
        savedCart.splice(savedIndex, 1);
        if (!persistSavedCart()) {
            if (cartItem) cartItem.qty -= item.qty;
            else cart.pop();
            savedCart.splice(savedIndex, 0, item);
            return;
        }
        renderCart();
        renderSavedCart();
    }

    function deleteSavedItem(id) {
        const savedIndex = savedCart.findIndex((item) => item.id === id);
        if (savedIndex === -1) return;
        const [item] = savedCart.splice(savedIndex, 1);
        if (!persistSavedCart()) {
            savedCart.splice(savedIndex, 0, item);
            return;
        }
        renderSavedCart();
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

    async function recordSale(method, paid) {
        const totals = getTotals();
        const response = await fetch(document.querySelector('.pos-shell').dataset.saleUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                transaction_number: document.getElementById('transactionNumber').textContent,
                payment_method: method,
                customer_type: document.getElementById('customerType').value,
                discount_percent: Number(document.getElementById('discountPercent').value) || 0,
                discount_amount: Number(document.getElementById('discountAmount').value) || 0,
                tax: Number(document.getElementById('tax').value) || 0,
                other_fee: Number(document.getElementById('otherFee').value) || 0,
                paid,
                items: cart.map(({ id, code, name, price, qty }) => ({ id, code, name, price, qty })),
            }),
        });
        const result = await response.json().catch(() => ({}));
        if (!response.ok) throw new Error(result.message || 'Penjualan gagal disimpan.');
        return result;
    }

    async function processPayment() {
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
        const payButton = document.getElementById('payButton');
        payButton.disabled = true;
        const receiptWindow = window.open('about:blank', '_blank');
        try {
            const sale = await recordSale(method, paid);
            resetTransaction();
            if (receiptWindow) {
                receiptWindow.location.href = sale.receipt_url;
                receiptWindow.focus();
            } else {
                window.location.href = sale.receipt_url;
            }
        } catch (error) {
            receiptWindow?.close();
            alert(error.message || 'Penjualan belum tersimpan. Periksa koneksi lalu coba lagi.');
        } finally {
            payButton.disabled = false;
        }
    }

    async function initiateGatewayPayment(method, amount) {
        const response = await fetch('/payment/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                amount,
                order_id: document.getElementById('transactionNumber').textContent,
                customer_name: 'Customer',
                customer_email: 'customer@vitomart.local',
                customer_phone: document.getElementById('customerPhone').value || '',
                payment_method: method,
            }),
        });

        const result = await response.json().catch(() => ({}));
        if (!response.ok) throw new Error(result.message || 'Gateway pembayaran gagal diproses.');
        return result;
    }

    function completePayment(method, paid, isDemo = false) {
        const totals = getTotals();
        const receipt = document.getElementById('receipt');
        const demoNotice = isDemo ? '<p class="receipt-demo">SIMULASI - PEMBAYARAN TIDAK DIPROSES</p>' : '';
        receipt.innerHTML = `<h1>VITOMART</h1><p>Jl. Contoh No. 123 · Jember</p>${demoNotice}<div class="receipt-rule"></div><div class="receipt-row"><span>${escapeHtml(document.getElementById('transactionNumber').textContent)}</span><span>${new Date().toLocaleString('id-ID')}</span></div><div class="receipt-rule"></div>${cart.map((item) => `<div class="receipt-item"><div>${escapeHtml(item.name)} × ${item.qty}</div><div class="receipt-row"><span>${rupiah(item.price)} / item</span><strong>${rupiah(item.price * item.qty)}</strong></div></div>`).join('')}<div class="receipt-rule"></div><div class="receipt-row"><span>Subtotal</span><strong>${rupiah(totals.subtotal)}</strong></div><div class="receipt-row"><span>Total</span><strong>${rupiah(totals.grandTotal)}</strong></div><div class="receipt-row"><span>Bayar (${escapeHtml(method)})</span><strong>${rupiah(paid)}</strong></div>${isDemo ? '' : `<div class="receipt-row"><span>Kembalian</span><strong>${rupiah(paid - totals.grandTotal)}</strong></div>`}<div class="receipt-rule"></div><p>Terima kasih telah berbelanja</p>`;
        window.print();
    }

    document.getElementById('searchButton').addEventListener('click', searchProducts);
    searchInput.addEventListener('input', searchProducts);
    searchInput.addEventListener('focus', showAllProducts);
    document.getElementById('productForm').addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.getElementById('newProductName').value.trim();
        const price = Number(document.getElementById('newProductPrice').value);
        const id = Math.max(...products.map((product) => product.id), 0) + 1;
        const code = document.getElementById('newProductCode').value.trim() || `BRG${String(id).padStart(3, '0')}`;
        const barcode = document.getElementById('newProductBarcode').value.trim() || `899123456${String(id).padStart(3, '0')}`;
        const imageInput = document.getElementById('newProductImage').value.trim();
        const image = imageInput ? new URL(imageInput).href : defaultProductImage;
        const status = document.getElementById('productFormStatus');

        if (!Number.isFinite(price) || price <= 0) {
            status.textContent = 'Harga harus lebih dari Rp 0.';
            return;
        }
        if (products.some((product) => product.code.toLocaleLowerCase('id') === code.toLocaleLowerCase('id') || product.barcode === barcode)) {
            status.textContent = 'Kode produk atau barcode sudah digunakan.';
            return;
        }
        if (!name || (imageInput && !isAllowedProductImage(image))) {
            status.textContent = 'Periksa nama produk dan URL foto.';
            return;
        }

        const product = { id, code, barcode, name, price, image, isManual: true };
        const savedProducts = products.filter((item) => item.isManual).concat(product);
        try {
            localStorage.setItem(customProductStorageKey, JSON.stringify(savedProducts));
        } catch {
            status.textContent = 'Produk tidak tersimpan. Penyimpanan browser mungkin penuh.';
            return;
        }
        products.push(product);
        document.getElementById('productForm').reset();
        status.textContent = `${name} berhasil ditambahkan.`;
        searchInput.value = '';
        showAllProducts();
    });
    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            const exact = products.find((product) => product.barcode === searchInput.value.trim() || product.code.toLocaleLowerCase('id') === searchInput.value.trim().toLocaleLowerCase('id'));
            if (exact) addToCart(exact.id);
            else searchProducts();
        }
        if (event.key === 'ArrowDown') resultBox.querySelector('.product-result[tabindex]')?.focus();
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
    document.getElementById('confirmEwalletButton').addEventListener('click', async () => {
        const provider = document.getElementById('ewalletProvider').value;
        const total = getTotals().grandTotal;
        document.getElementById('ewalletDialog').close();
        const payButton = document.getElementById('payButton');
        payButton.disabled = true;

        try {
            const result = await initiateGatewayPayment(`E-Wallet ${provider}`, total);
            if (result && result.demo) {
                completePayment(`E-Wallet ${provider} (Demo)`, total, true);
                return;
            }

            if (result && result.token) {
                alert('Gateway Midtrans berhasil dibuat. Pembayaran akan dilanjutkan ke halaman Midtrans.');
                if (result.redirect_url) {
                    window.location.href = result.redirect_url;
                    return;
                }
            }

            completePayment(`E-Wallet ${provider}`, total, false);
        } catch (error) {
            alert(error.message || 'Pembayaran e-wallet gagal diproses.');
        } finally {
            payButton.disabled = false;
        }
    });
    document.getElementById('holdButton').addEventListener('click', holdTransaction);
    document.getElementById('cancelButton').addEventListener('click', cancelTransaction);
    document.getElementById('payButton').addEventListener('click', processPayment);
    document.addEventListener('keydown', (event) => {
        if (event.key === 'F2') { event.preventDefault(); searchInput.focus(); }
        if (event.key === 'F4') { event.preventDefault(); document.getElementById('payment').focus(); }
        if (event.key === 'Escape') cancelTransaction();
    });
    window.addEventListener('afterprint', resetTransaction);
    document.getElementById('transactionNumber').textContent = newTransactionNumber();
    document.getElementById('currentDate').textContent = new Date().toLocaleString('id-ID');
    loadProductsFromServer().finally(() => {
        showAllProducts();
        renderCart();
        renderSavedCart();
    });
