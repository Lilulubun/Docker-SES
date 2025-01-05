<?php
// Memulai sesi
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login1.php");
    exit();
}

// Mengambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Menghubungkan ke database
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
    $profil = null;
}

// Proses pembaruan profil jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $profil['email']; // Email tidak dapat diubah
    $phone_number = $_POST['phone_number'];
    $business_name = $_POST['business_name'];

    // Periksa apakah file gambar avatar diupload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $targetDir = "uploads/avatars/";
        $fileName = basename($_FILES['avatar']['name']);
        $targetFilePath = $targetDir . $fileName;
        
        // Validasi file (opsional, seperti tipe file dan ukuran)
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024; // Maksimal ukuran file 5MB

        if (in_array(strtolower($fileType), $allowedTypes)) {
            if ($_FILES['avatar']['size'] <= $maxFileSize) {
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath)) {
                    $avatar = $targetFilePath; // Simpan path ke database
                } else {
                    $message = "Gagal mengupload file.";
                }
            } else {
                $message = "Ukuran file terlalu besar. Maksimal 5MB.";
            }
        } else {
            $message = "Hanya file dengan format JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        }
    } else {
        $avatar = $profil['avatar']; // Tetap menggunakan avatar lama jika tidak ada yang diupload
    }

    // Menyiapkan query untuk memperbarui data pengguna
    $sql = "UPDATE user SET name = ?, last_name = ?, phone_number = ?, business_name = ?, avatar = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $last_name, $phone_number, $business_name, $avatar, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Profil berhasil diperbarui!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui profil.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="assets/css/editProfil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>

<?php include('includes/navbarDashboard.php'); ?>

<h1>Edit Profile</h1>


<div class="container">
    <!-- Tombol Back di samping form -->
    <a href="profil.php" class="btn-back">
        <img src="assets/image/Frame 52.svg" alt="Back" width="40" height="40">
    </a>



<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<?php if ($profil): ?>
    <form action="editProfil.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($profil['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($profil['last_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($profil['email']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($profil['phone_number']); ?>">
        </div>
        <div class="form-group">
            <label for="business_name">Business Name</label>
            <input type="text" id="business_name" name="business_name" value="<?php echo htmlspecialchars($profil['business_name']); ?>">
        </div>
        <div class="form-group">
            <label for="avatar">Upload Avatar</label>
            <input type="file" id="avatar" name="avatar" accept="image/*">
        </div>
        <button type="submit">Save Changes</button>
    </form>
<?php else: ?>
    <p>Profil tidak ditemukan.</p>
<?php endif; ?>


</div>

</body>
</html>
