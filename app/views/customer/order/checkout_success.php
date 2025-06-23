<?php require_once '../app/views/layouts/customer/header.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 py-10 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <main class="w-full">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-2xl text-center"> <h1 class="text-4xl font-extrabold text-blue-600 mb-4 animate-fade-in">
                <svg class="mx-auto h-16 w-16 text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <?= $title ?? 'Pesanan Berhasil Dibuat!' ?> </h1>

            <p class="text-xl text-gray-700 mb-8 max-w-2xl mx-auto">
                Terima kasih telah melakukan pemesanan! Pesanan kamu sedang diproses dan akan segera kami tindaklanjuti.
            </p>

            <div class="text-left bg-gray-50 p-6 rounded-lg shadow-inner border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-3">Detail Pesanan Anda:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-lg text-gray-700">
                    <div>
                        <p class="mb-2"><strong class="text-gray-900">ID Pesanan:</strong> <span class="font-mono text-blue-700"><?= htmlspecialchars($order['id']) ?></span></p>
                        <p class="mb-2"><strong class="text-gray-900">Nama Pelanggan:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
                        <p class="mb-2"><strong class="text-gray-900">Total Harga:</strong> <span class="font-bold text-green-600">Rp <?= number_format($order['total'], 0, ',', '.') ?></span></p>
                        <p class="mb-2"><strong class="text-gray-900">Status:</strong> <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700"><?= htmlspecialchars(ucfirst($order['status'])) ?></span></p>
                    </div>
                    <div>
                        <p class="mb-2"><strong class="text-gray-900">Alamat Pengiriman:</strong> <?= htmlspecialchars($order['alamat']) ?></p>
                        <p class="mb-2"><strong class="text-gray-900">Nomor HP:</strong> <?= htmlspecialchars($order['no_hp']) ?></p>
                        <p class="mb-2"><strong class="text-gray-900">Metode Pembayaran:</strong> <span class="font-medium text-purple-700"><?= htmlspecialchars($order['payment_method_name']) ?></span></p>
                        <p class="mb-2"><strong class="text-gray-900">Metode Pengiriman:</strong> <span class="font-medium text-orange-600"><?= htmlspecialchars($order['delivery']) ?></span></p>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-4 mt-8 border-b pb-3">Produk yang Dipesan:</h3>

                <div class="space-y-4">
                    <?php foreach ($items as $item): ?>
                        <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-white hover:bg-gray-50 transition duration-150 ease-in-out flex justify-between items-center flex-wrap">
                            <div class="flex-grow text-left">
                                <p class="font-semibold text-gray-900 text-lg"><?= htmlspecialchars($item['product_name']) ?></p>
                                <p class="text-gray-600">Jumlah: <span class="font-medium"><?= htmlspecialchars($item['quantity']) ?></span></p>
                            </div>
                            <div class="text-right mt-2 sm:mt-0">
                                <p class="text-gray-600">Harga Satuan: <span class="font-medium">Rp <?= number_format($item['price'], 0, ',', '.') ?></span></p>
                                <p class="font-bold text-blue-700 text-lg">Subtotal: Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-10">
                    <a href="<?= BASE_URL ?>/dashboardcustomer/products" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-200 ease-in-out transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Belanja Lagi
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>