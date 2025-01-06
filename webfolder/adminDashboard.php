<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';

// Retrieve statistics from the database
$totalUsers = 0;
$totalReports = 0;
$totalProducts = 0;
$totalBlogs = 0;

try {
    // Total Users
    $result = $conn->query("SELECT COUNT(id_user) AS total FROM user");
    if ($result) {
        $row = $result->fetch_assoc();
        $totalUsers = $row['total'];
    }

    // Total Reports
    $result = $conn->query("SELECT COUNT(id) AS total FROM consultation_form");
    if ($result) {
        $row = $result->fetch_assoc();
        $totalReports = $row['total'];
    }

    // Total Products
    $result = $conn->query("SELECT COUNT(id) AS total FROM products");
    if ($result) {
        $row = $result->fetch_assoc();
        $totalProducts = $row['total'];
    }

    // Total Blogs
    $result = $conn->query("SELECT COUNT(id) AS total FROM blogs");
    if ($result) {
        $row = $result->fetch_assoc();
        $totalBlogs = $row['total'];
    }
} catch (Exception $e) {
    echo "Error retrieving statistics: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="bg-gray-100 text-black">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-black border-r border-gray-800">
            <div class="h-16 flex items-center justify-between px-4 border-b border-gray-800">
                <h2 class="text-xl font-semibold text-white">Admin Dashboard</h2>
            </div>
            <nav class="p-4 space-y-4">
                <a href="#" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
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
        <main class="flex-1 p-6">
            <!-- Header -->
            <header class="bg-white text-black p-4 rounded-lg shadow mb-6">
                <h1 class="text-2xl font-bold">Welcome, Admin!</h1>
                <p class="text-gray-600">You have successfully logged in to the dashboard.</p>
            </header>

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                <!-- Total Users -->
                <div class="bg-white border border-black-700 rounded-lg p-4 text-center">
                    <h3 class="text-lg font-semibold text-black-400">Total Users</h3>
                    <p class="text-3xl font-bold"><?= $totalUsers; ?></p>
                </div>
                <!-- Total Reports -->
                <div class="bg-white border border-black-700 rounded-lg p-4 text-center">
                    <h3 class="text-lg font-semibold text-black-400">Total Reports</h3>
                    <p class="text-3xl font-bold"><?= $totalReports; ?></p>
                </div>
                <!-- Total Products -->
                <div class="bg-white border border-black-700 rounded-lg p-4 text-center">
                    <h3 class="text-lg font-semibold text-black-400">Total Products</h3>
                    <p class="text-3xl font-bold"><?= $totalProducts; ?></p>
                </div>
                <!-- Total Blogs -->
                <div class="bg-white border border-black-700 rounded-lg p-4 text-center">
                    <h3 class="text-lg font-semibold text-black-400">Total Blogs</h3>
                    <p class="text-3xl font-bold"><?= $totalBlogs; ?></p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
a