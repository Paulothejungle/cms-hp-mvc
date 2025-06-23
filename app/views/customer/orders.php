<?php require_once '../app/views/layouts/customer/header.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <a href="<?= BASE_URL ?>/dashboardcustomer/products" class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-100 text-gray-700 font-semibold rounded-full shadow-md transition duration-150 ease-in-out">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                Beli Produk lagi?
            </a>
        </div>

        <div class="bg-white p-6 md:p-8 shadow-xl rounded-lg">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-4">Pesanan Saya</h1>

            <?php
            // Tampilkan pesan sukses atau error dari session
            if (isset($_SESSION['success'])) {
                echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">';
                echo '<strong class="font-bold">Sukses!</strong>';
                echo '<span class="block sm:inline"> ' . $_SESSION['success'] . '</span>';
                echo '<span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display=\'none\';">'; // Added cursor-pointer
                echo '<svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.103l-2.651 2.651a1.2 1.2 0 1 1-1.697-1.697L8.303 9.407l-2.651-2.651a1.2 1.2 0 1 1 1.697-1.697L10 7.71l2.651-2.651a1.2 1.2 0 1 1 1.697 1.697L11.697 9.407l2.651 2.651a1.2 1.2 0 0 1 0 1.697z"/></svg>';
                echo '</span>';
                echo '</div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">';
                echo '<strong class="font-bold">Error!</strong>';
                echo '<span class="block sm:inline"> ' . $_SESSION['error'] . '</span>';
                echo '<span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display=\'none\';">'; // Added cursor-pointer
                echo '<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.103l-2.651 2.651a1.2 1.2 0 1 1-1.697-1.697L8.303 9.407l-2.651-2.651a1.2 1.2 0 1 1 1.697-1.697L10 7.71l2.651-2.651a1.2 1.2 0 1 1 1.697 1.697L11.697 9.407l2.651 2.651a1.2 1.2 0 0 1 0 1.697z"/></svg>';
                echo '</span>';
                echo '</div>';
                unset($_SESSION['error']);
            }
            ?>

            <?php if (empty($orders)) : ?>
                <p class="text-gray-600 text-lg py-8 text-center">Belum ada pesanan yang tercatat.</p>
            <?php else : ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Harga</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-6 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($orders as $index => $order) : ?>
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-4 px-6 text-sm text-gray-700"><?= $index + 1 ?></td>
                                    <td class="py-4 px-6 text-sm text-gray-900 font-medium">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                    <td class="py-4 px-6 text-sm text-gray-700">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                        <?php
                                        switch (strtolower($order['status'])) {
                                            case 'pending':
                                                echo 'bg-yellow-100 text-yellow-700'; // Slightly darker text for pending
                                                break;
                                            case 'verified':
                                                echo 'bg-blue-100 text-blue-700'; // Darker text for verified
                                                break;
                                            case 'shipped':
                                                echo 'bg-indigo-100 text-indigo-700'; // Darker text for shipped
                                                break;
                                            case 'completed':
                                                echo 'bg-green-100 text-green-700'; // Darker text for completed
                                                break;
                                            case 'cancelled':
                                                echo 'bg-red-100 text-red-700'; // Darker text for cancelled
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-700';
                                                break;
                                        }
                                        ?>
                                        ">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center text-sm font-medium">
                                        <a href="<?= BASE_URL ?>/order/myOrderDetail/<?= $order['id'] ?>" class="text-blue-600 hover:text-blue-800 mr-3">Detail</a>

                                        <?php if (strtolower($order['status']) === 'pending' && empty($order['payment_proof'])) : ?>
                                            <button type="button" onclick="showUploadForm(<?= $order['id'] ?>)" class="text-green-600 hover:text-green-800">
                                                Unggah Bukti Bayar
                                            </button>
                                        <?php elseif (!empty($order['payment_proof'])) : ?>
                                            <span class="text-gray-500 italic">Bukti terunggah</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if (strtolower($order['status']) === 'pending' && empty($order['payment_proof'])) : ?>
                                    <tr id="uploadFormRow_<?= $order['id'] ?>" class="hidden"> <td colspan="4" class="py-4 px-6 bg-gray-50">
                                            <div class="p-4 border border-gray-200 rounded-md bg-white shadow-sm">
                                                <h4 class="text-lg font-semibold text-gray-800 mb-3">Unggah Bukti Pembayaran untuk Pesanan #<?= $order['id'] ?></h4>
                                                <form action="<?= BASE_URL ?>/order/uploadPaymentProof/<?= $order['id'] ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                    <div>
                                                        <label for="payment_proof_<?= $order['id'] ?>" class="block text-sm font-medium text-gray-700">Pilih File (JPG, JPEG, PNG, GIF - Max 2MB):</label>
                                                        <input type="file" name="payment_proof" id="payment_proof_<?= $order['id'] ?>" accept=".jpg,.jpeg,.png,.gif" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                                    </div>
                                                    <div class="flex justify-end space-x-3">
                                                        <button type="submit" class="inline-flex items-center px-5 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                            Unggah
                                                        </button>
                                                        <button type="button" onclick="hideUploadForm(<?= $order['id'] ?>)" class="inline-flex items-center px-5 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Changed to toggle the 'hidden' class for better Tailwind consistency
    function showUploadForm(orderId) {
        document.getElementById('uploadFormRow_' + orderId).classList.remove('hidden');
    }

    function hideUploadForm(orderId) {
        document.getElementById('uploadFormRow_' + orderId).classList.add('hidden');
    }
</script>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>