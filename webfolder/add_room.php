<?php
// Memulai sesi
session_start();

// Pastikan user telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Hubungkan ke database
include('includes/db.php');

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_name = trim($_POST['room_name']);
    $device_id = isset($_POST['device_id']) ? intval($_POST['device_id']) : 0; // Default device_id 0

    if (!empty($room_name)) {
        // Insert data ke database
        $stmt = $conn->prepare("INSERT INTO room (room_name, device_id) VALUES (?, ?)");
        $stmt->bind_param("si", $room_name, $device_id);
        if ($stmt->execute()) {
            // Berhasil menambahkan
            header("Location: dashboard.php?success=Room added successfully");
            exit();
        } else {
            // Gagal menambahkan
            header("Location: dashboard.php?error=Failed to add room");
            exit();
        }
    } else {
        // Jika nama room kosong
        header("Location: dashboard.php?error=Room name is required");
        exit();
    }
}
