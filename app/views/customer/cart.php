<?php require_once '../app/views/layouts/customer/header.php'; ?>

<?php if (isset($_SESSION['error'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Checkout',
                text: "<?= $_SESSION['error'] ?>"
            });
        });
    </script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mb-4 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0L4 5M7 13h10m0 0v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                <?= $title ?>
            </h1>
            <p class="text-gray-600 text-lg">Kelola produk dalam keranjang belanja Anda</p>
        </div>

        <?php if (empty($cartItems)) : ?>
            <!-- Empty Cart State -->
            <div class="max-w-md mx-auto text-center bg-white rounded-2xl shadow-xl p-12">
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0L4 5M7 13h10m0 0v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Keranjang Kosong</h3>
                    <p class="text-gray-500">Keranjang kamu kosong. Yuk, belanja dulu! 🛒</p>
                </div>
                <a href="<?= BASE_URL ?>/dashboardcustomer/products" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Mulai Belanja
                </a>
            </div>
        <?php else : ?>
            <form method="POST" action="<?= BASE_URL ?>/order/checkoutcart" class="max-w-7xl mx-auto">
                <!-- Cart Items -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Produk dalam Keranjang
                        </h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Produk</th>
                                    <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Harga</th>
                                    <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Jumlah</th>
                                    <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Subtotal</th>
                                    <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php $total = 0; ?>
                                <?php foreach ($cartItems as $item) : ?>
                                    <?php $subtotal = $item['price'] * $item['quantity']; ?>
                                    <?php $total += $subtotal; ?>
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="py-6 px-6">
                                            <div class="flex items-center">
                                                <div class="relative">
                                                    <img src="<?= BASE_URL ?>/image/<?= $item['image'] ?>" alt="<?= $item['product_name'] ?>" class="w-20 h-20 object-cover rounded-xl shadow-md">
                                                    <div class="absolute inset-0 bg-opacity-0 hover:bg-opacity-10 rounded-xl transition-all duration-300"></div>
                                                </div>
                                                <div class="ml-4">
                                                    <h3 class="text-lg font-semibold text-gray-800"><?= $item['product_name'] ?></h3>
                                                    <p class="text-sm text-gray-500">Produk berkualitas tinggi</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-6 px-6 text-center">
                                            <span class="text-lg font-semibold text-gray-800">Rp<?= number_format($item['price'], 0, ',', '.') ?></span>
                                        </td>
                                        <td class="py-6 px-6 text-center">
                                            <div class="inline-flex items-center">
                                                <input 
                                                    type="number" 
                                                    name="quantity[]" 
                                                    min="1" 
                                                    value="<?= $item['quantity'] ?>" 
                                                    class="w-20 text-center border-2 border-gray-200 rounded-lg p-2 quantity-input focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                                                    data-price="<?= $item['price'] ?>">                                   
                                                <input type="hidden" name="product_id[]" value="<?= $item['product_id'] ?>">
                                            </div>
                                        </td>
                                        <td class="py-6 px-6 text-center">
                                            <span class="text-lg font-bold text-green-600 item-subtotal" data-subtotal="<?= $subtotal ?>">
                                                Rp<?= number_format($subtotal, 0, ',', '.') ?>
                                            </span>
                                        </td>
                                        <td class="py-6 px-6 text-center">
                                            <a href="<?= BASE_URL ?>/cart/remove/<?= $item['id'] ?>" class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-all duration-300 hover:shadow-md">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Checkout Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Shipping & Payment Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Shipping Information -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800">Informasi Pengiriman</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Pengiriman</label>
                                    <input type="text" name="alamat" required class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" placeholder="Masukkan alamat lengkap">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">No HP</label>
                                    <input type="text" name="no_hp" required class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" placeholder="Contoh: 08123456789">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Metode Pengiriman</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div class="relative">
                                            <input type="radio" name="delivery" id="jne_reg" value="JNE Reguler" class="peer sr-only" required>
                                            <label for="jne_reg" class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-300">
                                                <div class="w-6 h-6 border-2 border-gray-300 rounded-full mr-3 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-gray-800">JNE Reguler</span>
                                                    <p class="text-sm text-gray-500">2-3 hari kerja</p>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="relative">
                                            <input type="radio" name="delivery" id="jne_oke" value="JNT" class="peer sr-only" required>
                                            <label for="jne_oke" class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-300">
                                                <div class="w-6 h-6 border-2 border-gray-300 rounded-full mr-3 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-gray-800">JNT</span>
                                                    <p class="text-sm text-gray-500">1-2 hari kerja</p>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="relative">
                                            <input type="radio" name="delivery" id="gosend_instant" value="GoSend Instant" class="peer sr-only" required>
                                            <label for="gosend_instant" class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-300">
                                                <div class="w-6 h-6 border-2 border-gray-300 rounded-full mr-3 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-gray-800">GoSend Instant</span>
                                                    <p class="text-sm text-gray-500">Hari ini juga</p>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="relative">
                                            <input type="radio" name="delivery" id="sicepat_reg" value="SiCepat Reguler" class="peer sr-only" required>
                                            <label for="sicepat_reg" class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-300">
                                                <div class="w-6 h-6 border-2 border-gray-300 rounded-full mr-3 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-gray-800">SiCepat Reguler</span>
                                                    <p class="text-sm text-gray-500">2-4 hari kerja</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800">Metode Pembayaran</h3>
                            </div>
                            
                            <div class="space-y-3">
                                <?php foreach ($paymentMethods as $method): ?>
                                    <div class="relative">
                                        <input type="radio" name="payment_method_id" value="<?= $method['id'] ?>" id="payment_<?= $method['id'] ?>" class="peer sr-only" required>
                                        <label for="payment_<?= $method['id'] ?>" class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-300">
                                            <div class="w-6 h-6 border-2 border-gray-300 rounded-full mr-4 peer-checked:border-green-500 peer-checked:bg-green-500 flex items-center justify-center">
                                                <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="font-semibold text-gray-800"><?= htmlspecialchars($method['name']) ?></div>
                                                <div class="text-sm text-gray-500"><?= htmlspecialchars($method['description']) ?></div>
                                            </div>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-6">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800">Ringkasan Pesanan</h3>
                            </div>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal:</span>
                                    <span id="total-amount" class="font-semibold">Rp<?= number_format($total, 0, ',', '.') ?></span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Ongkos Kirim:</span>
                                    <span class="font-semibold">Gratis</span>
                                </div>
                                <div class="border-t pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-800">Total:</span>
                                        <span class="text-2xl font-bold text-green-600" id="final-total">
                                            Rp<?= number_format($total, 0, ',', '.') ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <div class="flex items-center justify-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Buat Pesanan
                                </div>
                            </button>
                            
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-500">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Pembayaran aman & terpercaya
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>    

<script>
document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const totalAmountElem = document.getElementById('total-amount');
    const finalTotalElem = document.getElementById('final-total');

    function updateTotals() {
        let overallTotal = 0;

        quantityInputs.forEach(input => {
            const price = parseInt(input.dataset.price);
            let quantity = parseInt(input.value);
            if (quantity < 1 || isNaN(quantity)) {
                quantity = 1;
                input.value = 1;
            }

            const subtotal = price * quantity;
            const subtotalElem = input.closest('tr').querySelector('.item-subtotal');
            subtotalElem.textContent = 'Rp' + subtotal.toLocaleString('id-ID');

            overallTotal += subtotal;
        });

        totalAmountElem.textContent = 'Rp' + overallTotal.toLocaleString('id-ID');
        if (finalTotalElem) {
            finalTotalElem.textContent = 'Rp' + overallTotal.toLocaleString('id-ID');
        }
    }

    quantityInputs.forEach(input => {
        input.addEventListener('input', updateTotals);
        
        // Add smooth animation on focus
        input.addEventListener('focus', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'scale(1)';
        });
    });

    updateTotals();

    // Add smooth scroll to checkout section
    const checkoutButton = document.querySelector('button[type="submit"]');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', function(e) {
            // Add loading state
        });
    }
});
</script>

<style>
/* Custom styles for radio buttons */
.peer:checked ~ label .w-6 {
    border-color: currentColor;
    background-color: currentColor;
}

/* Smooth transitions */
* {
    transition: all 0.3s ease;
}

/* Hover effects */
.hover\:shadow-xl:hover {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Custom scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>