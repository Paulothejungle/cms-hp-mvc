<?php require_once '../app/views/layouts/header.php'; ?>


<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray min-h-screen p-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800"><?= $title ?></h1>
                <a href="<?= BASE_URL ?>/paymentmethod/add" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    + Tambah Metode
                </a>
            </div>


            <!-- Table -->
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="w-full min-w-[600px]">
                    <thead class="bg-green-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="py-3 px-6 text-left">Nama</th>
                            <th class="py-3 px-6 text-left">Deskripsi</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        <?php if (count($methods) > 0) : ?>
                            <?php foreach ($methods as $method): ?>
                                <tr>
                                    <td class="px-4 py-2 border"><?= htmlspecialchars($method['name']) ?></td>
                                    <td class="px-4 py-2 border"><?= htmlspecialchars($method['description']) ?></td>
                                    <td class="px-4 py-2 border">
                                        <a href="<?= BASE_URL ?>/paymentmethod/edit/<?= $method['id'] ?>" class="text-blue-500 hover:underline">Edit</a>
                                        <a href="<?= BASE_URL ?>/paymentmethod/delete/<?= $method['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-500 hover:underline">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center py-4">Belum ada metode</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>



</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
