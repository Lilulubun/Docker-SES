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

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_device_id'])) {
    $delete_device_id = $_POST['delete_device_id'];

    // Query untuk menghapus device berdasarkan ID dan user ID
    $delete_query = "DELETE FROM devices WHERE id = ? AND id_user = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("ii", $delete_device_id, $id_user);
    if ($delete_stmt->execute()) {
 
    } else {
        $message = "Failed to delete device. Please try again.";
    }
}

// Query untuk mengambil semua device yang dimiliki oleh user yang sedang login
$query = "SELECT * FROM devices WHERE id_user = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$connected_devices = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>

<?php include('includes/navbarDashboard.php'); ?>

<h1>Welcome, <?php echo htmlspecialchars($user_name); ?></h1>

<a href="connectDevice.php" class="button">
    <img src="assets/image/Vector (1).svg" alt="icon" class="button-icon">
    ‎  ‎  Connect a Device
</a>

<!-- Display Success or Error Messages -->
<?php if (isset($message)): ?>
    <div style="color: green; margin-bottom: 20px; font-size: 16px;">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<!-- Tab Section -->

<div class="container">
    <div class="card">
        <h2>Connected Device</h2>
        <hr />
        <?php if (!empty($connected_devices)): ?>
            <ul>
                <?php foreach ($connected_devices as $device): ?>
                    <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span>
                            <a href="details.php?id=<?php echo $device['id']; ?>" style="text-decoration: none; color: #000;">
                                <?php echo htmlspecialchars($device['device_name']); ?>
                            </a>
                            <span style="font-size: 12px; color: #666;">(Added on: <?php echo date("d M Y", strtotime($device['created_at'])); ?>)</span>
                        </span>
                        <!-- Delete Button -->
                        <form action="" method="POST" style="margin: 0;">
                            <input type="hidden" name="delete_device_id" value="<?php echo $device['id']; ?>">
                            <button type="submit" style="background-color: red; color: white; border: none; border-radius: 4px; padding: 5px 10px; cursor: pointer;">
                                Delete
                            </button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="text-align: left;">You don't have any device yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php include('includes/tab.php'); ?>
