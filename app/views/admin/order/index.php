<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex w-full">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>

    <main class="flex-1 bg-gray-100 min-h-screen p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Daftar Pesanan</h1>
            </div>

            <form action="<?= BASE_URL ?>/order/export_excel" method="POST" class="flex flex-wrap items-center gap-2 mb-6 bg-white p-4 rounded shadow">
                <input
                    type="number"
                    name="from_id"
                    placeholder="Dari Order ID"
                    class="border px-3 py-2 rounded w-40"
                    value="<?= isset($_POST['from_id']) ? htmlspecialchars($_POST['from_id']) : '' ?>"
                >
                <input
                    type="number"
                    name="to_id"
                    placeholder="Sampai Order ID"
                    class="border px-3 py-2 rounded w-40"
                    value="<?= isset($_POST['to_id']) ? htmlspecialchars($_POST['to_id']) : '' ?>"
                >

                <select name="status" class="border px-3 py-2 rounded w-40">
                    <option value="">Semua Status</option>
                    <option value="pending" <?= (isset($_POST['status']) && $_POST['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="shipped" <?= (isset($_POST['status']) && $_POST['status'] == 'shipped') ? 'selected' : '' ?>>Shipped</option>
                    <option value="verified" <?= (isset($_POST['status']) && $_POST['status'] == 'verified') ? 'selected' : '' ?>>Verified</option>
                    <option value="completed" <?= (isset($_POST['status']) && $_POST['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= (isset($_POST['status']) && $_POST['status'] == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                </select>

                <input
                    type="date"
                    name="from_date"
                    class="border px-3 py-2 rounded w-44"
                    value="<?= isset($_POST['from_date']) ? htmlspecialchars($_POST['from_date']) : '' ?>"
                >
                <input
                    type="date"
                    name="to_date"
                    class="border px-3 py-2 rounded w-44"
                    value="<?= isset($_POST['to_date']) ? htmlspecialchars($_POST['to_date']) : '' ?>"
                >

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Export Excel
                </button>
            </form>

            <form action="<?= BASE_URL ?>/order/index" method="GET" class="flex items-center space-x-2 mb-6 bg-white p-4 rounded shadow">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari ID Order/Nama Customer..."
                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                    class="w-64 px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Cari
                </button>
                <?php if (isset($_GET['search'])): ?>
                    <a href="<?= BASE_URL ?>/order/index" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Reset</a>
                <?php endif; ?>
            </form>

            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="w-full min-w-[800px]">
                    <thead class="bg-green-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="py-3 px-6 text-left">Order ID</th>
                            <th class="py-3 px-6 text-left">Customer</th>
                            <th class="py-3 px-6 text-left">Total Bayar</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Waktu Pesan</th>
                            <th class="py-3 px-6 text-left">Bukti Bayar</th> <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="7" class="py-4 px-6 text-center text-gray-500">Tidak ada data pesanan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-6"><?= $order['id'] ?></td>
                                    <td class="py-3 px-6"><?= htmlspecialchars($order['customer_name']) ?></td>
                                    <td class="py-3 px-6">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                    <td class="py-3 px-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        <?php
                                        switch (strtolower($order['status'])) {
                                            case 'pending':
                                                echo 'bg-yellow-100 text-yellow-800';
                                                break;
                                            case 'verified':
                                                echo 'bg-blue-100 text-blue-800';
                                                break;
                                            case 'shipped':
                                                echo 'bg-indigo-100 text-indigo-800';
                                                break;
                                            case 'completed':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'cancelled':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800';
                                                break;
                                        }
                                        ?>
                                        ">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                    <td class="py-3 px-6"><?= htmlspecialchars($order['created_at']) ?></td>
                                    <td class="py-3 px-6">
                                        <?php if (!empty($order['payment_proof'])): ?>
                                            <button onclick="showPaymentProof('<?= BASE_URL ?>/image/<?= htmlspecialchars($order['payment_proof']) ?>')"
                                                    class="text-purple-600 hover:text-purple-800 font-medium">
                                                Lihat Bukti
                                            </button>
                                        <?php else: ?>
                                            <span class="text-gray-500 italic">Belum Diunggah</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <a href="<?= BASE_URL ?>/order/detail/<?= $order['id'] ?>" class="text-blue-600 hover:text-blue-800 mr-2">Detail</a>
                                        <a href="<?= BASE_URL ?>/order/edit/<?= $order['id'] ?>" class="text-green-600 hover:text-green-800">Edit Status</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div id="paymentProofModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-lg max-h-[90vh] overflow-y-auto"> <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Bukti Pembayaran</h3>
            <button onclick="hidePaymentProof()" class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="mb-4 text-center">
            <img id="paymentProofImage" src="" alt="Bukti Pembayaran" class="max-w-full h-auto mx-auto border rounded shadow-md">
        </div>
        <div class="flex justify-end">
            <button onclick="hidePaymentProof()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function showPaymentProof(imageUrl) {
        document.getElementById('paymentProofImage').src = imageUrl;
        document.getElementById('paymentProofModal').classList.remove('hidden');
    }

    function hidePaymentProof() {
        document.getElementById('paymentProofModal').classList.add('hidden');
        document.getElementById('paymentProofImage').src = ''; // Clear image source
    }
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>