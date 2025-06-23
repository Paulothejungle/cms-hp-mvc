<?php require_once '../app/views/layouts/customer/header.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_SESSION['error_message'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "<?= addslashes($_SESSION['error_message']) ?>"
            });
        });
    </script>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>


<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-2xl">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 text-center border-b pb-4">
            <?= $title ?? 'Checkout Pesanan' ?>
        </h2>

        <form method="POST" action="" id="checkout-form">
            <section class="mb-8 p-6 bg-gray-50 rounded-lg shadow-inner">
                <h3 class="text-xl font-bold text-gray-800 mb-5 border-b pb-3">Informasi Pengiriman</h3>
                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700 text-sm font-semibold mb-2">Alamat Lengkap:</label>
                    <input id="alamat" name="alamat" rows="4" class="form-textarea block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" placeholder="Masukkan alamat lengkap Anda..." required></input>
                </div>
                <div class="mb-4">
                    <label for="no_hp" class="block text-gray-700 text-sm font-semibold mb-2">Nomor HP:</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-input block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" placeholder="Contoh: 081234567890" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Metode Pengiriman:</label>
                    <div class="space-y-3">
                        <?php
                            $deliveryMethods = [
                                ['id' => 'jne_reg', 'value' => 'JNE Reguler', 'label' => 'JNE Reguler'],
                                ['id' => 'jnt', 'value' => 'JNT', 'label' => 'JNT'],
                                ['id' => 'gosend_instant', 'value' => 'GoSend Instant', 'label' => 'GoSend Instant'],
                                ['id' => 'sicepat_reg', 'value' => 'SiCepat Reguler', 'label' => 'SiCepat Reguler'],
                            ];
                            foreach ($deliveryMethods as $method) :
                        ?>
                            <div class="flex items-center p-3 border border-gray-200 rounded-md bg-white shadow-sm hover:bg-blue-50 transition duration-150 ease-in-out">
                                <input type="radio" name="delivery" id="<?= $method['id'] ?>" value="<?= $method['value'] ?>" class="form-radio h-5 w-5 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer" required>
                                <label for="<?= $method['id'] ?>" class="ml-3 text-base font-medium text-gray-800 cursor-pointer"><?= $method['label'] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="mb-8 p-6 bg-gray-50 rounded-lg shadow-inner">
                 <h3 class="text-xl font-bold text-gray-800 mb-5 border-b pb-3">Pilih Metode Pembayaran:</h3>
                 <div class="space-y-3">
                    <?php foreach ($paymentMethods as $method) : ?>
                        <div class="flex items-center p-3 border border-gray-200 rounded-md bg-white shadow-sm hover:bg-purple-50 transition duration-150 ease-in-out">
                            <input type="radio" name="payment_method_id" id="payment_<?= $method['id'] ?>" value="<?= $method['id'] ?>" required class="form-radio h-5 w-5 text-purple-600 border-gray-300 focus:ring-purple-500 cursor-pointer">
                            <label for="payment_<?= $method['id'] ?>" class="ml-3 text-base font-medium text-gray-800 cursor-pointer">
                                <?= htmlspecialchars($method['name']) ?>
                                <p class="text-gray-500 text-sm mt-1"><?= htmlspecialchars($method['description']) ?></p>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="mb-8 p-6 bg-gray-50 rounded-lg shadow-inner">
                <h3 class="text-xl font-bold text-gray-800 mb-5 border-b pb-3">Ringkasan Pesanan:</h3>
                <ul class="mb-6 space-y-3">
                    <?php foreach ($cartItems as $index => $item) : ?>
                        <li class="flex flex-col sm:flex-row justify-between items-start sm:items-center py-3 border-b border-gray-200 last:border-b-0">
                            <span class="product-name text-gray-700 font-medium mb-1 sm:mb-0"><?= htmlspecialchars($item['product_name']) ?></span>
                            <div class="flex items-center text-gray-600 text-sm sm:text-base">
                                <input type="hidden" name="product_id[]" value="<?= $item['product_id'] ?>">
                                <input
                                    type="number"
                                    name="quantity[]"
                                    value="<?= $item['quantity'] ?>"
                                    min="1"
                                    class="w-20 px-2 py-1 border border-gray-300 rounded text-center text-gray-800 quantity-input focus:outline-none focus:ring-1 focus:ring-blue-300"
                                    data-price="<?= $item['price'] ?>"
                                    data-stock="<?= $item['stock'] ?? 0 ?>"
                                    
                                    >
                                <span class="ml-2">x Rp <?= number_format($item['price'], 0, ',', '.') ?></span>
                            </div>
                            <span class="item-total text-lg font-semibold text-gray-900 mt-2 sm:mt-0 ml-0 sm:ml-4">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="flex justify-between items-center pt-4 border-t border-gray-300">
                    <span class="font-bold text-xl text-gray-900">Total:</span>
                    <span id="overall-total" class="font-extrabold text-xl text-indigo-700">Rp 0</span>
                </div>
            </section>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-bold rounded-full shadow-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Buat Pesanan
                </button>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkoutForm = document.getElementById('checkout-form');
                const quantityInputs = document.querySelectorAll('.quantity-input');
                const overallTotalElem = document.getElementById('overall-total');

                function updateTotals() {
                    let overallTotal = 0;
                    quantityInputs.forEach(input => {
                        const price = parseFloat(input.dataset.price);
                        const quantity = parseInt(input.value) || 0;
                        const itemTotal = price * quantity;
                        
                        const listItem = input.closest('li');
                        if (listItem) {
                            const itemTotalElem = listItem.querySelector('.item-total');
                            if (itemTotalElem) {
                                itemTotalElem.textContent = 'Rp ' + itemTotal.toLocaleString('id-ID');
                            }
                        }
                        overallTotal += itemTotal;
                    });
                    overallTotalElem.textContent = 'Rp ' + overallTotal.toLocaleString('id-ID');
                }

                quantityInputs.forEach(input => {
                    input.addEventListener('input', updateTotals);
                });

                updateTotals();

                checkoutForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const errors = []; 

                    quantityInputs.forEach(input => {
                        const stock = parseInt(input.dataset.stock, 10);
                        const quantity = parseInt(input.value, 10);
                        
                        if (quantity > stock) {
                            const listItem = input.closest('li');
                            const productNameElem = listItem.querySelector('.product-name');
                            const productName = productNameElem ? productNameElem.textContent.trim() : 'Produk';
                            
                            errors.push(`Stok untuk <strong>${productName}</strong> tidak cukup (tersedia: ${stock}, diminta: ${quantity})`);
                        }
                    });

                    if (errors.length > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Memproses Pesanan',
                            html: `
                                <p class="mb-4">Harap perbaiki jumlah pesanan untuk produk berikut:</p>
                                <ul class="text-left list-disc list-inside">
                                    ${errors.map(e => `<li>${e}</li>`).join('')}
                                </ul>
                            `,
                            confirmButtonColor: '#d33'
                        });
                    } else {
                        checkoutForm.submit();
                    }
                });
            });
        </script>
    </div>
</div>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>