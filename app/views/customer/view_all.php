<?php require_once '../app/views/layouts/customer/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Kategori: <?= htmlspecialchars($category['name']) ?></h1>

    <?php if (count($products) > 0): ?>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <?php foreach ($products as $product): ?>
                <a href="<?= BASE_URL ?>/detail/detail/<?= $product['id'] ?>" 
                class="block border rounded-lg bg-white shadow-md hover:shadow-xl transition-shadow duration-300">
                    <img src="<?= BASE_URL ?>/image/<?= htmlspecialchars($product['image']) ?>" 
                        alt="<?= htmlspecialchars($product['name']) ?>" 
                        class="w-full h-64 object-contain bg-gray-100 rounded-t-lg">

                    <?php if ($product['stock'] == 0): ?>
                        <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">Stok Habis</div>
                    <?php endif; ?>

                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2"><?= htmlspecialchars($product['name']) ?></h2>
                        <p class="text-green-600 font-medium">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                        <p class="text-sm text-gray-600">Stok: <?= $product['stock'] ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-500 italic">Belum ada produk pada kategori ini.</p>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>
