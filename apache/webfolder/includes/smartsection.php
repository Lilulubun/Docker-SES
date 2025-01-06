<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Section</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <section class="py-12 smart-section">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
      <!-- Left Side - Text Content -->
      <div class="lg:col-span-5 space-y-6 smart-content">
        <h2 class="text-4xl font-bold text-black-800 leading-tight smart-header">
          Smarter Light, Better<br>Workspaces, Greener<br>Future.
        </h2>
        <p class="text-lg text-black-600 smart-text">
          Take control of your lighting with smart technology that lets you adjust brightness, color, and ambiance with simple voice or app commands. Enjoy energy-efficient solutions that blend functionality with stunning design to elevate any space. Your perfect setup, tailored to your lifestyle.
        </p>
      </div>

      <!-- Right Side - Cards -->
      <div class="lg:col-span-7 grid grid-cols-3 gap-6 smart-cards">
        <!-- Cards Left -->
        <div class="col-span-2 flex flex-col gap-6 cards-left">
          <!-- Horizontal Card 1 -->
          <div class="relative overflow-hidden rounded-2xl shadow-md h-52 horizontal smart-card">
            <img 
              src="assets/image/Professional Exchange at Construction Site 1.png" 
              alt="Free Site Survey" 
              class="w-full h-full object-cover"
            >
            <div class="absolute bottom-4 left-4 bg-white/90 text-gray-800 text-sm font-medium px-4 py-2 rounded-md shadow card-label">
              Free Site Survey
            </div>
          </div>
          <!-- Horizontal Card 2 -->
          <div class="relative overflow-hidden rounded-2xl shadow-md h-52 horizontal smart-card">
            <img 
              src="assets/image/Casual Tech-Engaged Man with Textured Hair 1.png" 
              alt="Control Your Light" 
              class="w-full h-full object-cover"
            >
            <div class="absolute bottom-4 left-4 bg-white/90 text-gray-800 text-sm font-medium px-4 py-2 rounded-md shadow card-label">
              Control Your Light
            </div>
          </div>
        </div>

        <!-- Vertical Card -->
        <div class="relative overflow-hidden rounded-2xl shadow-md col-span-1 row-span-2 vertical smart-card w-64 h-44.1">
          <img 
            src="assets/image/Contemporary Elegance_ The Dance of Light and Shadow 1.png" 
            alt="Energy Efficiency" 
            class="w-full h-full object-cover"
          >
          <div class="absolute bottom-4 left-4 bg-white/90 text-gray-800 text-sm font-medium px-4 py-2 rounded-md shadow card-label">
            Energy Efficiency Meets Artistry
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
