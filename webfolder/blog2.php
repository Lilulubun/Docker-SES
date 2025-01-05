<?php
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login1.php");
    exit();
}

// Include database connection and navbar
include('includes/db.php');
include('includes/navbarDashboard.php');

// Query untuk mengambil 1 blog utama dan 3 side blogs
$sql = "SELECT id, title, content, category, image, visible, display_order 
        FROM blogs 
        WHERE visible = 1
        ORDER BY display_order ASC 
        LIMIT 4";
$result = $conn->query($sql);

// Query untuk artikel populer
$popular_sql = "SELECT id, title, category, image, view_count 
                FROM blogs 
                ORDER BY view_count DESC 
                LIMIT 4";
$popular_result = $conn->query($popular_sql);

// Query untuk mendapatkan kategori unik
$category_sql = "SELECT DISTINCT category FROM blogs WHERE visible = 1";
$category_result = $conn->query($category_sql);

// Handle search query
$search = isset($_GET['search']) ? $_GET['search'] : '';
$selected_category = isset($_GET['category']) ? $_GET['category'] : '';

// Query untuk latest articles dengan search dan filter
$latest_sql = "SELECT id, title, content, category, image 
               FROM blogs 
               WHERE visible = 1";
if (!empty($search)) {
    $latest_sql .= " AND (title LIKE '%$search%' OR content LIKE '%$search%')";
}
if (!empty($selected_category)) {
    $latest_sql .= " AND category = '$selected_category'";
}
$latest_sql .= " ORDER BY created_at DESC";
$latest_result = $conn->query($latest_sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Lighting Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Main Content Wrapper with navbar spacing -->
    <div class="mt-20 container mx-auto">
        <!-- Header -->
        <header class="py-8 text-left mx-auto px-24">
            <h1 class="text-4xl font-bold text-gray-800">Lighting the Space, <span class="text-gray-500">Smart Tips & Trends</span></h1>
            <hr class="w-16 mx-auto mt-4 border-t-2 border-gray-300" />
        </header>

        <!-- Featured Blog Section -->
        <div class="container mx-auto">
            <div class="grid grid-cols-6 gap-4 px-24">
                <?php
                if ($result && $result->num_rows > 0) {
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        if ($i == 0) {
                            // Main Featured Blog
                            ?>
                            <div class="col-span-6 md:col-span-3 row-span-3 bg-white rounded-lg shadow-lg overflow-hidden">
                                <a href="detail.php?id=<?= $row['id'] ?>">
                                    <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" 
                                         alt="<?= htmlspecialchars($row['title']) ?>" 
                                         class="w-full h-64 object-cover">
                                    <div class="p-6">
                                        <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($row['title']) ?></h2>
                                        <p class="text-gray-600 mb-4"><?= htmlspecialchars(substr($row['content'], 0, 350)) ?>...</p>
                                        <div class="flex space-x-2">
                                            <span class="px-3 py-1 bg-gray-800 text-white text-sm rounded-full"><?= htmlspecialchars($row['category']) ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        } else {
                            // Side Blogs
                            ?>
                            <div class="col-span-6 md:col-span-3 bg-white rounded-lg shadow-lg overflow-hidden">
                                <a href="detail.php?id=<?= $row['id'] ?>">
                                    <div class="flex">
                                        <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" 
                                             alt="<?= htmlspecialchars($row['title']) ?>" 
                                             class="w-1/3 object-cover">
                                        <div class="p-4 w-2/3">
                                            <h3 class="text-lg font-bold text-gray-800 mb-2"><?= htmlspecialchars($row['title']) ?></h3>
                                            <p class="text-gray-600 mb-2 text-xs"><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                                            <div class="flex space-x-2">
                                                <span class="px-3 py-1 bg-gray-500 text-white text-xs rounded-full"><?= htmlspecialchars($row['category']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        $i++;
                    }
                }
                ?>
            </div>
        </div>

        <!-- Popular Articles Section -->
        <section class="py-8 bg-white">
            <div class="container mx-auto">
                <div class="px-24">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Popular Articles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <?php
                        if ($popular_result && $popular_result->num_rows > 0) {
                            while ($row = $popular_result->fetch_assoc()) {
                                ?>
                                <a href="detail.php?id=<?= $row['id'] ?>" class="block bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                                    <div>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" 
                                             alt="<?= htmlspecialchars($row['title']) ?>" 
                                             class="w-full h-40 object-cover">
                                        <div class="p-4">
                                            <h3 class="text-lg font-bold text-gray-800 mb-2 hover:text-gray-600 transition-colors"><?= htmlspecialchars($row['title']) ?></h3>
                                            <p class="text-sm text-gray-600 mb-2">Kategori: <?= htmlspecialchars($row['category']) ?></p>
                                            <p class="text-xs text-gray-500">Views: <?= htmlspecialchars($row['view_count']) ?></p>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                        } else {
                            echo '<p class="text-gray-600 text-center col-span-4">No popular articles available.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest Articles Section -->
        <section class="py-8 bg-white">
            <div class="container mx-auto">
                <div class="px-24">
                    <h2 class="text-4xl font-bold text-gray-800 mb-2">Latest Article</h2>
                    <p class="text-xl text-gray-500 mb-6">Discover new smart tips</p>

                    <!-- Category Filter -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <?php while($cat = $category_result->fetch_assoc()): ?>
                            <a href="?category=<?= urlencode($cat['category']) ?>" 
                               class="px-4 py-2 rounded-full <?= ($selected_category == $cat['category']) ? 'bg-black text-white' : 'bg-white text-black' ?> 
                                      hover:bg-black hover:text-white transition-colors">
                                <?= htmlspecialchars($cat['category']) ?>
                            </a>
                        <?php endwhile; ?>
                    </div>

                    <!-- Search Bar -->
                    <div class="relative max-w-md mb-8">
                        <form action="" method="GET" class="flex items-center">
                            <input type="text" 
                                   name="search" 
                                   placeholder="Search" 
                                   value="<?= htmlspecialchars($search) ?>"
                                   class="w-full px-4 py-2 rounded-full border focus:outline-none focus:border-gray-500">
                            <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Latest Articles Grid -->
                    <div class="grid grid-cols-1 gap-6">
                        <?php if ($latest_result && $latest_result->num_rows > 0): ?>
                            <?php while($row = $latest_result->fetch_assoc()): ?>
                                <a href="detail.php?id=<?= $row['id'] ?>" class="block bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" 
                                                 alt="<?= htmlspecialchars($row['title']) ?>" 
                                                 class="w-full h-48 object-cover">
                                        </div>
                                        <div class="w-2/3 p-6">
                                            <h2 class="text-2xl font-bold text-gray-800 mb-3">
                                                <?= htmlspecialchars($row['title']) ?>
                                            </h2>
                                            <p class="text-gray-600 mb-4">
                                                <?= htmlspecialchars(substr($row['content'], 0, 200)) ?>...
                                            </p>
                                            <div class="flex gap-2">
                                                <?php
                                                $categories = explode(',', $row['category']);
                                                foreach($categories as $cat): ?>
                                                    <span class="px-3 py-1 bg-black text-white text-sm rounded-full">
                                                        <?= htmlspecialchars(trim($cat)) ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <p class="text-gray-600">No articles found.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include('includes/footer.php'); ?>
    
    <?php $conn->close(); ?>
</body>
</html>