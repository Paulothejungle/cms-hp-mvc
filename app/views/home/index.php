<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda CMS HP</title>
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

    <!-- Konten utama -->
    <div class="relative z-10 max-w-md w-full bg-white/30 backdrop-blur-md p-8 rounded-xl shadow-2xl text-center animate-fade-in">

        <!-- Logo (opsional) -->
        <img src="<?= BASE_URL ?>/image/logo.jpg" alt="Logo CMS HP" class="mx-auto mb-4 w-16 h-16">

        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Heii Welcome to Buas Store</h1>

        <div class="space-x-4">
            <a href="<?= BASE_URL; ?>/auth/login" class="inline-block px-6 py-3 bg-blue-700 text-white font-semibold rounded-md shadow hover:bg-blue-800 hover:scale-105 transition-transform duration-300">
                Login
            </a>
            <a href="<?= BASE_URL; ?>/auth/register" class="inline-block px-6 py-3 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-700 hover:scale-105 transition-transform duration-300">
                Register
            </a>
        </div>
    </div>
</body>
</html>
