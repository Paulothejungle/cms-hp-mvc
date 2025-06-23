<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray-100 min-h-screen p-8">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4"><?= $title ?></h1>

            <div class="space-y-4">
                <div><strong>Order ID:</strong> <?= $order['id'] ?></div>
                <div><strong>Nama Customer:</strong> <?= htmlspecialchars($order['customer_name']) ?></div>
                <div><strong>Total:</strong> Rp <?= number_format($order['total'], 0, ',', '.') ?></div>
                <div><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></div>
            </div>

            <h2 class="text-xl font-semibold mt-6 mb-4">Item Pesanan</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 uppercase text-gray-600">
                        <tr>
                            <th class="py-2 px-4">Produk</th>
                            <th class="py-2 px-4">Jumlah Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr class="border-b">
                                <td class="py-2 px-4"><?= htmlspecialchars($item['product_name']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($item['quantity']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="<?= BASE_URL ?>/order/index" class="inline-block px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </div>
    </main>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
