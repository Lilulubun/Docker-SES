<?php
session_start();
include 'includes/db.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['admin'])) {
    header("Location: adminLogin.php");
    exit;
}

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Mengambil file gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $image = null;
    }

    // Persiapkan query untuk menyimpan produk baru
    $sql = "INSERT INTO products (name, category, price, description, image) 
            VALUES (?, ?, ?, ?, ?)";
    
    // Menyusun perintah SQL
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssdss", $name, $category, $price, $description, $image);
        
        if ($stmt->execute()) {
            // Redirect atau beri pesan sukses
            header("Location: manageProducts.php"); // Redirect ke halaman manajemen produk
            exit;
        } else {
            // Jika terjadi error saat menyimpan produk
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
