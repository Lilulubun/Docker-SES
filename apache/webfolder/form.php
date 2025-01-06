<?php
// Memulai sesi
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login1.php");
    exit();
}

// Menghubungkan file db.php
include('includes/db.php');

// Mengecek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $id_user = $_SESSION['user_id'];  // id_user dari sesi pengguna yang login
    $company_name = $_POST['company-name'];
    $company_field = $_POST['company-field'];
    $company_size = $_POST['company-size'];
    $company_address = $_POST['company-address'];
    $current_lighting = $_POST['current-lighting'];
    $problem_detail = $_POST['problem-detail'];
    $goals = $_POST['goals'];
    $min_budget = $_POST['min-budget'];
    $max_budget = $_POST['max-budget'];
    $privacy_policy = isset($_POST['privacy-policy']) ? 1 : 0;
    $updates_promotions = isset($_POST['updates-promotions']) ? 1 : 0;
    $preferred_date = $_POST['preferred-date']; // Get the preferred date

    // Validasi checkbox
    if (!$privacy_policy) {
        echo "<script>alert('Please agree to the privacy policy before submitting the form.');</script>";
    } elseif (!$updates_promotions) {
        echo "<script>alert('Please agree to receive updates and promotions before submitting the form.');</script>";
    } else {
        // Mengecek koneksi database
        if ($conn) {
            // Menggunakan prepared statement untuk menghindari SQL Injection
            $stmt = $conn->prepare("INSERT INTO consultation_form (company_name, company_field, company_size, company_address, current_lighting, problem_detail, goals, min_budget, max_budget, privacy_policy, updates_promotions, preferredDate, id_user)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Mengikat parameter
            $stmt->bind_param("sssisssiisssi", $company_name, $company_field, $company_size, $company_address, $current_lighting, $problem_detail, $goals, $min_budget, $max_budget, $privacy_policy, $updates_promotions, $preferred_date, $id_user);

            // Mengeksekusi query
            if ($stmt->execute()) {
                // Jika berhasil disimpan
                echo "<script>alert('Form berhasil disubmit! Terima kasih telah mengisi form.');</script>";
                echo "<script>window.location.href='form.php';</script>"; // Opsional: redirect ke halaman form
            } else {
                // Jika terjadi kesalahan dalam eksekusi query
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            // Menutup statement dan koneksi
            $stmt->close();
            $conn->close();
        } else {
            // Jika koneksi ke database gagal
            echo "<script>alert('Gagal menghubungkan ke database. Silakan coba lagi nanti.');</script>";
        }
    }
}
?>

<?php include('includes/navbarDashboard.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Consultation Form</title>
    <link rel="stylesheet" href="assets/css/form.css">
</head>
<body>

    <div class="wrapper">
        <!-- Menambahkan kalimat di luar form dan memastikan posisinya di atas -->
        <div class="form-description">
            <h1>Tell us your story,</h1>
            <h1>and get your advice soon</h1>
        </div>

        <div class="form-container">
            <h2>Company Detail</h2>
            <p>Tell us about your company</p>

            <form action="form.php" method="POST">
                <!-- Menambahkan hidden input untuk id_user -->
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['user_id']; ?>">

                <!-- Company Details -->
                <div class="form-group">
                    <label for="company-name">Company Name</label>
                    <input type="text" id="company-name" name="company-name" placeholder="e.g. SES" required>
                </div>

                <div class="form-group">
                    <label for="company-field">Company Field</label>
                    <input type="text" id="company-field" name="company-field" placeholder="e.g. Retail, Architectural, etc." required>
                </div>

                <div class="form-group">
                    <label for="company-size">Company Size</label>
                    <input type="number" id="company-size" name="company-size" placeholder="Number of Employees" required>
                </div>

                <div class="form-group">
                    <label for="company-address">Company Address</label>
                    <input type="text" id="company-address" name="company-address" placeholder="City and District of your company" required>
                </div>

                <!-- Consultation Details -->
                <h2>Consultation Detail</h2>

                <div class="form-group">
                    <label for="current-lighting">Current Lighting Setup</label>
                    <textarea id="current-lighting" name="current-lighting" placeholder="Type your message here"></textarea>
                </div>

                <div class="form-group">
                    <label for="problem-detail">Problem Detail</label>
                    <textarea id="problem-detail" name="problem-detail" placeholder="Type your message here"></textarea>
                </div>

                <div class="form-group">
                    <label for="goals">Goals</label>
                    <textarea id="goals" name="goals" placeholder="Type your message here"></textarea>
                </div>

                <div class="form-group">
                    <label>Budget Range</label>
                    <div class="budget-range">
                        <input type="number" name="min-budget" placeholder="Min Rp">
                        <input type="number" name="max-budget" placeholder="Max Rp">
                    </div>
                </div>

                <!-- Preferred Date Section -->
                <div class="form-group">
                    <label for="preferred-date">Preferred Date</label>
                    <input type="date" id="preferred-date" name="preferred-date" placeholder="Choose Date">
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="privacy-policy" name="privacy-policy">
                    <label for="privacy-policy">I agree to the processing of my personal data in accordance with the privacy policy.</label>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="updates-promotions" name="updates-promotions">
                    <label for="updates-promotions">I agree to receive updates, promotions, and other communications related to your products and services.</label>
                </div>
                <div class="actions">
                    <a href="dashboard.php" class="cancel-btn" style="text-decoration: none;">Cancel</a>
                    <button type="submit" class="submit-btn">Save Form</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
