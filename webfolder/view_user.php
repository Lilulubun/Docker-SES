<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '141414';
$database = 'ses';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil id_user dari parameter URL
$id_user = isset($_GET['id_user']) ? (int)$_GET['id_user'] : 0;

if ($id_user > 0) {
    // Query untuk mendapatkan data user
    $sql = "SELECT * FROM user WHERE id_user = $id_user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User tidak ditemukan.");
    }
} else {
    die("ID User tidak valid.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-center mb-6">User Profile</h1>
        <div class="bg-white shadow-md rounded-lg p-6">
            <img src="<?= $user['avatar'] ?>" alt="Avatar" class="w-32 h-32 rounded-full mx-auto mb-4">
            <p><strong>Nama:</strong> <?= $user['name'] . ' ' . $user['last_name'] ?></p>
            <p><strong>Email:</strong> <?= $user['email'] ?></p>
            <p><strong>Business Name:</strong> <?= $user['business_name'] ?></p>
            <p><strong>Phone Number:</strong> <?= $user['phone_number'] ?></p>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
