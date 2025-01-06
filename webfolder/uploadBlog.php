<?php
session_start();
include 'includes/db.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    die("Access denied. Please log in as admin.");
}

$author = $_SESSION['admin']; // The logged-in admin's name

// Handle form submission for adding a blog
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $image = $_FILES['image']['tmp_name'];

        $imageData = file_get_contents($image);  // Read the image into a binary string

        $stmt = $conn->prepare("INSERT INTO blogs (title, content, category, image, visible, display_order, author) 
                                VALUES (?, ?, ?, ?, 1, ?, ?)");
        $stmt->bind_param("ssssis", $title, $content, $category, $imageData, $displayOrder, $author);

        if ($stmt->execute()) {
            $message = "Blog added successfully!";
            $messageType = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }
    }

    // Handle Blog Deletion
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $deleteId = (int)$_POST['id'];
        
        if ($conn->query("DELETE FROM blogs WHERE id = $deleteId")) {
            $message = "Blog deleted successfully!";
            $messageType = "success";
        } else {
            $message = "Error: " . $conn->error;
            $messageType = "error";
        }
    }
}

// Fetch all blogs
$result = $conn->query("SELECT id, title, content, view_count FROM blogs WHERE visible = 1 ORDER BY display_order ASC");
$blogPosts = [];
while ($row = $result->fetch_assoc()) {
    $blogPosts[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Blog Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
</head>
<body class="bg-gray-100">
    <div class="flex">
        
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

                <!-- Blog Upload Form -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold mb-6">Add New Blog</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Blog Title</label>
                                <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter blog title" required>
                            </div>

                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Blog Content</label>
                                <textarea id="content" name="content" class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" rows="6" placeholder="Write blog content here" required></textarea>
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <input type="text" id="category" name="category" class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter category" required>
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                                <input type="file" id="image" name="image" class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <button type="submit" class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-upload mr-2"></i> Add Blog
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Blog List -->
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 mt-8">
                    <?php foreach ($blogPosts as $post): ?>
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <h3 class="font-semibold mb-2 text-lg"><?= htmlspecialchars($post['title']) ?></h3>
                            <p class="text-sm text-gray-600 mb-4"><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-eye mr-1"></i>
                                    Views: <?= $post['view_count'] ?>
                                </div>
                                <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
