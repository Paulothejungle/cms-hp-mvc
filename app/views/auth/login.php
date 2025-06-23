<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Buas Store</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/output.css">
    <link rel="icon" href="<?= BASE_URL ?>/image/logo.jpg" type="image/x-icon">  
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
    </style>
</head>
<body class="h-full relative flex items-center justify-center overflow-hidden">

    <!-- Background gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-green-500 opacity-50 z-0"></div>

    <!-- Background image -->
    <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('<?= BASE_URL ?>/image/backgorund-cms.jpg'); opacity: 0.5;"></div>

    <!-- Konten Form Login -->
    <div class="relative z-10 max-w-md w-full bg-white/30 backdrop-blur-md p-8 rounded-xl shadow-2xl text-center animate-fade-in">

        <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Login</h2>

        <form method="POST" action="" class="space-y-6 text-left">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-800 mb-1">Email</label>
                <input type="email" name="email" id="email" required placeholder="Email" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white/80" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-800 mb-1">Password</label>
                <input type="password" name="password" id="password" required placeholder="Password" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white/80" />
            </div>
            <button type="submit" class="w-full bg-blue-700 text-white py-3 rounded-md font-semibold hover:bg-blue-800 hover:scale-105 transition-transform duration-300">
                Login
            </button>
        </form>

        <p class="mt-6 text-sm text-gray-700 text-center">
            Belum punya akun?
            <a href="<?= BASE_URL; ?>/auth/register" class="text-blue-700 hover:underline">Daftar di sini</a>
        </p>
    </div>
</body>
</html>
