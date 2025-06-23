<?php require_once '../app/views/layouts/customer/header.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-2xl"> <h1 class="text-3xl font-extrabold text-gray-900 mb-8 border-b pb-4 text-center">
            Detail Pesanan #<?= htmlspecialchars($order['id']) ?>
        </h1>
        <p class="text-xl text-gray-700 mb-8 text-center">Berikut adalah rincian lengkap pesanan Anda.</p>

        <section class="mb-8 p-6 bg-gray-50 rounded-lg shadow-inner border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-3">Ringkasan Pesanan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-lg">
                <div>
                    <p class="mb-2"><strong class="font-semibold text-gray-900">Status:</strong>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                        <?php
                        switch (strtolower($order['status'])) {
                            case 'pending':
                                echo 'bg-yellow-100 text-yellow-700';
                                break;
                            case 'verified':
                                echo 'bg-blue-100 text-blue-700';
                                break;
                            case 'shipped':
                                echo 'bg-indigo-100 text-indigo-700'; // Changed from purple to indigo for better consistency
                                break;
                            case 'completed':
                                echo 'bg-green-100 text-green-700';
                                break;
                            case 'cancelled':
                                echo 'bg-red-100 text-red-700';
                                break;
                            default:
                                echo 'bg-gray-100 text-gray-700';
                                break;
                        }
                        ?>
                        ">
                            <?= ucfirst($order['status']) ?>
                        </span>
                    </p>
                    <p class="mb-2"><strong class="font-semibold text-gray-900">Total Harga:</strong>
                        <span class="text-2xl font-bold text-green-600">Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
                    </p>
                    <p class="mb-2"><strong class="font-semibold text-gray-900">Metode Pembayaran:</strong>
                        <span class="font-medium text-purple-700"><?= htmlspecialchars($order['payment_method_name']) ?></span>
                    </p>
                    <p class="mb-2"><strong class="font-semibold text-gray-900">Metode Pengiriman:</strong>
                        <span class="font-medium text-orange-600"><?= htmlspecialchars($order['delivery']) ?></span>
                    </p>
                </div>
                <div>
                    <p class="mb-2"><strong class="font-semibold text-gray-900">Nama Pelanggan:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
                    <p class="mb-2"><strong class="font-semibold text-gray-900">Alamat Pengiriman:</strong> <?= htmlspecialchars($order['alamat']) ?></p>
                    <p class="mb-2"><strong class="font-semibold text-gray-900">Nomor HP:</strong> <?= htmlspecialchars($order['no_hp']) ?></p>
                    <p class="mb-2"><strong class="font-semibold text-gray-900">Waktu Pesan:</strong> <?= htmlspecialchars(date('d F Y, H:i', strtotime($order['created_at']))) ?> WIB</p>
                </div>
            </div>
        </section>

        <section class="mb-8 p-6 bg-gray-50 rounded-lg shadow-inner border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-3">Item Pesanan</h2>

            <?php if (empty($items)) : ?>
                <p class="text-gray-500 text-center py-4">Tidak ada item dalam pesanan ini.</p>
            <?php else : ?>
                <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Produk</th>
                                <th class="py-3 px-6 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                                <th class="py-3 px-6 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga Satuan</th>
                                <th class="py-3 px-6 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($items as $index => $item) : ?>
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-4 px-6 text-sm text-gray-700"><?= $index + 1 ?></td>
                                    <td class="py-4 px-6 text-sm text-gray-900 font-medium"><?= htmlspecialchars($item['product_name']) ?></td>
                                    <td class="py-4 px-6 text-center text-sm text-gray-700"><?= $item['quantity'] ?></td>
                                    <td class="py-4 px-6 text-right text-sm text-gray-700">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                    <td class="py-4 px-6 text-right text-base font-bold text-blue-700">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>

        <div class="mt-8 text-center">
            <a href="<?= BASE_URL ?>/order/myOrders" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full shadow-lg transition duration-150 ease-in-out transform hover:scale-105">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
                Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>