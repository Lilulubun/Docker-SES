<?php
// Menghubungkan file db.php
include('includes/db.php');

// Mengecek apakah parameter id ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Ambil id dari URL

    // Query untuk mengambil data konsultasi berdasarkan id
    $sql = "SELECT * FROM consultation_form WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek apakah data ditemukan
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Ambil data ke dalam array
    } else {
        echo "<p>Data not found.</p>";
        exit;
    }
} else {
    echo "<p>No consultation selected.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Details</title>
    <link rel="stylesheet" href="assets/css/details.css">
</head>
<body>

<?php include('includes/navbarDashboard.php'); ?>

<div class="container">
    <!-- Tombol Back di samping form -->
    <a href="javascript:history.back()" class="btn-back">
        <img src="assets/image/Frame 52.svg" alt="Back" width="40" height="40">
    </a>

    <div class="form-wrapper">
        <h1>Consultation Detail</h1>
        <form class="consultation-detail-form">
            <fieldset>
                <legend>Company Detail</legend>
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" value="<?php echo $data['company_name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Company Field</label>
                    <input type="text" value="<?php echo $data['company_field']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Company Size</label>
                    <input type="text" value="<?php echo $data['company_size']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Company Address</label>
                    <input type="text" value="<?php echo $data['company_address']; ?>" readonly>
                </div>
            </fieldset>

            <fieldset>
                <legend>Consultation Detail</legend>
                <div class="form-group">
                    <label>Current Lighting</label>
                    <input type="text" value="<?php echo $data['current_lighting'] ? $data['current_lighting'] : 'N/A'; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Problem Detail</label>
                    <textarea readonly><?php echo $data['problem_detail'] ? $data['problem_detail'] : 'N/A'; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Goals</label>
                    <textarea readonly><?php echo $data['goals'] ? $data['goals'] : 'N/A'; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Min Budget</label>
                    <input type="text" value="<?php echo $data['min_budget'] ? 'Rp ' . number_format($data['min_budget'], 0, ',', '.') : 'N/A'; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Max Budget</label>
                    <input type="text" value="<?php echo $data['max_budget'] ? 'Rp ' . number_format($data['max_budget'], 0, ',', '.') : 'N/A'; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Preferred Date</label>
                    <input type="text" value="<?php echo $data['preferredDate'] ? $data['preferredDate'] : 'N/A'; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Created At</label>
                    <input type="text" value="<?php echo $data['created_at']; ?>" readonly>
                </div>
            </fieldset>
        </form>
    </div>
</div>

</body>
</html>


<?php
$conn->close();
?>
