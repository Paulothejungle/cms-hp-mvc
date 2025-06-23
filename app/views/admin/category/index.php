<?php require_once '../app/views/layouts/header.php'; ?>


<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray min-h-screen p-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800"><?= $title ?></h1>
                <a href="<?= BASE_URL ?>/category/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    + Tambah Kategori
                </a>
            </div>

            <!-- Form Search -->
            <form action="<?= BASE_URL ?>/category/index" method="GET" class="flex items-center space-x-2 mb-6">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari kategori..." 
                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                    class="w-48 px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Cari
                </button>
            </form>

            <!-- Table -->
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="w-full min-w-[600px]">
                    <thead class="bg-green-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Nama Kategori</th>
                            <th class="py-3 px-6 text-center">Gambar</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        <?php if (count($categories) > 0) : ?>
                            <?php foreach ($categories as $category) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-6"><?= $category['id'] ?></td>
                                    <td class="py-3 px-6"><?= htmlspecialchars($category['name']) ?></td>
                                    <td class="py-3 px-6">
                                        <img src="<?= BASE_URL ?>/image/<?= htmlspecialchars($category['image']) ?>" alt="<?= htmlspecialchars($category['name']) ?>" class="w-20 h-20 object-cover">
                                    </td>
                                    <td class="py-3 px-6 text-center space-x-2">
                                        <a href="<?= BASE_URL ?>/category/edit/<?= $category['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                                        <a href="<?= BASE_URL ?>/category/delete/<?= $category['id'] ?>" onclick="return confirm('Yakin ingin hapus?');" class="text-red-600 hover:underline">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center py-4">Belum ada kategori.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>



</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
