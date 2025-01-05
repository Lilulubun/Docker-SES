<?php
// Memulai sesi
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login1.php");
    exit();
}

// Mengambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];  // ID pengguna yang disimpan dalam sesi

// Menghubungkan file db.php
include('includes/db.php');

// Mengambil data profil pengguna dari database
$sql = "SELECT * FROM user WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Mengecek apakah data pengguna ditemukan
if ($result->num_rows > 0) {
    $profil = $result->fetch_assoc();
} else {
    $profil = null;  // Jika profil tidak ditemukan
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>
    <link rel="stylesheet" href="assets/css/profil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>

<?php include('includes/navbarDashboard.php'); ?>

<h1>User Profile</h1>

<?php if ($profil): ?>
    <div class="profil-container">
        <div class="avatar">
            <?php
   if (!empty($profil['avatar'])) {
    echo '<img src="' . htmlspecialchars($profil['avatar']) . '" alt="Avatar" />';
} else {
    echo '<img src="assets/image/default_avatar.jpg" alt="Avatar" />';
}

    
            ?>
        </div>
        <div class="profil-info">
            <p><strong>Full name:</strong> <?php echo htmlspecialchars($profil['name']) . ' ' . htmlspecialchars($profil['last_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($profil['email']); ?></p>
            <p><strong>Business name:</strong> <?php echo htmlspecialchars($profil['business_name'] ?: 'Tidak ada'); ?></p>
            <p><strong>Phone number:</strong> <?php echo htmlspecialchars($profil['phone_number'] ?: 'Tidak ada'); ?></p>
        </div>
    </div>
    
    <!-- Tombol untuk mengedit profil -->
    <div class="edit-profile">
        <a href="editProfil.php" class="button">Edit Profile</a>
    </div>
<?php else: ?>
    <p>Profil pengguna tidak ditemukan.</p>
<?php endif; ?>

<p><a href="logout.php">Logout</a></p>

</body>
</html>

<?php include('includes/tab.php'); ?>
