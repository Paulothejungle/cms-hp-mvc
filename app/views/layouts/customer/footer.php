
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .flex-grow{
            flex-grow: 1;
        }

        footer {
            width: 100%;
            margin-top: auto;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }
        
        .pulse-glow {
            animation: pulseGlow 2s infinite;
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 5px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.8), 0 0 30px rgba(59, 130, 246, 0.4); }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .social-icon {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .social-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }
        
        .social-icon:hover::before {
            width: 100%;
            height: 100%;
        }
        
        .social-icon:hover {
            transform: scale(1.1) rotate(5deg);
        }
        
        .typing-effect {
            overflow: hidden;
            border-right: 2px solid #3B82F6;
            white-space: nowrap;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
        }
        
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #3B82F6; }
        }
        
        .wave-effect {
            position: relative;
            overflow: hidden;
        }
        
        .wave-effect::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: wave 3s linear infinite;
        }
        
        @keyframes wave {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .neon-text {
            text-shadow: 0 0 5px #3B82F6, 0 0 10px #3B82F6, 0 0 20px #3B82F6;
        }
        
        .gradient-text {
            background: linear-gradient(45deg, #3B82F6, #8B5CF6, #EC4899);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #3B82F6;
            border-radius: 50%;
            opacity: 0.7;
            animation: float 6s linear infinite;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.7;
            }
            90% {
                opacity: 0.7;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        .morphing-shape {
            background: linear-gradient(45deg, #3B82F6, #8B5CF6);
            border-radius: 50%;
            animation: morph 4s ease-in-out infinite;
        }
        
        @keyframes morph {
            0%, 100% { border-radius: 50%; }
            25% { border-radius: 25% 75% 75% 25%; }
            50% { border-radius: 75% 25% 25% 75%; }
            75% { border-radius: 25% 75% 25% 75%; }
        }
    </style>


    <!-- Demo content to show footer at bottom -->
    <div class="min-h-screen flex flex-col">
        <div class="flex-grow flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-red-600 mb-4">Attention please...!</h1>
                <p class="text-gray-600">This website is just an E-commerce simulation with a CMS concept.</p>
            </div>
        </div>
        
        <!-- Enhanced Footer -->
        <footer class="gradient-bg text-white relative overflow-hidden w-full">
            <!-- Floating particles -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
                <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
                <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
                <div class="particle" style="left: 40%; animation-delay: 0.5s;"></div>
                <div class="particle" style="left: 50%; animation-delay: 1.5s;"></div>
                <div class="particle" style="left: 60%; animation-delay: 2.5s;"></div>
                <div class="particle" style="left: 70%; animation-delay: 3s;"></div>
                <div class="particle" style="left: 80%; animation-delay: 0.8s;"></div>
                <div class="particle" style="left: 90%; animation-delay: 1.8s;"></div>
            </div>
            
            <!-- Morphing background shapes -->
            <div class="absolute top-4 right-4 w-16 h-16 morphing-shape opacity-20"></div>
            <div class="absolute bottom-4 left-4 w-12 h-12 morphing-shape opacity-30" style="animation-delay: 2s;"></div>
            
            <div class="container mx-auto px-6 py-12 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    
                    <!-- Info Umum -->
                    <div class="glass-effect rounded-2xl p-6 hover-lift wave-effect">
                        <h2 class="text-xl font-bold mb-6 flex items-center neon-text">
                            <div class="w-8 h-8 mr-3 rounded-lg bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center floating">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            Tentang Kami
                        </h2>
                        <p class="text-sm text-white/90 leading-relaxed" style="word-wrap: break-word; opacity: 0;" id="p1">
                            Buas Store adalah platform jual beli
                        </p>
                        <p class="text-sm text-white/90 leading-relaxed" style="word-wrap: break-word; opacity: 0;" id="p2">
                            smartphone terpercaya dengan
                        </p>
                        <p class="text-sm text-white/90 leading-relaxed" style="word-wrap: break-word; opacity: 0;" id="p3">
                            pelayanan terbaik dan
                        </p>
                        <p class="text-sm text-white/90 leading-relaxed" style="word-wrap: break-word; opacity: 0;" id="p4">
                            harga bersaing.
                        </p>
                        <div class="mt-4 w-full h-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full pulse-glow"></div>
                    </div>

                    <script>
                        const paragraphs = [
                            { id: 'p1', delay: 0 },
                            { id: 'p2', delay: 1000 },
                            { id: 'p3', delay: 2000 },
                            { id: 'p4', delay: 3000 }
                        ];

                        paragraphs.forEach(p => {
                            setTimeout(() => {
                                const element = document.getElementById(p.id);
                                element.style.transition = 'opacity 1s';
                                element.style.opacity = '1';
                            }, p.delay);
                        });
                    </script>

                    <!-- Kontak -->
                    <div class="glass-effect rounded-2xl p-6 hover-lift wave-effect">
                        <h2 class="text-xl font-bold mb-6 flex items-center neon-text">
                            <div class="w-8 h-8 mr-3 rounded-lg bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center floating" style="animation-delay: 0.5s;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 2l4 4-4 4M4 6h16M4 6v12a2 2 0 002 2h12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            Kontak
                        </h2>
                        <div class="space-y-3 text-sm text-white/90">
                            <div class="flex items-center space-x-2 hover:text-blue-300 transition-colors">
                                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                <p>Email: support@buasstore.com</p>
                            </div>
                            <div class="flex items-center space-x-2 hover:text-blue-300 transition-colors">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                <p>Telepon: 0857-7381-0843</p>
                            </div>
                        </div>
                        
                        <div class="flex space-x-3 mt-6">
                            <a href="#" class="social-icon w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center hover:shadow-lg" aria-label="Facebook">
                                <svg class="w-5 h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.89h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-icon w-10 h-10 bg-gradient-to-br from-sky-400 to-sky-500 rounded-xl flex items-center justify-center hover:shadow-lg" aria-label="Twitter">
                                <svg class="w-5 h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 001.88-2.37 8.59 8.59 0 01-2.72 1.04 4.28 4.28 0 00-7.3 3.9A12.14 12.14 0 013 4.89a4.28 4.28 0 001.32 5.72 4.27 4.27 0 01-1.94-.54v.05a4.28 4.28 0 003.44 4.2 4.3 4.3 0 01-1.93.07 4.28 4.28 0 003.99 2.97A8.6 8.6 0 012 19.54a12.14 12.14 0 006.56 1.92c7.88 0 12.2-6.53 12.2-12.2 0-.19 0-.39-.01-.58A8.72 8.72 0 0022.46 6z"/>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/rivallhermawann/" class="social-icon w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center hover:shadow-lg" aria-label="Instagram">
                                <svg class="w-5 h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5a3.75 3.75 0 003.75-3.75v-8.5A3.75 3.75 0 0016.25 4h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6zm4.5-3a1 1 0 110 2 1 1 0 010-2z"/>
                                </svg>
                            </a>
                            <a href="https://www.youtube.com/@rivalhermawan7675" class="social-icon w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center hover:shadow-lg" aria-label="YouTube">
                                <svg class="w-5 h-5 relative z-10" fill="currentColor" viewBox="0 0 576 512">
                                    <path d="M549.655 124.083c-6.281-23.65-24.764-42.224-48.404-48.504C456.78 64 288 64 288 64S119.22 64 74.75 75.58c-23.64 6.28-42.123 24.854-48.404 48.504C16 168.555 16 256 16 256s0 87.445 10.346 131.917c6.281 23.65 24.764 42.224 48.404 48.504C119.22 448 288 448 288 448s168.78 0 213.25-11.58c23.64-6.28 42.123-24.854 48.404-48.504C560 343.445 560 256 560 256s0-87.445-10.345-131.917zM232 336V176l142 80-142 80z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Navigasi -->
                    <div class="glass-effect rounded-2xl p-6 hover-lift wave-effect">
                        <h2 class="text-xl font-bold mb-6 flex items-center neon-text">
                            <div class="w-8 h-8 mr-3 rounded-lg bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center floating" style="animation-delay: 1s;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0v-4h4v4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            Navigasi
                        </h2>
                        <ul class="text-sm space-y-3">
                            <li>
                                <a href="<?= BASE_URL ?>/dashboardcustomer/index" class="flex items-center space-x-3 hover:text-blue-300 transition-all duration-300 hover:translate-x-2 group">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full group-hover:scale-150 transition-transform"></div>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/dashboardcustomer/products" class="flex items-center space-x-3 hover:text-blue-300 transition-all duration-300 hover:translate-x-2 group">
                                    <div class="w-2 h-2 bg-green-400 rounded-full group-hover:scale-150 transition-transform"></div>
                                    <span>Produk</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/cart/index" class="flex items-center space-x-3 hover:text-blue-300 transition-all duration-300 hover:translate-x-2 group">
                                    <div class="w-2 h-2 bg-yellow-400 rounded-full group-hover:scale-150 transition-transform"></div>
                                    <span>Keranjang</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/order/myOrders" class="flex items-center space-x-3 hover:text-blue-300 transition-all duration-300 hover:translate-x-2 group">
                                    <div class="w-2 h-2 bg-purple-400 rounded-full group-hover:scale-150 transition-transform"></div>
                                    <span>Pesanan</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Hak Cipta -->
                    <div class="glass-effect rounded-2xl p-6 hover-lift wave-effect">
                        <h2 class="text-xl font-bold mb-6 flex items-center neon-text">
                            <div class="w-8 h-8 mr-3 rounded-lg bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center floating" style="animation-delay: 1.5s;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3m6-1a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            Hak Cipta
                        </h2>
                        <div class="space-y-3 text-sm text-white/90">
                            <p class="flex items-center space-x-2">
                                <span class="text-yellow-400">©</span>
                                <span>2025 BuasStore. Semua Hak Dilindungi.</span>
                            </p>
                            <p class="flex items-center space-x-2">
                                <span class="text-red-400 text-lg">❤️</span>
                                <span>Dibuat dengan cinta oleh Tim Dev</span>
                            </p>
                        </div>
                        <div class="mt-4 text-center">
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full text-xs font-semibold pulse-glow">
                                Made with Love ✨
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bottom section with enhanced styling -->
                <div class="mt-12 pt-8 border-t border-white/20 text-center">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-4">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-sm text-white/80">Server Status: Online</span>
                        </div>
                        <div class="gradient-text font-semibold text-lg">
                            BuasStore - Your Trusted Smartphone Partner
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-white/80">
                            <p>Version: 1.0</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Add random particle generation
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 3 + 's';
            particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
            
            const footer = document.querySelector('footer');
            footer.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 6000);
        }
        
        // Generate particles periodically
        setInterval(createParticle, 1000);
        
        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe footer sections
        document.querySelectorAll('.glass-effect').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
