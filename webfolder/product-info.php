<?php
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login1.php");
    exit();
}
include('includes/db.php'); // Include db.php for database connection

// Get the product ID from URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Query the database for product details
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// If product not found, redirect to explore page
if (!$product) {
    header('Location: explore.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Smart Lighting Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:flex-shrink-0 md:w-1/2">
                    <img class="h-full w-full object-cover md:w-full"
                         src="data:image/jpeg;base64,<?php echo base64_encode($product['image']); ?>"
                         alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="p-8 md:w-1/2">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                        <?php echo htmlspecialchars($product['category']); ?>
                    </div>
                    <h1 class="block mt-1 text-3xl font-bold text-gray-900">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </h1>
                    <p class="mt-4 text-2xl text-gray-700">
                        $<?php echo number_format($product['price'], 2); ?>
                    </p>
                    <p class="mt-4 text-gray-600">
                        <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                    </p>

                    <!-- Back Button -->
                    <div class="mt-8">
                        <a href="<?php echo isset($_SESSION['user_id']) ? 'explore2.php' : 'explore.php'; ?>" 
                           class="inline-block bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-900 transition-colors">
                            Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php include('includes/footer.php'); ?>
