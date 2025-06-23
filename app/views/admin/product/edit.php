<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray min-h-screen p-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= $title ?></h1>

            <!-- Form Edit Produk -->
            <form action="<?= BASE_URL ?>/product/update/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md space-y-4">

                <div>
                    <label for="category_id" class="block text-gray-700 font-medium mb-2">Kategori</label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="<?= htmlspecialchars($product['name']) ?>"
                        required
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan nama produk"
                    >
                </div>

                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-2">Harga</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="<?= htmlspecialchars($product['price']) ?>"
                        required
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan harga"
                    >
                </div>

                <div>
                    <label for="stock" class="block text-gray-700 font-medium mb-2">Stok</label>
                    <input 
                        type="number" 
                        id="stock" 
                        name="stock" 
                        value="<?= htmlspecialchars($product['stock']) ?>"
                        required
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan stok"
                    >
                </div>

                <div>
                    <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Produk</label>
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                    <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    <div class="mt-3">
                        <img src="<?= BASE_URL ?>/image/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-32 h-32 object-cover">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="5"
                        required
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan deskripsi"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="<?= BASE_URL ?>/product/index" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update Produk
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
