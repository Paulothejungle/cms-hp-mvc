<?php require_once '../app/views/layouts/customer/header.php';?>

<!-- profile -->
<div class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
    <div class="container mx-auto px-4 py-8">
        <!-- Profile Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-lg rounded-full mb-4">
                <i class="fas fa-user text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Profil Saya</h1>
            <p class="text-white/90 text-lg">Kelola informasi akun Anda dengan mudah dan praktis</p>
        </div>

        <!-- Alert Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 p-4 bg-green-100/90 backdrop-blur-sm border border-green-300 rounded-xl text-green-700 flex items-center space-x-3 shadow-lg">
                <i class="fas fa-check-circle text-xl"></i>
                <span><?= $_SESSION['success']; unset($_SESSION['success']); ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 p-4 bg-red-100/90 backdrop-blur-sm border border-red-300 rounded-xl text-red-700 flex items-center space-x-3 shadow-lg">
                <i class="fas fa-exclamation-circle text-xl"></i>
                <span><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="mb-6 p-4 bg-red-100/90 backdrop-blur-sm border border-red-300 rounded-xl text-red-700 flex items-center space-x-3 shadow-lg">
                <i class="fas fa-exclamation-circle text-xl"></i>
                <span><?= $error ?></span>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Profile Summary Card -->
            <div class="lg:col-span-1">
                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border border-white/20">
                    <div class="text-center">
                        <!-- Profile Avatar -->
                        <div class="relative inline-block mb-4">
                            <div class="w-24 h-24 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                                <?= strtoupper(substr($profile['name'] ?? 'L', 0, 1)) ?>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                        </div>

                        <!-- Profile Info -->
                        <h2 class="text-xl font-bold text-gray-800 mb-1">
                            <?= htmlspecialchars($profile['name'] ?? 'lina') ?>
                        </h2>
                        <p class="text-gray-600 mb-4">
                            <?= htmlspecialchars($profile['email'] ?? 'lina@gmail.com') ?>
                        </p>

                        <!-- Profile Stats -->
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div class="bg-indigo-50 rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-indigo-600">
                                    <?= htmlspecialchars($totalOrdersCount ?? 0) ?>
                                </div>
                                <div class="text-sm text-gray-600">Total Pesanan</div>
                            </div>

                            <div class="bg-purple-50 rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-purple-600">
                                    <?= htmlspecialchars($inProcessOrdersCount ?? 0) ?>
                                </div>
                                <div class="text-sm text-gray-600">Dalam Proses</div>
                            </div>

                            </div>

                        <?php if (!empty($latestOrder)): ?>
                            <h3 class="text-xl font-bold text-gray-800 mb-4 mt-8 border-b pb-3">Detail Pesanan Terbaru: #<?= htmlspecialchars($latestOrder['id']) ?></h3>
                            <div class="space-y-4">
                                <?php if (!empty($orderItems)): ?>
                                    <?php foreach ($orderItems as $item): ?>
                                        <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-white hover:bg-gray-50 transition duration-150 ease-in-out flex justify-between items-center flex-wrap">
                                            <div class="flex-grow text-left">
                                                <p class="font-semibold text-gray-900 text-lg"><?= htmlspecialchars($item['product_name']) ?></p>
                                                <p class="text-gray-600">Jumlah: <span class="font-medium"><?= htmlspecialchars($item['quantity']) ?></span></p>
                                            </div>
                                            <div class="text-right mt-2 sm:mt-0">
                                                <p class="text-gray-600">Harga Satuan: <span class="font-medium">Rp <?= number_format($item['price'], 0, ',', '.') ?></span></p>
                                                <p class="font-bold text-blue-700 text-lg">Subtotal: Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-gray-500 text-center">Tidak ada item untuk pesanan terbaru ini.</p>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 text-center mt-8">Anda belum memiliki pesanan apapun.</p>
                        <?php endif; ?>

                        <!-- Quick Actions -->
                        <div class="mt-6 space-y-2">
                            <a href="<?= BASE_URL ?>/order/myorders" class="w-full bg-indigo-100 hover:bg-indigo-200 text-indigo-700 py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                                <i class="fas fa-receipt"></i>
                                <span>Lihat Pesanan</span>
                            </a>
                            <a href="<?= BASE_URL ?>/dashboardcustomer/index" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                                <i class="fas fa-home"></i>
                                <span>Kembali ke Dashboard</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="lg:col-span-2">
                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-8 shadow-2xl border border-white/20">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-edit text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Edit Informasi Profil</h2>
                    </div>
                    
                    <form action="<?= BASE_URL ?>/profile/update" method="POST" class="space-y-6">
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label for="name" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                                <i class="fas fa-user text-indigo-500"></i>
                                <span>Nama Lengkap</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="<?= htmlspecialchars($profile['name'] ?? '') ?>" 
                                required
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            >
                        </div>

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label for="email" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                                <i class="fas fa-envelope text-indigo-500"></i>
                                <span>Email</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="<?= htmlspecialchars($profile['email'] ?? '') ?>" 
                                required
                                placeholder="Masukkan alamat email Anda"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            >
                        </div>

                        <!-- Phone Field -->
                        <div class="space-y-2">
                            <label for="phone" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                                <i class="fas fa-phone text-indigo-500"></i>
                                <span>Nomor Telepon</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="<?= htmlspecialchars($profile['phone'] ?? '') ?>" 
                                required
                                placeholder="Masukkan nomor telepon Anda"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                            >
                        </div>

                        <!-- Address Field -->
                        <div class="space-y-2">
                            <label for="address" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                                <i class="fas fa-map-marker-alt text-indigo-500"></i>
                                <span>Alamat</span>
                            </label>
                            <textarea 
                                id="address" 
                                name="address" 
                                required
                                rows="4"
                                placeholder="Masukkan alamat lengkap Anda"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none"
                            ><?= htmlspecialchars($profile['address'] ?? '') ?></textarea>
                        </div>

                        <a href="<?= BASE_URL ?>/profile/changepasswordform"
                            class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out text-center">
                            🔒 Ganti Password
                        </a>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button 
                                type="submit" 
                                class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                            >
                                <i class="fas fa-save"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                            <a 
                                href="<?= BASE_URL?>/dashboardcustomer/index" 
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 hover:shadow-md transform hover:-translate-y-0.5"
                            >
                                <i class="fas fa-times"></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>

<script>
    // Auto hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('[class*="bg-green-100"], [class*="bg-red-100"]');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }, 5000);
        });
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500', 'ring-red-500');
                field.classList.remove('border-gray-300');
                isValid = false;
            } else {
                field.classList.remove('border-red-500', 'ring-red-500');
                field.classList.add('border-gray-300');
            }
        });

        if (!isValid) {
            e.preventDefault();
            // Create and show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'mb-6 p-4 bg-red-100/90 backdrop-blur-sm border border-red-300 rounded-xl text-red-700 flex items-center space-x-3 shadow-lg';
            errorDiv.innerHTML = '<i class="fas fa-exclamation-circle text-xl"></i><span>Harap lengkapi semua field yang wajib diisi</span>';
            
            const form = document.querySelector('form');
            form.parentNode.insertBefore(errorDiv, form);
            
            // Auto remove error after 5 seconds
            setTimeout(() => {
                errorDiv.style.opacity = '0';
                errorDiv.style.transform = 'translateY(-20px)';
                setTimeout(() => errorDiv.remove(), 300);
            }, 5000);
        }
    });

    // Real-time form validation
    document.querySelectorAll('input, textarea').forEach(field => {
        field.addEventListener('input', function() {
            if (this.hasAttribute('required') && this.value.trim()) {
                this.classList.remove('border-red-500', 'ring-red-500');
                this.classList.add('border-green-400', 'ring-green-400');
            } else if (this.hasAttribute('required')) {
                this.classList.remove('border-green-400', 'ring-green-400', 'border-red-500', 'ring-red-500');
                this.classList.add('border-gray-300');
            }
        });

        // Focus effects
        field.addEventListener('focus', function() {
            this.classList.add('ring-2');
        });

        field.addEventListener('blur', function() {
            if (!this.classList.contains('border-red-500') && !this.classList.contains('border-green-400')) {
                this.classList.remove('ring-2');
            }
        });
    });
</script>