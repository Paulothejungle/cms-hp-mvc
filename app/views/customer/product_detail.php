<?php require_once '../app/views/layouts/customer/header.php'; ?>

<style>
    html {
        scroll-behavior: smooth;
    }
    
    .product-detail-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }
    
    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }
    
    .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .shape:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 20%;
        right: 10%;
        animation-delay: 2s;
    }
    
    .shape:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 30%;
        left: 20%;
        animation-delay: 4s;
    }
    
    .shape:nth-child(4) {
        width: 100px;
        height: 100px;
        bottom: 10%;
        right: 20%;
        animation-delay: 1s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .glass-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    
    .product-image-container {
        position: relative;
        overflow: hidden;
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        transition: all 0.5s ease;
    }
    
    .product-image-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: rotate 4s linear infinite;
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .product-image-container:hover::before {
        opacity: 1;
    }
    
    .product-image-container:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    @keyframes rotate {
        100% { transform: rotate(360deg); }
    }
    
    .product-image {
        transition: all 0.5s ease;
        z-index: 2;
        position: relative;
    }
    
    .product-image:hover {
        transform: scale(1.1) rotate(5deg);
    }
    
    .product-info-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }
    
    .product-info-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
        transition: left 0.8s;
    }
    
    .product-info-container:hover::before {
        left: 100%;
    }
    
    .product-title {
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { filter: drop-shadow(0 0 5px rgba(102, 126, 234, 0.3)); }
        to { filter: drop-shadow(0 0 20px rgba(102, 126, 234, 0.6)); }
    }
    
    .price-display {
        background: linear-gradient(45deg, #00b894, #00cec9);
        color: white;
        display: inline-block;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: bold;
        font-size: 1.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
        animation: pulse-price 2s ease-in-out infinite;
        position: relative;
        overflow: hidden;
    }
    
    .price-display::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }
    
    .price-display:hover::before {
        left: 100%;
    }
    
    @keyframes pulse-price {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .stock-info {
        background: linear-gradient(45deg, #6c5ce7, #a29bfe);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #00b894, #00cec9);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 184, 148, 0.4);
        background: linear-gradient(45deg, #00cec9, #00b894);
    }
    
    .btn-secondary {
        background: linear-gradient(45deg, #fdcb6e, #e17055);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(253, 203, 110, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .btn-secondary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }
    
    .btn-secondary:hover::before {
        left: 100%;
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 203, 110, 0.4);
        background: linear-gradient(45deg, #e17055, #fdcb6e);
    }
    
    .btn-login {
        background: linear-gradient(45deg, #6c5ce7, #a29bfe);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }
    
    .btn-login:hover::before {
        left: 100%;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
        background: linear-gradient(45deg, #a29bfe, #6c5ce7);
    }
    
    .out-of-stock {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        color: white;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 600;
        text-align: center;
        display: inline-block;
        animation: shake 0.5s ease-in-out infinite alternate;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }
    
    @keyframes shake {
        from { transform: translateX(-2px); }
        to { transform: translateX(2px); }
    }
    
    .description-text {
        line-height: 1.8;
        font-size: 1.1rem;
        color: #2d3748;
        background: linear-gradient(45deg, #f7fafc, #edf2f7);
        padding: 20px;
        border-radius: 15px;
        border-left: 4px solid #667eea;
        position: relative;
        overflow: hidden;
    }
    
    .description-text::before {
        content: '"';
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 4rem;
        color: rgba(102, 126, 234, 0.1);
        font-family: serif;
    }
    
    .container-main {
        position: relative;
        z-index: 2;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    
    .product-detail-card {
        animation: slideInUp 0.8s ease-out;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
    }
    
    @keyframes slideInUp {
        from {
            transform: translateY(100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    @media (min-width: 640px) {
        .action-buttons {
            flex-direction: row;
        }
    }
    
    .icon-cart::before {
        content: '🛒';
        margin-right: 8px;
    }
    
    .icon-order::before {
        content: '⚡';
        margin-right: 8px;
    }
    
    .icon-login::before {
        content: '🔐';
        margin-right: 8px;
    }
    
    .breadcrumb {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 1rem 1.5rem;
        border-radius: 50px;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .breadcrumb a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .breadcrumb a:hover {
        color: white;
    }
    
    .product-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 3;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 53%, 80%, 100% { transform: translateY(0); }
        40%, 43% { transform: translateY(-10px); }
        70% { transform: translateY(-5px); }
    }
</style>

<div class="product-detail-bg">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="container mx-auto px-4 py-8 container-main">
        <!-- Breadcrumb -->
        <nav class="breadcrumb text-white">
            <a href="<?= BASE_URL ?>/" class="hover:underline">Home</a>
            <span class="mx-2">›</span>
            <span class="text-white">Detail Produk</span>
        </nav>
        
        <!-- Main Product Card -->
        <div class="product-detail-card">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                <!-- Enhanced Product Image -->
                <div class="product-image-container relative rounded-2xl p-8 shadow-2xl">
                    <?php if ($product['stock'] == 0): ?>
                        <div class="product-badge">
                            Stok Habis
                        </div>
                    <?php else: ?>
                        <div class="product-badge" style="background: linear-gradient(45deg, #00b894, #00cec9);">
                            Tersedia
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex items-center justify-center h-full">
                        <img src="<?= BASE_URL ?>/image/<?= htmlspecialchars($product['image']) ?>"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                             class="product-image max-w-full max-h-[400px] object-contain drop-shadow-2xl">
                    </div>
                    
                    <!-- Decorative elements -->
                    <div class="absolute top-4 left-4 w-8 h-8 bg-gradient-to-br from-white/30 to-transparent rounded-full"></div>
                    <div class="absolute bottom-4 right-4 w-12 h-12 bg-gradient-to-tl from-white/20 to-transparent rounded-full"></div>
                </div>

                <!-- Enhanced Product Information -->
                <div class="product-info-container flex flex-col justify-center p-8 rounded-2xl shadow-2xl">
                    <div class="space-y-6">
                        <!-- Product Title -->
                        <h1 class="product-title text-4xl font-bold mb-4 leading-tight">
                            <?= htmlspecialchars($product['name']) ?>
                        </h1>
                        
                        <!-- Price Display -->
                        <div class="price-display mb-6">
                            Rp <?= number_format($product['price'], 0, ',', '.') ?>
                        </div>
                        
                        <!-- Description -->
                        <div class="description-text mb-6">
                            <?= nl2br(htmlspecialchars($product['description'])) ?>
                        </div>
                        
                        <!-- Stock Information -->
                        <div class="mb-6">
                            <span class="stock-info">
                                📦 Stok: <?= $product['stock'] ?> tersedia
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <?php if (!isset($_SESSION['user'])) : ?>
                                <a href="<?= BASE_URL ?>/auth/login" class="btn-login text-center">
                                    <span class="icon-login"></span>Login untuk Pesan
                                </a>
                            <?php else: ?>
                                <?php if ($product['stock'] > 0): ?>
                                    <a href="<?= BASE_URL ?>/order/checkoutsingle/<?= $product['id'] ?>"
                                       class="btn-primary text-center">
                                        <span class="icon-order"></span>Pesan Sekarang
                                    </a>
                                    <a href="<?= BASE_URL ?>/cart/add/<?= $product['id'] ?>"
                                       class="btn-secondary text-center">
                                        <span class="icon-cart"></span>Tambah ke Keranjang
                                    </a>
                                <?php else: ?>
                                    <div class="out-of-stock">
                                        ❌ Maaf, Stok Sedang Habis
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Additional Info -->
                        <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-white/20">
                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    <span>Kualitas Terjamin</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                    <span>Pengiriman Cepat</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                    <span>Garansi Resmi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add loading animation
    document.addEventListener('DOMContentLoaded', function() {
        const productCard = document.querySelector('.product-detail-card');
        const productImage = document.querySelector('.product-image');
        const productTitle = document.querySelector('.product-title');
        
        // Stagger animations
        setTimeout(() => {
            productImage.style.opacity = '1';
            productImage.style.transform = 'scale(1) rotate(0deg)';
        }, 500);
        
        setTimeout(() => {
            productTitle.style.opacity = '1';
            productTitle.style.transform = 'translateY(0)';
        }, 800);
    });
    
    // Add parallax effect to floating shapes
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const shapes = document.querySelectorAll('.shape');
        
        shapes.forEach((shape, index) => {
            const speed = 0.1 + (index * 0.05);
            shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
        });
    });
    
    // Add interactive effects to buttons
    document.querySelectorAll('[class*="btn-"]').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
        
        button.addEventListener('click', function() {
            this.style.transform = 'translateY(1px) scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'translateY(-3px) scale(1.05)';
            }, 150);
        });
    });
    
    // Add image zoom functionality
    const productImage = document.querySelector('.product-image');
    const imageContainer = document.querySelector('.product-image-container');
    
    let isZoomed = false;
    
    imageContainer.addEventListener('click', function() {
        if (!isZoomed) {
            productImage.style.transform = 'scale(2) rotate(0deg)';
            productImage.style.cursor = 'zoom-out';
            this.style.overflow = 'visible';
            this.style.zIndex = '1000';
            isZoomed = true;
        } else {
            productImage.style.transform = 'scale(1) rotate(0deg)';
            productImage.style.cursor = 'zoom-in';
            this.style.overflow = 'hidden';
            this.style.zIndex = 'auto';
            isZoomed = false;
        }
    });
    
    // Add subtle animation to price
    const priceDisplay = document.querySelector('.price-display');
    setInterval(() => {
        priceDisplay.style.transform = 'scale(1.02)';
        setTimeout(() => {
            priceDisplay.style.transform = 'scale(1)';
        }, 200);
    }, 3000);
</script>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>