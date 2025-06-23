<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray-100 min-h-screen p-8">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4"><?= $title ?></h1>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-green-100 uppercase text-gray-600">
                        <tr>
                            <th class="py-2 px-4">ID</th>
                            <th class="py-2 px-4">Nama</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">No Telepon</th>
                            <th class="py-2 px-4">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr class="border-b">
                                <td class="py-2 px-4"><?= $customer['id'] ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($customer['name']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($customer['email']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($customer['phone']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($customer['address']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="<?= BASE_URL ?>/dashboard/dashboard" class="inline-block px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </main>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
