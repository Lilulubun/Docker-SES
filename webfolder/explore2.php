<?php 
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login1.php");
    exit();
}
?>

<?php include 'includes/navbarDashboard.php'; ?>
<?php include 'includes/db.php'; // File koneksi database ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore | SES Smart Lighting</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">

    <!-- Hero Section -->
    <section class="w-full py-24 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="space-y-4">
            <p class="text-[2rem] font-normal text-gray-900">
                Discover Our Smart Lighting Solutions
            </p>
            <h1 class="text-[5rem] font-normal leading-tight tracking-tight text-gray-900">
                Transform Your Space with
                <span class="block">Intelligent Shine</span>
            </h1>
        </div>
    </div>
</section>


    <!-- Products Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 flex gap-6">
            <!-- Sidebar -->
            <div class="w-1/4 p-6 bg-white-100 rounded-lg shadow-md">
                <h2 class="font-bold text-xl text-gray-800 mb-4">Our Product</h2>
            
                <ul class="space-y-4 text-gray-800">
                <li class="text-sm hover:text-black cursor-pointer"><a href="?">All Products</a></li>
                    <li class="text-sm hover:text-black cursor-pointer"><a href="?category=Indoor Luminer">Indoor Luminer</a></li>
                    <li class="text-sm hover:text-black cursor-pointer"><a href="?category=LED">LED</a></li>
                    <li class="text-sm hover:text-black cursor-pointer"><a href="?category=Outdoor Luminer">Outdoor Luminer</a></li>
               

                </ul>
            </div>

            <!-- Product Grid -->
            <div class="w-3/4 grid grid-cols-2 md:grid-cols-4 gap-8">
                <?php
                // Get the selected category from the URL (if set)
                $category = isset($_GET['category']) ? $_GET['category'] : '';

                // Modify the SQL query to filter by category if a category is selected
                $query = "SELECT * FROM products";
                if ($category) {
                    $query .= " WHERE category = '" . mysqli_real_escape_string($conn, $category) . "'";
                }

                // Query the database
                $result = mysqli_query($conn, $query);

                // Check if products are returned from the database
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <div class="text-center">
                            <a href="product-info.php?id=' . $row['id'] . '">
                                <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" class="w-full h-48 object-cover rounded-lg mb-4">
                                <p class="font-semibold">' . htmlspecialchars($row['name']) . '</p>
                                <p class="text-gray-500">$' . number_format($row['price'], 2) . '</p>
                            </a>
                        </div>';
                    }
                } else {
                    echo '<p class="text-center col-span-4">No products available.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include 'includes/footer.php'; ?>

</body>
</html>
