<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "141414", "ses");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil kategori yang dipilih untuk blog
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Query untuk blog
$sqlBlog = "SELECT id, title, content, category, author, created_at, image FROM blogs WHERE visible = 1";
if ($selectedCategory) {
    $sqlBlog .= " AND category = '" . $conn->real_escape_string($selectedCategory) . "'";
}
$sqlBlog .= " ORDER BY display_order ASC LIMIT 3";
$resultBlog = $conn->query($sqlBlog);

// Mengambil daftar kategori untuk dropdown
$category_sql = "SELECT DISTINCT category FROM blogs WHERE visible = 1";
$category_result = $conn->query($category_sql);
$categories = [];
if ($category_result->num_rows > 0) {
    $categories = $category_result->fetch_all(MYSQLI_ASSOC);
}

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blogs</title>

  <!-- Link ke Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Link ke Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Custom CSS untuk tombol CTA -->
  <style>
    .cta-button-r {
      margin-left: 20px;
      background-color: #000000; /* Customize button color */
      color: white;
      border: none;
      outline: none;
      gap: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 4px 20px; /* Add padding to create space between text and edge of the background */
      cursor: pointer;
      position: relative;
      z-index: 0;
      border-radius: 1000px; /* Rounded corners */
    }

    .cta-button-r::after {
      content: "";
      z-index: -1;
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: #000000; /* Background color */
      left: 0;
      top: 0;
      border-radius: 1000px; /* Rounded corners */
    }

    /* Glow effect */
    .cta-button-r::before {
      content: "";
      background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #ff00c8, #ff0000);
      position: absolute;
      top: -2px;
      left: -2px;
      background-size: 600%;
      z-index: -1;
      width: calc(100% + 4px);
      height: calc(100% + 4px);
      filter: blur(8px);
      animation: glowing 20s linear infinite;
      transition: opacity 0.3s ease-in-out;
      border-radius: 10px;
      opacity: 0;
    }

    @keyframes glowing {
      0% {
        background-position: 0 0;
      }
      50% {
        background-position: 400% 0;
      }
      100% {
        background-position: 0 0;
      }
    }

    /* Hover */
    .cta-button-r:hover::before {
      opacity: 1;
    }

    .cta-button-r:active::after {
      background: transparent;
    }

    .cta-button-r:active {
      color: #000; /* Change text color on active */
      font-weight: bold; /* Bold text on active */
    }
  </style>

</head>
<body class="font-['Plus Jakarta Sans']">

  <!-- Blog Section -->
  <section class="blog-section max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="flex justify-between items-center mb-8">
      <div class="flex gap-1">
        <!-- Dropdown Kategori untuk Blog -->
        <select id="category" name="category" class="p-2.5 text-base border border-gray-300 rounded-lg bg-white cursor-pointer" onchange="filterCategory()">
          <option value="">category</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?php echo htmlspecialchars($category['category']); ?>" <?php echo ($selectedCategory === $category['category']) ? 'selected' : ''; ?>>
              <?php echo htmlspecialchars($category['category']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- Card Container for Blogs -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php while ($blog = $resultBlog->fetch_assoc()): ?>
      <div class="flex flex-row items-start gap-5 p-5 bg-white shadow-md rounded-lg transition-all duration-300 hover:translate-y-[-5px] hover:shadow-lg">
        <!-- Blog Image -->
        <div class="flex-none w-[150px] h-full rounded-lg bg-gradient-to-r from-[#ff6b6b] to-[#845ec2]">
          <?php if ($blog['image']): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($blog['image']); ?>" alt="Blog Image" class="w-full h-full object-cover rounded-lg">
          <?php endif; ?>
        </div>
        <div class="flex-1 flex flex-col justify-center">
          <h2 class="text-xl font-semibold text-black mb-2.5"><?php echo htmlspecialchars($blog['title']); ?></h2>
          <p class="text-sm text-gray-600 mb-4 leading-relaxed"><?php echo substr(htmlspecialchars($blog['content']), 0, 100) . '...'; ?></p>
          <a href="#" class="text-sm text-[#845ec2] no-underline font-medium hover:text-[#ff6b6b] hover:underline">Read More</a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <!-- Footer Note -->
    <div class="text-center mt-12 text-sm text-gray-600">
      <a href="#" class="text-[#845ec2] no-underline font-medium hover:underline">Browse all posts</a>
    </div>

  <!-- CTA Section -->
<div class="text-center max-w-[579px] mx-auto mt-24 flex flex-col items-center justify-center">
  <div class="space-y-4">
    <p class="text-[46px] font-thin leading-[46px] tracking-[-3px]">Be part of future hope with</p>
    <p class="text-[46px] text-black font-thin tracking-[-3px]">light that planet smiles to you</p>
    <p class="text-2xl text-gray-500 font-thin tracking-[-2px]">When artistry meets efficiency, Shine Smarter Work Better</p>
  </div>
  <button class="cta-button-r mt-8 text-white border-none outline-none flex justify-center items-center gap-2.5 px-8 py-3 rounded-full hover:bg-gray-800 transition-colors duration-300">
    Book a Consultation
  </button>
</div>

  </section>

  <script>
    // Fungsi untuk filter kategori dan memuat ulang halaman
    function filterCategory() {
      var category = document.getElementById('category').value;
      var url = new URL(window.location.href);
      if (category) {
        url.searchParams.set('category', category); // Set category ke parameter URL
      } else {
        url.searchParams.delete('category'); // Hapus category dari URL jika tidak ada kategori
      }
      window.location.href = url.toString(); // Arahkan ulang ke URL dengan parameter kategori
    }
  </script>

</body>
</html>
