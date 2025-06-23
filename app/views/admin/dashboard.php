
<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Dashboard Admin</h1>
            <p class="text-lg text-gray-600">Selamat datang, <span class="text-blue-600 font-semibold">Admin</span>!</p>

            <!-- statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white p-5 rounded-xl shadow text-center">
                    <p class="text-sm text-gray-500">Total Produk</p>
            <p class="text-2xl font-bold text-blue-600"><?= $totalProduk; ?></p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow text-center">
                <p class="text-sm text-gray-500">Total Pesanan</p>
                <p class="text-2xl font-bold text-green-600"><?= $totalPesanan; ?></p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow text-center">
                <p class="text-sm text-gray-500">Pelanggan</p>
                <p class="text-2xl font-bold text-purple-600"><?= $totalPelanggan; ?></p>
            </div>

        </main>
    </div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
