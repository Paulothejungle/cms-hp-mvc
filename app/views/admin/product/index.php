<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800"><?= $title ?></h1>
                <a href="<?= BASE_URL ?>/product/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    + Tambah Produk
                </a>
            </div>

            <!-- Form Search -->
            <form action="<?= BASE_URL ?>/product/index" method="GET" class="flex items-center space-x-2 mb-6">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari produk..." 
                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                    class="w-64 px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Cari
                </button>
            </form>

            <!-- Table Produk -->
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="w-full min-w-[1000px]">
                    <thead class="bg-green-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Kategori</th>
                            <th class="py-3 px-6 text-left">Nama Produk</th>
                            <th class="py-3 px-6 text-left">Harga</th>
                            <th class="py-3 px-6 text-left">Stok</th>
                            <th class="py-3 px-6 text-left">Gambar</th>
                            <th class="py-3 px-6 text-left">Deskripsi</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        <?php foreach ($products as $product): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-6"><?= $product['id'] ?></td>
                                <td class="py-3 px-6"><?= htmlspecialchars($product['category_name']) ?></td>
                                <td class="py-3 px-6"><?= htmlspecialchars($product['name']) ?></td>
                                <td class="py-3 px-6">Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                                <td class="py-3 px-6"><?= htmlspecialchars($product['stock']) ?></td>
                                <td class="py-3 px-6">
                                    <img src="<?= BASE_URL ?>/image/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-20 h-20 object-cover">
                                </td>
                                <td class="py-3 px-6"><?= htmlspecialchars($product['description']) ?></td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <a href="<?= BASE_URL ?>/product/edit/<?= $product['id'] ?>" class="text-blue-600 hover:text-blue-800">Edit</a> |
                                    <a href="<?= BASE_URL ?>/product/delete/<?= $product['id'] ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin mau hapus produk ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </main>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
