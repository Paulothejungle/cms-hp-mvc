<?php require_once '../app/views/layouts/customer/header.php'; ?>

<style>
    html {
        scroll-behavior: smooth;
    }
    
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .product-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }
    
    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
        z-index: 1;
    }
    
    .product-card:hover::before {
        left: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }
    
    .category-header {
        background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .search-container {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }
    
    .floating-circle {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .pulse-ring {
        animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
    }
    
    @keyframes pulse-ring {
        0% { transform: scale(0.33); }
        80%, 100% { opacity: 0; }
    }
    
    .stock-badge {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .price-tag {
        background: linear-gradient(45deg, #00b894, #00cec9);
        color: white;
        font-weight: bold;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    .view-all-btn {
        background: linear-gradient(45deg, #6c5ce7, #a29bfe);
        transition: all 0.3s ease;
    }
    
    .view-all-btn:hover {
        background: linear-gradient(45deg, #a29bfe, #6c5ce7);
        transform: translateX(5px);
    }
    
    .category-section {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .image-container {
        position: relative;
        overflow: hidden;
    }
    
    .image-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }
    
    .product-card:hover .image-container::after {
        transform: translateX(100%);
    }
    
    .no-products {
        background: linear-gradient(135deg, #ffeaa7, #fab1a0);
        border-radius: 20px;
        padding: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .no-products::before {
        content: '🛍️';
        font-size: 4rem;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0.1;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 53%, 80%, 100% { transform: translate(-50%, -50%) translateY(0); }
        40%, 43% { transform: translate(-50%, -50%) translateY(-30px); }
        70% { transform: translate(-50%, -50%) translateY(-15px); }
    }
</style>

<!-- Floating Background Elements -->
<div class="floating-elements">
    <div class="floating-circle" style="width: 100px; height: 100px; top: 10%; left: 10%; animation-delay: 0s;"></div>
    <div class="floating-circle" style="width: 150px; height: 150px; top: 20%; right: 10%; animation-delay: 2s;"></div>
    <div class="floating-circle" style="width: 80px; height: 80px; bottom: 20%; left: 20%; animation-delay: 4s;"></div>
    <div class="floating-circle" style="width: 120px; height: 120px; bottom: 10%; right: 20%; animation-delay: 1s;"></div>
</div>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Enhanced Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Koleksi Produk Terbaik
            </h1>
            <p class="text-gray-600 text-lg">Temukan produk berkualitas dengan harga terbaik</p>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-pink-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Enhanced Search Section -->
        <div class="flex justify-center mb-12">
            <div class="search-container w-full max-w-md rounded-full p-1">
                <div class="relative">
                    <input type="text" id="searchCategory" onkeyup="filterCategories()" 
                           placeholder="Cari kategori produk..." 
                           class="pl-12 pr-4 py-4 w-full text-sm bg-white/80 backdrop-blur-sm border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-300">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M15.5 11a4.5 4.5 0 10-9 0 4.5 4.5 0 009 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Products by Category -->
        <div class="space-y-16">
            <?php foreach ($categories as $index => $category): ?>
                <section id="kategori-<?= $category['id'] ?>" 
                         class="category-section scroll-mt-16" 
                         data-name="<?= strtolower($category['name']) ?>"
                         style="animation-delay: <?= $index * 0.1 ?>s;">
                    
                    <!-- Enhanced Category Header -->
                    <div class="bg-white/60 backdrop-blur-lg rounded-2xl p-6 mb-8 border border-white/20 shadow-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                                    <span class="text-white font-bold text-lg"><?= substr($category['name'], 0, 1) ?></span>
                                </div>
                                <h2 class="text-3xl font-bold category-header">
                                    <?= htmlspecialchars($category['name']) ?>
                                </h2>
                            </div>
                            <a href="<?= BASE_URL ?>/detail/viewAll/<?= $category['id'] ?>" 
                               class="view-all-btn text-white px-6 py-3 rounded-full text-sm font-medium shadow-lg hover:shadow-xl transition-all duration-300">
                                Lihat Semua →
                            </a>
                        </div>
                    </div>

                    <!-- Enhanced Product Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                        <?php
                        $hasProduct = false;
                        foreach ($products as $product):
                            if ($product['category_id'] == $category['id']):
                                $hasProduct = true;
                        ?>
                            <a href="<?= BASE_URL ?>/detail/detail/<?= $product['id'] ?>" 
                               class="product-card block relative bg-white/80 backdrop-blur-sm border border-white/20 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden h-[380px] group">
                                
                                <!-- Enhanced Image Section -->
                                <div class="image-container w-full h-[180px] bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center relative overflow-hidden">
                                    <img src="<?= BASE_URL ?>/image/<?= htmlspecialchars($product['image']) ?>" 
                                         alt="<?= htmlspecialchars($product['name']) ?>" 
                                         class="max-h-full max-w-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                                    
                                    <!-- Decorative corner -->
                                    <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-bl from-purple-200/30 to-transparent"></div>
                                </div>

                                <!-- Enhanced Stock Badge -->
                                <?php if ($product['stock'] == 0): ?>
                                    <div class="absolute top-3 left-3 stock-badge text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                        Stok Habis
                                    </div>
                                <?php else: ?>
                                    <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                        Tersedia
                                    </div>
                                <?php endif; ?>

                                <!-- Enhanced Content Section -->
                                <div class="p-4 flex flex-col justify-between h-[200px] relative">
                                    <div class="space-y-2">
                                        <h3 class="text-sm font-bold text-gray-800 leading-tight line-clamp-2 group-hover:text-purple-600 transition-colors duration-300">
                                            <?= htmlspecialchars($product['name']) ?>
                                        </h3>
                                        
                                        <div class="price-tag inline-block px-3 py-1 rounded-full text-sm font-bold shadow-md">
                                            Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                        </div>
                                        
                                        <div class="flex items-center space-x-2 text-xs">
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full font-medium">
                                                Stok: <?= htmlspecialchars($product['stock']) ?>
                                            </span>
                                        </div>
                                        
                                        <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed">
                                            <?= htmlspecialchars($product['description']) ?>
                                        </p>
                                    </div>
                                    
                                    <!-- Hover Effect Button -->
                                    <div class="absolute bottom-4 left-4 right-4 transform translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white text-center py-2 rounded-full text-xs font-bold shadow-lg">
                                            Lihat Detail
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endif;
                        endforeach;

                        if (!$hasProduct): ?>
                            <div class="col-span-full">
                                <div class="no-products relative">
                                    <div class="relative z-10">
                                        <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Produk</h3>
                                        <p class="text-gray-600">Produk untuk kategori ini akan segera hadir!</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    // Maintain original functionality
    if (window.location.hash) {
        history.replaceState(null, null, window.location.pathname);
    }

    window.addEventListener('load', function () {
        setTimeout(function () {
            window.scrollTo({ top: 0, behavior: 'auto' });
        }, 10); 
    });

    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    };

    function filterCategories() {
        const input = document.getElementById('searchCategory');
        const filter = input.value.toLowerCase();
        const sections = document.querySelectorAll('.category-section');

        sections.forEach(section => {
            const name = section.dataset.name;
            if (name.includes(filter)) {
                section.style.display = '';
                // Re-trigger animation for visible sections
                section.style.animation = 'none';
                section.offsetHeight; // Trigger reflow
                section.style.animation = 'fadeInUp 0.6s ease forwards';
            } else {
                section.style.display = 'none';
            }
        });
    }

    // Enhanced search with real-time feedback
    document.getElementById('searchCategory').addEventListener('input', function(e) {
        const searchContainer = e.target.closest('.search-container');
        if (e.target.value.length > 0) {
            searchContainer.style.transform = 'scale(1.02)';
            searchContainer.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
        } else {
            searchContainer.style.transform = 'scale(1)';
            searchContainer.style.boxShadow = 'none';
        }
    });

    // Add staggered animation to product cards
    document.addEventListener('DOMContentLoaded', function() {
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.style.animation = 'fadeInUp 0.6s ease forwards';
        });
    });

    // Add parallax effect to floating elements
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const floatingElements = document.querySelectorAll('.floating-circle');
        
        floatingElements.forEach((element, index) => {
            const speed = 0.1 + (index * 0.05);
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
</script>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>