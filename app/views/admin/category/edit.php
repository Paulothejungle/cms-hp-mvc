<?php require_once '../app/views/layouts/header.php'; ?>
<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>
    <main class="flex-1 bg-gray min-h-screen p-8">
        <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= $title ?></h1>

            <form action="<?= BASE_URL ?>/category/update/<?= $category['id'] ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($category['name']) ?>" 
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Kategori</label>
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                    <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    <div class="mt-3">
                        <img src="<?= BASE_URL ?>/image/<?= htmlspecialchars($category['image']) ?>" alt="<?= htmlspecialchars($category['name']) ?>" class="w-32 h-32 object-cover">
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="<?= BASE_URL ?>/category/index" 
                    class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 mr-2">
                    Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
