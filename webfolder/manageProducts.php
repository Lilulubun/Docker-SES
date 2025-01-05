<?php
session_start();
include 'includes/db.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['admin'])) {
    header("Location: adminLogin.php");
    exit;
}

try {
    // Fetch existing products
    $products = [];
    $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
} catch (Exception $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-black border-r border-gray-800 fixed top-0 left-0 z-10">
        <div class="h-16 flex items-center justify-between px-4 border-b border-gray-800">
            <h2 class="text-xl font-semibold text-white">Admin Dashboard</h2>
        </div>
        <nav class="p-4 space-y-4">
            <a href="adminDashboard.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                <i class="fas fa-home text-gray-400"></i>
                <span>Home</span>
            </a>
            <a href="consultations.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                <i class="fas fa-user-friends text-gray-400"></i>
                <span>User Consultation</span>
            </a>
            <a href="uploadBlog.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                <i class="fas fa-blog text-gray-400"></i>
                <span>Upload Blog</span>
            </a>
            <a href="manageProducts.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                <i class="fas fa-box-open text-gray-400"></i>
                <span>Manage Products</span>
            </a>
            <a href="logout.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                <i class="fas fa-sign-out-alt text-gray-400"></i>
                <span>Logout</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 p-6">
            <div class="mx-auto max-w-7xl space-y-6">
                <div class="flex items-center gap-4">
                    <a href="/dashboard" class="flex items-center text-sm text-muted-foreground hover:text-foreground">
                        <i class="fas fa-arrow-left mr-1 text-gray-600"></i> 
                        Back to Dashboard
                    </a>
                </div>

        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 rounded <?= $messageType === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah/Edit Produk -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-6">Add New Product</h2>
            <form action="processProduct.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" required 
                           class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" required 
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                        <option value="LED">LED</option>
                        <option value="Smart Wiz">Smart Wiz</option>
                        <option value="Smart Hue">Smart Hue</option>
                        <option value="Outdoor Luminer">Outdoor Luminer</option>
                        <option value="Indoor Luminer">Indoor Luminer</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" required step="0.01"
                           class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Product Image</label>
                    <input type="file" name="image" accept="image/*" required
                           class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="4" 
                              class="mt-1 p-2 block w-full border border-gray-300 rounded-md"></textarea>
                </div>

                <button type="submit" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800">
                    Add Product
                </button>
            </form>
        </div>

        <!-- Tabel Produk -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="px-6 py-4"><?= htmlspecialchars($product['name']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($product['category']) ?></td>
                        <td class="px-6 py-4">$<?= number_format($product['price'], 2) ?></td>
                        <td class="px-6 py-4">
                            <img src="data:image/jpeg;base64,<?= base64_encode($product['image']) ?>" 
                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                 class="h-16 w-16 object-cover rounded">
                        </td>
                        <td class="px-6 py-4">
                            <button onclick="deleteProduct(<?= $product['id'] ?>)" 
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            fetch('processProduct.php?id=' + id, { 
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error deleting product');
                }
            });
        }
    }
    </script>
</body>
</html>
