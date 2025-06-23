<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray min-h-screen p-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= $title ?></h1>

            <!-- Form Tambah Kategori -->
            <form action="<?= BASE_URL ?>/category/store" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md space-y-4">
                <?php if (!empty($error)) : ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nama Kategori</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan nama kategori"
                    >
                </div>

                <div>
                    <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Produk</label>
                    <input type="file" id="image" name="image" accept="image/*" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="<?= BASE_URL ?> /category/index" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
