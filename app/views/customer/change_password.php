<?php require_once '../app/views/layouts/customer/header.php';?>

<div class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 py-8">
    <div class="container mx-auto px-4 max-w-2xl">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-lg rounded-full mb-4">
                <i class="fas fa-key text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Ganti Password</h1>
            <p class="text-white/90 text-lg">Pastikan keamanan akun Anda dengan password yang kuat</p>
        </div>

        <!-- Alert Messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 p-4 bg-red-100/90 backdrop-blur-sm border border-red-300 rounded-xl text-red-700 flex items-center space-x-3 shadow-lg animate-pulse">
                <i class="fas fa-exclamation-circle text-xl"></i>
                <span><?= $_SESSION['error'] ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 p-4 bg-green-100/90 backdrop-blur-sm border border-green-300 rounded-xl text-green-700 flex items-center space-x-3 shadow-lg animate-pulse">
                <i class="fas fa-check-circle text-xl"></i>
                <span><?= $_SESSION['success'] ?></span>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Change Password Card -->
        <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-8 shadow-2xl border border-white/20">
            <div class="flex items-center space-x-3 mb-8">
                <div class="w-12 h-12 bg-indigo-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-shield-alt text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Keamanan Akun</h2>
                    <p class="text-gray-600 text-sm">Ubah password untuk meningkatkan keamanan</p>
                </div>
            </div>

            <!-- Password Change Form -->
            <form action="<?= BASE_URL ?>/profile/changepassword" method="POST" class="space-y-6" id="changePasswordForm">
                <!-- Old Password Field -->
                <div class="space-y-2">
                    <label for="old_password" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-indigo-500"></i>
                        <span>Password Lama</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="old_password"
                            name="old_password" 
                            required
                            placeholder="Masukkan password lama Anda"
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                        >
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors" onclick="togglePassword('old_password')">
                            <i class="fas fa-eye" id="old_password_icon"></i>
                        </button>
                    </div>
                </div>

                <!-- New Password Field -->
                <div class="space-y-2">
                    <label for="new_password" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-key text-indigo-500"></i>
                        <span>Password Baru</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="new_password"
                            name="new_password" 
                            required
                            placeholder="Masukkan password baru Anda"
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                        >
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors" onclick="togglePassword('new_password')">
                            <i class="fas fa-eye" id="new_password_icon"></i>
                        </button>
                    </div>
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="flex space-x-1 mb-1">
                            <div class="h-2 flex-1 bg-gray-200 rounded-full">
                                <div class="h-full bg-red-500 rounded-full transition-all duration-300" id="strength_bar" style="width: 0%"></div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500" id="strength_text">Masukkan password baru</p>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="confirm_password" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-check-double text-indigo-500"></i>
                        <span>Konfirmasi Password Baru</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="confirm_password"
                            name="confirm_password" 
                            required
                            placeholder="Ulangi password baru Anda"
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                        >
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors" onclick="togglePassword('confirm_password')">
                            <i class="fas fa-eye" id="confirm_password_icon"></i>
                        </button>
                    </div>
                    <!-- Password Match Indicator -->
                    <div id="password_match" class="hidden">
                        <p class="text-xs flex items-center space-x-1">
                            <i class="fas fa-times-circle text-red-500"></i>
                            <span class="text-red-500">Password tidak cocok</span>
                        </p>
                    </div>
                    <div id="password_match_success" class="hidden">
                        <p class="text-xs flex items-center space-x-1">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-green-500">Password cocok</span>
                        </p>
                    </div>
                </div>

                <!-- Password Requirements -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <h4 class="text-sm font-semibold text-blue-800 mb-2 flex items-center space-x-2">
                        <i class="fas fa-info-circle"></i>
                        <span>Persyaratan Password:</span>
                    </h4>
                    <ul class="text-xs text-blue-700 space-y-1">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500 hidden" id="req_length"></i>
                            <i class="fas fa-times-circle text-red-500" id="req_length_fail"></i>
                            <span>Minimal 8 karakter</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500 hidden" id="req_upper"></i>
                            <i class="fas fa-times-circle text-red-500" id="req_upper_fail"></i>
                            <span>Mengandung huruf besar</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500 hidden" id="req_lower"></i>
                            <i class="fas fa-times-circle text-red-500" id="req_lower_fail"></i>
                            <span>Mengandung huruf kecil</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500 hidden" id="req_number"></i>
                            <i class="fas fa-times-circle text-red-500" id="req_number_fail"></i>
                            <span>Mengandung angka</span>
                        </li>
                    </ul>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button 
                        type="submit" 
                        class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submitBtn"
                    >
                        <i class="fas fa-save"></i>
                        <span>Ubah Password</span>
                    </button>
                    <a 
                        href="<?= BASE_URL ?>/profile" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 hover:shadow-md transform hover:-translate-y-0.5"
                    >
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali ke Profil</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Security Tips -->
        <div class="mt-8 bg-white/90 backdrop-blur-lg rounded-xl p-6 shadow-lg border border-white/20">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                <i class="fas fa-lightbulb text-yellow-500"></i>
                <span>Tips Keamanan Password</span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-shield-alt text-green-500 mt-1"></i>
                    <span>Gunakan kombinasi huruf besar, kecil, angka, dan simbol</span>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-clock text-blue-500 mt-1"></i>
                    <span>Ganti password secara berkala</span>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-ban text-red-500 mt-1"></i>
                    <span>Jangan gunakan informasi personal</span>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-user-secret text-purple-500 mt-1"></i>
                    <span>Jangan bagikan password kepada siapapun</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/customer/footer.php'; ?>

<script>
    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '_icon');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        const requirements = {
            length: password.length >= 8,
            upper: /[A-Z]/.test(password),
            lower: /[a-z]/.test(password),
            number: /\d/.test(password)
        };

        // Update requirement indicators
        Object.keys(requirements).forEach(req => {
            const checkIcon = document.getElementById(`req_${req}`);
            const failIcon = document.getElementById(`req_${req}_fail`);
            
            if (requirements[req]) {
                checkIcon.classList.remove('hidden');
                failIcon.classList.add('hidden');
                strength++;
            } else {
                checkIcon.classList.add('hidden');
                failIcon.classList.remove('hidden');
            }
        });

        // Update strength bar
        const strengthBar = document.getElementById('strength_bar');
        const strengthText = document.getElementById('strength_text');
        const percentage = (strength / 4) * 100;
        
        strengthBar.style.width = percentage + '%';
        
        if (strength === 0) {
            strengthBar.className = 'h-full bg-gray-300 rounded-full transition-all duration-300';
            strengthText.textContent = 'Masukkan password baru';
            strengthText.className = 'text-xs text-gray-500';
        } else if (strength === 1) {
            strengthBar.className = 'h-full bg-red-500 rounded-full transition-all duration-300';
            strengthText.textContent = 'Password lemah';
            strengthText.className = 'text-xs text-red-500';
        } else if (strength === 2) {
            strengthBar.className = 'h-full bg-yellow-500 rounded-full transition-all duration-300';
            strengthText.textContent = 'Password sedang';
            strengthText.className = 'text-xs text-yellow-600';
        } else if (strength === 3) {
            strengthBar.className = 'h-full bg-blue-500 rounded-full transition-all duration-300';
            strengthText.textContent = 'Password kuat';
            strengthText.className = 'text-xs text-blue-600';
        } else {
            strengthBar.className = 'h-full bg-green-500 rounded-full transition-all duration-300';
            strengthText.textContent = 'Password sangat kuat';
            strengthText.className = 'text-xs text-green-600';
        }

        return strength;
    }

    // Check password match
    function checkPasswordMatch() {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const matchError = document.getElementById('password_match');
        const matchSuccess = document.getElementById('password_match_success');

        if (confirmPassword.length > 0) {
            if (newPassword === confirmPassword) {
                matchError.classList.add('hidden');
                matchSuccess.classList.remove('hidden');
                return true;
            } else {
                matchError.classList.remove('hidden');
                matchSuccess.classList.add('hidden');
                return false;
            }
        } else {
            matchError.classList.add('hidden');
            matchSuccess.classList.add('hidden');
            return false;
        }
    }

    // Event listeners
    document.getElementById('new_password').addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
    });

    document.getElementById('confirm_password').addEventListener('input', function() {
        checkPasswordMatch();
    });

    // Form validation
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        
        // Check password strength
        const strength = checkPasswordStrength(newPassword);
        if (strength < 3) {
            e.preventDefault();
            alert('Password harus memenuhi minimal 3 dari 4 persyaratan keamanan');
            return;
        }

        // Check password match
        if (newPassword !== confirmPassword) {
            e.preventDefault();
            alert('Konfirmasi password tidak cocok');
            return;
        }
    });

    // Auto hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('[class*="bg-red-100"], [class*="bg-green-100"]');
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
</script>