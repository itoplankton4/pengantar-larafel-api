<!-- === KANVAS/CARD KERANJANG CHECKOUT INTERAKTIF MODERN === -->
<<script>
    // Array penampung item keranjang belanja kasir
    let cart = [];

    // Fungsi utama yang dipicu otomatis saat gambar produk diklik
    function addToCart(id, name, price) {
        let existingItem = cart.find(item => item.id === id);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: id,
                name: name,
                price: parseInt(price),
                quantity: 1
            });
        }
        updateCartUI();
    }

    // Fungsi otomatis merender data ke dalam tabel Keranjang Belanja utama
    function updateCartUI() {
        const cartTableBody = document.querySelector('table tbody');
        
        if (!cartTableBody) return;

        if (cart.length === 0) {
            cartTableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        Keranjang masih kosong.<br>Silakan cari atau scan barang.
                    </td>
                </tr>`;
            document.querySelector('.card-header span:last-child').innerText = '0 Item';
            updateSummary(0);
            return;
        }

        let htmlContent = '';
        let totalItemsCount = 0;
        let totalCartPrice = 0;

        cart.forEach((item, index) => {
            let subtotal = item.price * item.quantity;
            totalItemsCount += item.quantity;
            totalCartPrice += subtotal;

            htmlContent += `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td class="font-weight-bold">${item.name}</td>
                    <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="changeQty(${index}, -1)">-</button>
                            <span class="mx-2 font-weight-bold">${item.quantity}</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="changeQty(${index}, 1)">+</button>
                        </div>
                    </td>
                    <td class="text-right font-weight-bold text-success">Rp ${subtotal.toLocaleString('id-ID')}</td>
                </tr>`;
        });

        cartTableBody.innerHTML = htmlContent;
        
        // Memperbarui badge jumlah item (misal: "3 Item") di kanan atas tabel
        const badgeCount = document.querySelector('.card-header span:last-child');
        if (badgeCount) badgeCount.innerText = `${totalItemsCount} Item`;

        updateSummary(totalCartPrice);
    }

    function changeQty(index, amount) {
        cart[index].quantity += amount;
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        updateCartUI();
    }

    // Fungsi otomatis memperbarui total harga pada panel "Ringkasan Pembayaran" kanan
    function updateSummary(totalPrice) {
        const subtotalText = document.querySelector('.card-body .d-flex:nth-child(2) span:last-child');
        const grandTotalText = document.querySelector('h1.font-weight-bold') || document.querySelector('.text-primary.font-weight-bold');
        
        if (subtotalText) subtotalText.innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        if (grandTotalText) grandTotalText.innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        
        calculateReturn(totalPrice);
    }

    // Fungsi otomatis menghitung uang kembalian di box hijau bawah
    function calculateReturn(totalPrice) {
        const cashInput = document.querySelector('input[type="number"]') || document.getElementById('cash-amount');
        const returnText = document.querySelector('.bg-success-light span:last-child') || document.querySelector('.text-success.font-weight-bold');
        
        if (!cashInput || !returnText) return;

        let cashAmount = parseInt(cashInput.value) || 0;

        if (cashAmount >= totalPrice && totalPrice > 0) {
            let change = cashAmount - totalPrice;
            returnText.innerText = `Rp ${change.toLocaleString('id-ID')}`;
        } else {
            returnText.innerText = `Rp 0`;
        }
    }

    // Mengaktifkan kalkulator otomatis saat nominal "Uang Dibayar" diketik oleh kasir
    document.addEventListener('DOMContentLoaded', function() {
        const cashInputEvent = document.querySelector('input[type="number"]');
        if (cashInputEvent) {
            cashInputEvent.addEventListener('input', function() {
                const grandTotalText = document.querySelector('h1.font-weight-bold') || document.getElementById('cart-total-price');
                let totalPrice = parseInt(grandTotalText.innerText.replace(/[^0-9]/g, '')) || 0;
                calculateReturn(totalPrice);
            });
        }
    });

    // Menangkap tombol fisik keyboard F4 untuk memicu cetak struk (Acara 35)
    document.addEventListener('keydown', function(event) {
        if (event.key === 'F4') {
            event.preventDefault();
            window.open("{{ route('print.receipt') }}", "_blank");
        }
    });
</script>
<script>
    // Array penampung item keranjang belanja kasir
    let cart = [];

    // Fungsi utama yang dipicu otomatis saat gambar produk diklik
    function addToCart(id, name, price) {
        let existingItem = cart.find(item => item.id === id);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: id,
                name: name,
                price: parseInt(price),
                quantity: 1
            });
        }
        updateCartUI();
    }

    // Fungsi otomatis merender data ke dalam tabel Keranjang Belanja utama
    function updateCartUI() {
        const cartTableBody = document.querySelector('table tbody');
        
        if (!cartTableBody) return;

        if (cart.length === 0) {
            cartTableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        Keranjang masih kosong.<br>Silakan cari atau scan barang.
                    </td>
                </tr>`;
            document.querySelector('.card-header span:last-child').innerText = '0 Item';
            updateSummary(0);
            return;
        }

        let htmlContent = '';
        let totalItemsCount = 0;
        let totalCartPrice = 0;

        cart.forEach((item, index) => {
            let subtotal = item.price * item.quantity;
            totalItemsCount += item.quantity;
            totalCartPrice += subtotal;

            htmlContent += `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td class="font-weight-bold">${item.name}</td>
                    <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="changeQty(${index}, -1)">-</button>
                            <span class="mx-2 font-weight-bold">${item.quantity}</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="changeQty(${index}, 1)">+</button>
                        </div>
                    </td>
                    <td class="text-right font-weight-bold text-success">Rp ${subtotal.toLocaleString('id-ID')}</td>
                </tr>`;
        });

        cartTableBody.innerHTML = htmlContent;
        
        // Memperbarui badge jumlah item (misal: "3 Item") di kanan atas tabel
        const badgeCount = document.querySelector('.card-header span:last-child');
        if (badgeCount) badgeCount.innerText = `${totalItemsCount} Item`;

        updateSummary(totalCartPrice);
    }

    function changeQty(index, amount) {
        cart[index].quantity += amount;
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        updateCartUI();
    }

    // Fungsi otomatis memperbarui total harga pada panel "Ringkasan Pembayaran" kanan
    function updateSummary(totalPrice) {
        const subtotalText = document.querySelector('.card-body .d-flex:nth-child(2) span:last-child');
        const grandTotalText = document.querySelector('h1.font-weight-bold') || document.querySelector('.text-primary.font-weight-bold');
        
        if (subtotalText) subtotalText.innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        if (grandTotalText) grandTotalText.innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        
        calculateReturn(totalPrice);
    }

    // Fungsi otomatis menghitung uang kembalian di box hijau bawah
    function calculateReturn(totalPrice) {
        const cashInput = document.querySelector('input[type="number"]') || document.getElementById('cash-amount');
        const returnText = document.querySelector('.bg-success-light span:last-child') || document.querySelector('.text-success.font-weight-bold');
        
        if (!cashInput || !returnText) return;

        let cashAmount = parseInt(cashInput.value) || 0;

        if (cashAmount >= totalPrice && totalPrice > 0) {
            let change = cashAmount - totalPrice;
            returnText.innerText = `Rp ${change.toLocaleString('id-ID')}`;
        } else {
            returnText.innerText = `Rp 0`;
        }
    }

    // Mengaktifkan kalkulator otomatis saat nominal "Uang Dibayar" diketik oleh kasir
    document.addEventListener('DOMContentLoaded', function() {
        const cashInputEvent = document.querySelector('input[type="number"]');
        if (cashInputEvent) {
            cashInputEvent.addEventListener('input', function() {
                const grandTotalText = document.querySelector('h1.font-weight-bold') || document.getElementById('cart-total-price');
                let totalPrice = parseInt(grandTotalText.innerText.replace(/[^0-9]/g, '')) || 0;
                calculateReturn(totalPrice);
            });
        }
    });

    // Menangkap tombol fisik keyboard F4 untuk memicu cetak struk (Acara 35)
    document.addEventListener('keydown', function(event) {
        if (event.key === 'F4') {
            event.preventDefault();
            window.open("{{ route('print.receipt') }}", "_blank");
        }
    });
</script>
