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

// Jika tombol ACC ditekan
if (isset($_POST['acc_id'])) {
    $acc_id = (int)$_POST['acc_id'];
    $update_sql = "UPDATE consultation_form SET status = 'finished' WHERE id = $acc_id";
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Status berhasil diubah menjadi finished'); window.location.href='consultations.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah status');</script>";
    }
}

// Ambil data dari tabel consultation_form
$sql = "SELECT * FROM consultation_form ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Forms</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-black border-r border-gray-800 text-white">
            <div class="h-16 flex items-center justify-between px-4 border-b border-gray-800">
                <h2 class="text-xl font-semibold">Admin Dashboard</h2>
            </div>
            <nav class="p-4 space-y-4">
                <a href="adminDashboard.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="consultations.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                    <i class="fas fa-user-friends"></i>
                    <span>User Consultation</span>
                </a>
                <a href="uploadBlog.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                    <i class="fas fa-blog"></i>
                    <span>Upload Blog</span>
                </a>
                <a href="manageProducts.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                    <i class="fas fa-box-open"></i>
                    <span>Manage Products</span>
                </a>
                <a href="logout.php" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3 rounded-md">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
            <a href="/dashboard" class="flex items-center text-sm text-muted-foreground hover:text-foreground">
                        <i class="fas fa-arrow-left mr-1 text-gray-600"></i> 
                        Back to Dashboard
                    </a>
            </div>

            <!-- Consultation Forms -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <h1 class="text-2xl font-bold">Consultation Forms</h1>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">ID</th>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">Company Name</th>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">Field</th>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">Size</th>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">Address</th>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">Goals</th>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">Budget</th>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-3 border-b text-sm font-semibold text-gray-700">Date</th>
                                <th class="px-6 py-3 border-b text-right text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium"><?= $row['id'] ?></td>
                                        <td class="px-6 py-4 text-sm"><?= $row['company_name'] ?></td>
                                        <td class="px-6 py-4 text-sm"><?= $row['company_field'] ?></td>
                                        <td class="px-6 py-4 text-sm"><?= $row['company_size'] ?></td>
                                        <td class="px-6 py-4 text-sm"><?= $row['company_address'] ?></td>
                                        <td class="px-6 py-4 text-sm"><?= $row['goals'] ?></td>
                                        <td class="px-6 py-4 text-sm">$<?= $row['min_budget'] ?> - $<?= $row['max_budget'] ?></td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-2 py-1 rounded text-white 
                                                <?= $row['status'] === 'running' ? 'bg-yellow-500' : 'bg-green-500' ?>">
                                                <?= ucfirst($row['status']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm"><?= $row['created_at'] ?></td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="view_user.php?id_user=<?= $row['id_user'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">View</a>
                                                <?php if ($row['status'] === 'running'): ?>
                                                    <form method="POST" class="inline">
                                                        <input type="hidden" name="acc_id" value="<?= $row['id'] ?>">
                                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">ACC</button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-sm text-gray-500">No data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    
</body>

</html>

<?php
$conn->close();
?>
