<!-- Sidebar -->
<aside class="w-64 bg-white shadow-md p-5 hidden md:block">
    <h2 class="text-2xl font-bold text-blue-600 mb-8">Admin Panel</h2>
    <nav class="space-y-4">
        <a href="<?= BASE_URL ?>/dashboard/dashboard" class="block text-gray-700 hover:text-blue-600">🏠 Dashboard</a>
        <a href="<?= BASE_URL ?>/category/index" class="block text-gray-700 hover:text-blue-600">📁 Kategori Produk</a>
        <a href="<?= BASE_URL ?>/product/index" class="block text-gray-700 hover:text-blue-600">📦 Produk</a>
        <a href="<?= BASE_URL ?>/order/index" class="block text-gray-700 hover:text-blue-600">🧾 Daftar Pesanan</a>
        <a href="<?= BASE_URL ?>/customer/index" class="block text-gray-700 hover:text-blue-600">👥 Daftar Pelanggan</a>
        <a href="<?= BASE_URL ?>/paymentmethod/pembayaran" class="block text-gray-700 hover:text-blue-600">🛒 Pembayaran</a>


        <div class="mt-10 border-t pt-4">
            <a href="<?= BASE_URL ?>/auth/logout" onclick="return confirm('Yakin ingin logout?');" class="block text-red-600 hover:underline" >🔓 Logout</a>           
        </div>
    </nav>
</aside>
