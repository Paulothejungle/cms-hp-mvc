<?php require_once '../app/views/layouts/customer/header.php'; ?>

<div class="flex w-full">

    <main class="flex-1 bg-gray-100 min-h-screen p-8">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

            <?php if (empty($cartItems)): ?>
                <p class="text-center">Keranjang Anda kosong.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">Produk</th>
                                <th class="px-4 py-2">Harga</th>
                                <th class="px-4 py-2">Jumlah</th>
                                <th class="px-4 py-2">Total</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <td class="px-4 py-2"><?= htmlspecialchars($item['name']) ?></td>
                                    <td class="px-4 py-2">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                    <td class="px-4 py-2"><?= $item['quantity'] ?></td>
                                    <td class="px-4 py-2">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                                    <td class="px-4 py-2">
                                        <a href="<?= BASE_URL ?>/cart/remove/<?= $item['id'] ?>" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 text-right">
                    <a href="<?= BASE_URL ?>/checkout" class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600">Lanjut ke Pembayaran</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>


