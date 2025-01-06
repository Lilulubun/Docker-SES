<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "141414", "ses");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil kategori yang dipilih untuk produk
$selectedProductCategory = isset($_GET['product_category']) ? $_GET['product_category'] : '';

// Query untuk produk
$sqlProduct = "SELECT name, image, price, description, category FROM products";
if (!empty($selectedProductCategory)) {
    $sqlProduct .= " WHERE category = '" . $conn->real_escape_string($selectedProductCategory) . "'";
}
$sqlProduct .= " LIMIT 5";
$resultProduct = $conn->query($sqlProduct);

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>

  <!-- Link ke Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Link ke Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="font-['Plus Jakarta Sans']">

  <!-- Category Section for Products -->
  <section class="w-full py-24">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="text-center mb-12">
        <h2 class="text-4xl md:text-5xl font-bold">
          Various Categories, 
          <span class="text-gray-400 relative">
            Tons of Possibilities.
            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-black"></span>
          </span>
        </h2>
      </div>

      <!-- Product Grid -->
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6 mb-12">
        <?php
        if ($resultProduct->num_rows > 0) {
          while ($row = $resultProduct->fetch_assoc()) {
            $imageData = base64_encode($row['image']);
            $imageSrc = 'data:image/png;base64,' . $imageData;
        ?>
          <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="aspect-square mb-4">
              <img src="<?php echo $imageSrc; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="w-full h-full object-contain">
            </div>
            <p class="text-center font-medium"><?php echo htmlspecialchars($row['name']); ?></p>
            <p class="text-center text-gray-500">$<?php echo number_format($row['price'], 2); ?></p>
          </div>
        <?php
          }
        } else {
          echo "<p class='text-center text-gray-500'>No products available for this category.</p>";
        }
        ?>
      </div>

      <!-- Category Tags -->
      <div class="flex flex-wrap justify-center gap-3 mb-16">
        <?php
        $tags = ['Indoor Luminer', 'LED', 'Outdoor Luminer'];
        foreach ($tags as $tag) : ?>
          <a href="?product_category=<?php echo urlencode($tag); ?>" class="category-link">
            <button class="px-6 py-2 rounded-full <?php echo ($selectedProductCategory === $tag) ? 'bg-black text-white' : 'border border-gray-300'; ?> hover:bg-gray-100 transition-colors duration-300">
              <?php echo $tag; ?>
            </button>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Prevent JavaScript Interference -->
  <script>
    // Disable any form or alert from being triggered unintentionally
    // Ensure no form submission on category button click or any alert triggers

    // This will prevent form submission if you are using forms in your code
    document.querySelectorAll('form').forEach(function(form) {
      form.addEventListener('submit', function(event) {
        event.preventDefault(); // Disable form submission
      });
    });

    // Ensure no alerts are triggered by accident
    window.alert = function() {}; // Override the alert function
  </script>

</body>
</html>
