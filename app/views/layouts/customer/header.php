<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buas Store</title>
    <!-- Tailwind CSS CDN -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/output.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom favicon -->
    <link rel="icon" href="<?= BASE_URL ?>/image/logo.jpg" type="image/x-icon">

    <style>
        /* Gradient background */
        .gradient-nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Glass effect for navbar */
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Logo animation */
        .logo-text {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        /* Nav link styles */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        .nav-link:hover {
            transform: translateY(-2px);
        }

        /* Button styles */
        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        /* Cart and notification badges */
        .cart-badge, .notification-dot {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .notification-dot {
            top: 0;
            right: 0;
            width: 8px;
            height: 8px;
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes ping {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Mobile menu styles */
        .mobile-menu {
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.show {
            transform: translateY(0);
        }

        .mobile-backdrop {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            transition: opacity 0.3s ease;
        }

        /* Responsive design */
        @media (max-width: 1023px) {
            .lg\\:hidden {
                display: block;
            }
            .lg\\:flex {
                display: none;
            }
            #mobile-menu {
                display: none;
            }
            #mobile-menu.show {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 flex flex-col min-h-screen">
    <?php $currentPage = $_SERVER['REQUEST_URI']; ?>

    <!-- Navbar -->
    <nav class="glass-nav sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-store text-white text-lg"></i>
                    </div>
                    <div class="logo-text text-3xl font-bold">Buas Store</div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-2">
                    <a href="<?= BASE_URL ?>/dashboardcustomer/index" 
                       class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-gray-700 hover:text-blue-600 font-medium <?= strpos($currentPage, '/dashboardcustomer/index') !== false ? 'active bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'hover:bg-blue-50' ?>">
                        <i class="fas fa-home"></i><span>Dashboard</span>
                    </a>
                    <a href="<?= BASE_URL ?>/dashboardcustomer/products" 
                       class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-gray-700 hover:text-blue-600 font-medium <?= strpos($currentPage, '/dashboardcustomer/products') !== false ? 'active bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'hover:bg-blue-50' ?>">
                        <i class="fas fa-boxes"></i><span>Produk</span>
                    </a>
                    <a href="<?= BASE_URL ?>/cart/index" 
                       class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-gray-700 hover:text-blue-600 font-medium <?= strpos($currentPage, '/cart/index') !== false ? 'active bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'hover:bg-blue-50' ?>">
                        <i class="fas fa-shopping-cart"></i><span>Keranjang</span>
                    </a>
                    <a href="<?= BASE_URL ?>/order/myOrders" 
                       class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-gray-700 hover:text-blue-600 font-medium <?= strpos($currentPage, '/order/myOrders') !== false ? 'active bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'hover:bg-blue-50' ?>">
                        <i class="fas fa-clipboard-list"></i><span>Pesanan</span>
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden lg:flex items-center space-x-3">
                    <?php if (!isset($_SESSION['user'])): ?>
                        <a href="<?= BASE_URL ?>/auth/login" 
                           class="btn-success text-white px-6 py-2 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-sign-in-alt"></i><span>Login/Register</span>
                        </a>
                    <?php else: ?>
                        <div class="flex items-center space-x-3">
                            <a href="<?= BASE_URL ?>/profile/index" class="flex items-center space-x-2 bg-blue-50 px-4 py-2 rounded-full">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="text-gray-700 font-medium"><?= isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : 'User' ?></span>
                            </a>
                            <a href="<?= BASE_URL ?>/auth/logout" 
                               onclick="return confirm('Yakin ingin logout?');" 
                               class="btn-danger text-white px-4 py-2 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="menu-btn" class="p-2 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg hover:shadow-xl transition-all duration-300 focus:outline-none">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu lg:hidden absolute top-full left-0 right-0 bg-white shadow-2xl border-t border-gray-200">
            <div class="px-6 py-4 space-y-2">
                <a href="<?= BASE_URL ?>/dashboardcustomer/index" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 <?= strpos($currentPage, '/dashboardcustomer/index') !== false ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' ?>">
                    <i class="fas fa-home text-lg"></i><span class="font-medium">Dashboard</span>
                </a>
                <a href="<?= BASE_URL ?>/dashboardcustomer/products" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 <?= strpos($currentPage, '/dashboardcustomer/products') !== false ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' ?>">
                    <i class="fas fa-boxes text-lg"></i><span class="font-medium">Produk</span>
                </a>
                <a href="<?= BASE_URL ?>/cart/index" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 <?= strpos($currentPage, '/cart/index') !== false ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' ?>">
                    <i class="fas fa-shopping-cart text-lg"></i><span class="font-medium">Keranjang</span>
                </a>
                <a href="<?= BASE_URL ?>/order/myorders" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 <?= strpos($currentPage, '/order/myOrders') !== false ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' ?>">
                    <i class="fas fa-clipboard-list text-lg"></i><span class="font-medium">Pesanan</span>
                </a>
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <?php if (!isset($_SESSION['user'])): ?>
                        <a href="<?= BASE_URL ?>/auth/login" 
                           class="flex items-center justify-center space-x-2 bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-3 rounded-xl font-semibold shadow-lg">
                            <i class="fas fa-sign-in-alt"></i><span>Login/Register</span>
                        </a>
                    <?php else: ?>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3 px-4 py-2 bg-blue-50 rounded-xl">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="text-gray-700 font-medium"><?= isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : 'User' ?></span>
                            </div>
                            <a href="<?= BASE_URL ?>/auth/logout" 
                               onclick="return confirm('Yakin ingin logout?');" 
                               class="flex items-center justify-center space-x-2 bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-3 rounded-xl font-semibold shadow-lg">
                                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Backdrop -->
    <div id="mobile-backdrop" class="mobile-backdrop fixed inset-0 z-40 hidden lg:hidden"></div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileBackdrop = document.getElementById('mobile-backdrop');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        let isMenuOpen = false;

        function toggleMenu() {
            isMenuOpen = !isMenuOpen;
            mobileMenu.classList.toggle('show', isMenuOpen);
            mobileBackdrop.classList.toggle('hidden', !isMenuOpen);
            mobileBackdrop.classList.toggle('opacity-100', isMenuOpen);
            menuIcon.classList.toggle('hidden', isMenuOpen);
            closeIcon.classList.toggle('hidden', !isMenuOpen);
            document.body.style.overflow = isMenuOpen ? 'hidden' : '';
        }

        menuBtn.addEventListener('click', toggleMenu);
        mobileBackdrop.addEventListener('click', toggleMenu);

        // Close menu on link click
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (isMenuOpen) toggleMenu();
            });
        });

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isMenuOpen) toggleMenu();
        });
    </script>
</body>
</html>