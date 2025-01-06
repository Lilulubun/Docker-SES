<?php
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login1.php");
    exit();
}
include 'includes/db.php';

// Validasi ID dan cek apakah blog visible
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data blog terlebih dahulu
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ? AND visible = 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    // Cek apakah blog ditemukan
    if (!$blog) {
        die("Blog not found or not visible.");
    }

    // Jika blog ditemukan, lanjutkan dengan penghitungan view
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Cek view dalam 24 jam terakhir
    $stmt = $conn->prepare("SELECT * FROM blog_views WHERE blog_id = ? AND user_ip = ? AND view_time > NOW() - INTERVAL 1 DAY");
    $stmt->bind_param("is", $id, $user_ip);
    $stmt->execute();
    $view_result = $stmt->get_result();

    if ($view_result->num_rows === 0) {
        // Tambahkan view
        $stmt = $conn->prepare("UPDATE blogs SET view_count = view_count + 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Catat log view
        $stmt = $conn->prepare("INSERT INTO blog_views (blog_id, user_ip) VALUES (?, ?)");
        $stmt->bind_param("is", $id, $user_ip);
        $stmt->execute();
    }
} else {
    die("Invalid blog ID.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog['title']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-white-100">
    <!-- Main Article -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header Image -->
            <div class="relative h-96">
                <?php if($blog['image']): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($blog['image']) ?>" 
                     alt="<?= htmlspecialchars($blog['title']) ?>" 
                     class="w-full h-full object-cover">
                <?php endif; ?>
            </div>
            
            <!-- Content -->
            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    <?= htmlspecialchars($blog['title']) ?>
                </h1>
                
                <div class="flex items-center gap-4 mb-6">
                    <span class="px-3 py-1 bg-gray-800 text-white text-sm rounded-full">
                        <?= htmlspecialchars($blog['category']) ?>
                    </span>
                    <span class="text-gray-600 text-sm">
                        Views: <?= number_format($blog['view_count']) ?>
                    </span>
                    <span class="text-gray-600 text-sm">
                        Posted: <?= date('d M Y', strtotime($blog['created_at'])) ?>
                    </span>
                </div>

                <div class="prose max-w-none text-gray-600 mb-8">
                    <?= nl2br(htmlspecialchars($blog['content'])) ?>
                </div>
            </div>
        </div>

        <!-- Also Check Section -->
        <div class="max-w-4xl mx-auto mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Also check</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php
                // Query untuk mengambil artikel terkait
                $stmt = $conn->prepare("SELECT id, title, category, image FROM blogs 
                                      WHERE id != ? AND category = ? AND visible = 1
                                      LIMIT 2");
                $stmt->bind_param("is", $blog['id'], $blog['category']);
                $stmt->execute();
                $related_result = $stmt->get_result();

                while($related = $related_result->fetch_assoc()) {
                    echo '<a href="detail.php?id=' . $related['id'] . '" class="block">';
                    echo '<div class="bg-white rounded-lg shadow-lg overflow-hidden">';
                    echo '<div class="flex h-48">';
                    if($related['image']) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($related['image']) . '" 
                              alt="' . htmlspecialchars($related['title']) . '" 
                              class="w-1/2 object-cover">';
                    }
                    echo '<div class="w-1/2 p-4">';
                    echo '<h3 class="font-bold text-gray-800 mb-2">' . htmlspecialchars($related['title']) . '</h3>';
                    echo '<span class="px-2 py-1 bg-gray-800 text-white text-xs rounded-full">' . 
                         htmlspecialchars($related['category']) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>

        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mt-8">
            <a href="<?php echo isset($_SESSION['user_id']) ? 'blog2.php' : 'blog.php'; ?>" class="text-gray-600 hover:text-gray-800">
                ← Back to Articles
            </a>
        </div>
    </div>
</body>
</html>