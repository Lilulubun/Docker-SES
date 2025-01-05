<?php
// Memulai sesi
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Mengambil data pengguna yang sedang login
$id_user = $_SESSION['user_id'];  // ID pengguna yang sedang login
$user_name = $_SESSION['user_name'];  // Nama pengguna yang sedang login

// Menghubungkan file db.php
include('includes/db.php');

// Inisialisasi pesan dan device baru
$message = "";
$new_device = null;

// Menangani form submit untuk menambahkan device
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $device_name = trim($_POST['device_name']);

    if (!empty($device_name)) {
        // Query untuk menyimpan device ke database
        $query = "INSERT INTO devices (id_user, device_name) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $id_user, $device_name);

        if ($stmt->execute()) {
          
            $new_device = [
                'device_name' => $device_name,
                'created_at' => date("Y-m-d H:i:s")
            ];
        } else {
            $message = "Failed to add device. Please try again.";
        }
    } else {
        $message = "Device name cannot be empty.";
    }
}

// Query untuk mengambil semua device yang dimiliki oleh user yang sedang login
$query = "SELECT * FROM devices WHERE id_user = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$devices = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Device</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>

<?php include('includes/navbarDashboard.php'); ?>

<div class="container">

    <!-- Back Button -->
    <a href="mydevice.php" class="btn-back" style="position: absolute; top: 15px; left: 400px;">
        <img src="assets/image/Frame 52.svg" alt="Back" width="40" height="40">
    </a>

    <!-- Message -->
    <?php if ($message): ?>
        <div class="message" style="margin-bottom: 20px; color: green; font-size: 16px;">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <!-- Card for Adding a Device -->
    <div class="card">
    <h2>Control Device</h2>
    <hr />

    <!-- Form for adding a device -->
    <form action="" method="POST" style="display: flex; align-items: center; gap: 10px;">
        <label for="device_name" style="font-size: 18px; color: #333;">Device Name:</label>
        <div class="input-container" style="position: relative; flex-grow: 1;">
            <input type="text" id="device_name" name="device_name" placeholder="Enter Device Name" required
                style="width: 100%; padding: 10px 40px 10px 12px; font-size: 14px; border: 1px solid #ddd; border-radius: 8px; outline: none;">
          
        </div>
        <button type="submit" class="buttons" style="padding: 10px 20px; background-color: black; color: white; font-size: 14px; border: none; border-radius: 8px; cursor: pointer;">Submit</button>
    </form>

    <!-- Display New Device (if any) -->
    <?php if ($new_device): ?>
        <div style="margin-top: 20px; padding: 10px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;">
            <strong>New Device:</strong> <?php echo htmlspecialchars($new_device['device_name']); ?> <br>
            <span style="font-size: 12px; color: #666;">Added on: <?php echo date("d M Y", strtotime($new_device['created_at'])); ?></span>
        </div>
    <?php endif; ?>
</div>

</div>

<?php include('includes/tab.php'); ?>

</body>
</html>
