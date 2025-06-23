<?php require_once '../app/views/layouts/header.php'; ?>
<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>
    <main class="flex-1 bg-gray min-h-screen p-8">
        <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= $title ?></h1>

            <form method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($method['name']) ?>" 
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <input type="text" id="name" name="description" value="<?= htmlspecialchars($method['description']) ?>" 
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div class="flex justify-end">
                    <a href="<?= BASE_URL ?>/paymentmethod/index" 
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
