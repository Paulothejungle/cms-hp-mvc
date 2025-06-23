<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray-100 min-h-screen p-8">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6"><?= $title ?></h1>

            <form action="<?= BASE_URL ?>/order/update/<?= $order['id'] ?>" method="POST">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Status Pesanan</label>
                    <?php $statusOptions = ['pending', 'verified', 'shipped', 'completed']; ?>
                    <select name="status" class="w-full border rounded p-2 focus:ring focus:border-blue-300" required>
                        <option value="">-- Update Status --</option>
                        <?php foreach ($statusOptions as $status): ?>
                            <option value="<?= $status ?>" <?= ($order['status'] == $status) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="<?= BASE_URL ?>/order/index" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
