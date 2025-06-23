<?php require_once '../app/views/layouts/customer/header.php'; ?>

<!-- AOS Animasi -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .category-card {
        position: relative;
        overflow: hidden;
    }
    
    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .category-card:hover::before {
        opacity: 1;
    }
    
    .category-card:hover .category-text {
        color: white;
        z-index: 10;
        position: relative;
    }
    
    .floating-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .pulse-bg {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { background-color: rgba(59, 130, 246, 0.1); }
        50% { background-color: rgba(59, 130, 246, 0.2); }
        100% { background-color: rgba(59, 130, 246, 0.1); }
    }
    
    .order-status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .status-processing {
        background-color: #dbeafe;
        color: #1e40af;
    }
    
    .status-completed {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .hero-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }
</style>

<div class="relative min-h-screen pt-16 gradient-bg">
    <!-- Floating decoration elements -->
    <div class="absolute top-20 left-10 w-32 h-32 bg-white bg-opacity-10 rounded-full floating-animation"></div>
    <div class="absolute top-40 right-16 w-24 h-24 bg-white bg-opacity-10 rounded-full floating-animation" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-32 left-20 w-20 h-20 bg-white bg-opacity-10 rounded-full floating-animation" style="animation-delay: -4s;"></div>
    
    <div class="relative py-12 sm:max-w-7xl sm:mx-auto z-10 px-4">

        <!-- Hero Section -->
        <div data-aos="fade-down" data-aos-duration="1000" class="text-center text-white mb-16">
            <div class="hero-icon">
                <i class="fas fa-store"></i>
            </div>
            <h1 class="text-5xl font-bold mb-4 bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                Selamat Datang di Buas Store
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                Kelola pesanan dan informasi akun Anda dengan mudah dan praktis
            </p>
        </div>

        <!-- Info Akun & Pesanan -->
        <div data-aos="fade-up" class="glass-effect rounded-2xl px-8 py-8 mb-20 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- User Info Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl shadow-lg card-hover border-l-4 border-blue-500">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-white text-lg"></i>
                            </div>
                            <h3 class="text-xl font-bold text-blue-800">Informasi Akun</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-blue-500 mr-3"></i>
                                <span class="text-gray-700 font-medium">Nama: </span>
                                <span class="text-gray-800 font-semibold ml-2"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-blue-500 mr-3"></i>
                                <span class="text-gray-700 font-medium">Email: </span>
                                <span class="text-gray-800 font-semibold ml-2"><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Card -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100 p-6 rounded-xl shadow-lg card-hover border-l-4 border-green-500">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-shopping-bag text-white text-lg"></i>
                            </div>
                            <h3 class="text-xl font-bold text-green-800">Pesanan Terbaru</h3>
                        </div>
                        
                        <?php if ($orders && !empty($orderItems)): ?>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Tanggal Pesan:</span>
                                    <span class="font-semibold text-gray-800"><?= htmlspecialchars($orders['created_at']) ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="order-status-badge status-<?= strtolower($orders['status']) ?>">
                                        <?= htmlspecialchars($orders['status']) ?>
                                    </span>
                                </div>
                                
                                <div class="mt-4">
                                    <h4 class="font-semibold text-gray-800 mb-2 flex items-center">
                                        <i class="fas fa-list-ul mr-2 text-green-500"></i>
                                        Item Pesanan:
                                    </h4>
                                    <div class="bg-white bg-opacity-50 rounded-lg p-3 space-y-2">
                                        <?php foreach ($orderItems as $item): ?>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-200 last:border-b-0">
                                                <div>
                                                    <p class="font-medium text-gray-800"><?= htmlspecialchars($item['product_name']) ?></p>
                                                    <p class="text-sm text-gray-600">Qty: <?= htmlspecialchars($item['quantity']) ?></p>
                                                </div>
                                                <p class="font-bold text-green-600">Rp<?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <i class="fas fa-shopping-cart text-gray-400 text-4xl mb-4"></i>
                                <p class="text-gray-600">Anda belum memiliki pesanan.</p>
                                <a href="<?= BASE_URL ?>/dashboardcustomer/products" class="inline-block mt-3 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                                    Mulai Belanja
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php else: ?>
                    <!-- Login Prompt -->
                    <div class="col-span-2 text-center py-12">
                        <div class="bg-white bg-opacity-20 rounded-2xl p-8 max-w-md mx-auto">
                            <i class="fas fa-sign-in-alt text-white text-5xl mb-6"></i>
                            <h3 class="text-2xl font-bold text-white mb-4">Akses Akun Anda</h3>
                            <p class="text-blue-100 mb-6">Silakan login untuk melihat informasi akun dan pesanan Anda.</p>
                            <a href="<?= BASE_URL ?>/auth/login" class="inline-block bg-white text-blue-600 font-bold px-8 py-3 rounded-full hover:bg-blue-50 transition-all transform hover:scale-105 shadow-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login Sekarang
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Info Cards Section -->
        <div data-aos="fade-up" class="mb-20">
            <h2 class="text-3xl font-bold text-white text-center mb-12">
                <i class="fas fa-info-circle mr-3"></i>
                Mengapa Memilih Buas Store?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-xl card-hover" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-shipping-fast text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Layanan Cepat</h3>
                        <p class="text-gray-600 leading-relaxed">Kami memproses dan mengirimkan pesanan Anda dengan cepat dan aman ke seluruh Indonesia.</p>
                    </div>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-xl card-hover" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-award text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Produk Terbaik</h3>
                        <p class="text-gray-600 leading-relaxed">Semua produk dijamin original dan berkualitas tinggi dengan garansi resmi.</p>
                    </div>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-xl card-hover" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-headset text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Support 24/7</h3>
                        <p class="text-gray-600 leading-relaxed">Tim customer service kami siap membantu kapan saja Anda membutuhkan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori Produk -->
        <div data-aos="fade-up" class="mb-20">
            <h2 class="text-3xl font-bold text-white text-center mb-4">
                <i class="fas fa-th-large mr-3"></i>
                Jelajahi Kategori Produk
            </h2>
            <p class="text-blue-100 text-center mb-12 max-w-2xl mx-auto">
                Temukan berbagai produk berkualitas dalam kategori yang beragam
            </p>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                <?php foreach ($categories as $category) : ?>
                    <a href="<?= BASE_URL ?>/dashboardcustomer/products#kategori-<?= $category['id'] ?>" 
                       class="category-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 overflow-hidden group" 
                       data-aos="zoom-in" data-aos-delay="<?= array_search($category, $categories) * 100 ?>">
                        <div class="relative">
                            <img src="<?= BASE_URL ?>/image/<?= $category['image'] ?>" 
                                 alt="<?= $category['name'] ?>" 
                                 class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                        <div class="p-4 text-center">
                            <p class="category-text font-semibold text-gray-800 transition-colors duration-300 group-hover:text-white">
                                <?= $category['name'] ?>
                            </p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- CTA Section -->
        <div data-aos="fade-up" class="text-center">
            <div class="glass-effect rounded-2xl p-8 max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold text-white mb-4">Siap Untuk Berbelanja?</h3>
                <p class="text-blue-100 mb-6">Jelajahi koleksi produk terlengkap kami dan dapatkan penawaran terbaik!</p>
                <a href="<?= BASE_URL ?>/dashboardcustomer/products" 
                   class="inline-block bg-white text-blue-600 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </div>
</div>

<!-- AOS Script -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
</script>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>