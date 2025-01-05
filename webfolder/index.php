<?php
session_start(); // Memulai session
include('includes/navbar.php'); // Navbar tetap ditampilkan
include('includes/db.php'); // Menghubungkan ke database

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    // Jika sudah login, alihkan ke halaman dashboard
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sustainable Lighting</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="assets/js/script.js" defer></script>
  <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body>
  <!-- Frame 7 - Hero Section -->
  <div class="Containerlampu">
  <div id="backgroundWrapper" style="z-index: -2;"></div>
    <div class="overlay" id="overlay">
      <img src="assets/image/Property 1 Default.svg" alt="Gambar Overlay" class="lampuImage" id="lampuImage">
      <p class="lampuText" id="lampuText">Turn your light up</p>
    </div>
    <img src="assets/image/Union.svg" alt="Gambar Latar" class="gambarBlank" id="gambarBlank">
  </div>

  <!-- Section untuk menampilkan berbagai konten -->
  <div class="content-sections">
    <?php
    include('includes/textsection.php'); // Menampilkan bagian text
    include('includes/features.php'); // Menampilkan fitur
    include('includes/category.php'); // Menampilkan kategori
    include('includes/embrace.php'); // Menampilkan embrace
    include('includes/smartsection.php'); // Menampilkan smart section
    include('includes/testimoni.php'); // Menampilkan testimoni
    include('includes/stillnotsure.php'); // Menampilkan bagian still not sure
    include('includes/blogsection.php'); // Menampilkan blog
    
    
    
    ?>
  </div>
  
  <script>
    // Skrip tambahan yang sudah ada
    const ctaButtons = document.querySelectorAll('.cta-button, .cta-button-r');
    ctaButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const isLoggedIn = false;
            if (!isLoggedIn) {
                window.location.href = 'Login1.php';
            } else {
                alert('Proceeding to book a consultation...');
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
      const categoryTags = document.querySelectorAll('.category-tag');
      categoryTags.forEach(tag => {
        tag.addEventListener('click', function() {
          categoryTags.forEach(t => t.classList.remove('active'));
          this.classList.add('active');
        });
      });
    });
  </script>



</body>
 <!-- Footer Section -->
 <?php include ('includes/footer.php'); ?>

</html>