<?php
session_start();

// Cek jika user sudah login
if (isset($_SESSION['admin'])) {
    header("Location: adminDashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('includes/db.php'); // Pastikan ini mengarah ke koneksi database yang benar

    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa data login
    $sql = "SELECT * FROM admin WHERE nama = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password); // Binding parameter untuk username dan password
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika username dan password ditemukan
    if ($result->num_rows > 0) {
        // Set session untuk admin
        $_SESSION['admin'] = $username;
        header("Location: adminDashboard.php");
        exit;
    } else {
        // Jika login gagal
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md mx-4 bg-white rounded-lg shadow-lg">
        <div class="text-center p-6">
            <!-- Logo -->
            <div class="bg-black rounded-full p-3 inline-block mb-4">
                <i class="fas fa-user-shield text-white text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-black">Login Admin</h2>
            <p class="text-gray-600 mt-1">Masukkan kredensial Anda untuk masuk ke dashboard admin</p>
        </div>
        <div class="px-6 pb-6">
            <?php if (isset($error)): ?>
                <p class="text-red-500 text-sm mb-4"><?= $error; ?></p>
            <?php endif; ?>
            <form method="POST" class="space-y-6">
                <!-- Username -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-2.5 text-gray-500"></i>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            placeholder="Masukkan username" 
                            class="w-full pl-10 py-2 border rounded-md focus:ring focus:ring-black focus:border-black text-gray-900"
                            required
                        />
                    </div>
                </div>
                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-2.5 text-gray-500"></i>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password" 
                            class="w-full pl-10 py-2 border rounded-md focus:ring focus:ring-black focus:border-black text-gray-900"
                            required
                        />
                    </div>
                </div>
                <!-- Button -->
                <button type="submit" class="w-full py-2 bg-black text-white rounded-md hover:bg-gray-800">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
