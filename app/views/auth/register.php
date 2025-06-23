<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - Buas Store</title>
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/output.css">
  <link rel="icon" href="<?= BASE_URL ?>/image/logo.jpg" type="image/x-icon">
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
<body class="min-h-screen relative overflow-hidden">

  <!-- Background gradient -->
  <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-green-500 opacity-50 z-0"></div>

  <!-- Background image -->
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('<?= BASE_URL ?>/image/backgorund-cms.jpg'); opacity: 0.5;"></div>

  <!-- Konten Form Register -->
  <div class="relative z-10 flex justify-end items-center min-h-screen px-4">
    <div class="w-full max-w-sm bg-white/30 backdrop-blur-md p-6 rounded-xl shadow-2xl animate-fade-in mt-10 mb-16 mr-4 md:mr-12">
      <h2 class="text-2xl font-bold text-gray-900 mb-5 text-center">Register</h2>

      <form method="POST" action="" class="space-y-4 text-left text-sm">
        <div>
          <label for="name" class="block font-medium text-gray-800 mb-1">Nama</label>
          <input type="text" name="name" id="name" required placeholder="Nama" class="w-full bg-white/80 border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none" />
        </div>
        <div>
          <label for="email" class="block font-medium text-gray-800 mb-1">Email</label>
          <input type="email" name="email" id="email" required placeholder="Email" class="w-full bg-white/80 border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none" />
        </div>
        <div>
          <label for="password" class="block font-medium text-gray-800 mb-1">Password</label>
          <input type="password" name="password" id="password" required placeholder="Password" class="w-full bg-white/80 border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none" />
        </div>
        <div>
          <label for="phone" class="block font-medium text-gray-800 mb-1">No. Telepon</label>
          <input type="text" name="phone" id="phone" required placeholder="No. Telepon" class="w-full bg-white/80 border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none" />
        </div>
        <div>
          <label for="address" class="block font-medium text-gray-800 mb-1">Alamat</label>
          <input type="text" name="address" id="address" required placeholder="Alamat" class="w-full bg-white/80 border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none" />
        </div>
        <button type="submit" class="w-full bg-green-600 text-white py-2.5 rounded-md font-semibold hover:bg-green-700 hover:scale-105 transition-transform duration-300">
          Register
        </button>
      </form>

      <p class="mt-5 text-center text-sm text-gray-700">
        Sudah punya akun?
        <a href="<?= BASE_URL; ?>/auth/login" class="text-green-600 hover:underline">Login di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
