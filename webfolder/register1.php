<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // If user is logged in, redirect them to the dashboard
    header("Location: dashboard.php");
    exit(); // Ensure no further code is executed
}

include('includes/db.php'); // Include the database connection

// Message for success or error
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $business_name = $_POST['business_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate if email is already in use
    $checkEmail = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($checkEmail);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);  // Debugging help if preparation fails
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email is already taken
        $message = "Email already in use. Please choose another one.";
    } elseif ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Google-related fields can be set to NULL as we don't use them in this form
        $google_id = $google_token = $google_avatar = NULL;

        // Avatar field set to null as we want to use a default value
        $avatar = 'assets/image/default_avatar.jpg'; // Ensure this path is correct

        // Insert data into the database using prepared statements
        $sql = "INSERT INTO user (business_name, email, google_id, google_token, google_avatar, name, last_name, phone_number, password, activation_code, avatar) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);  // Debugging help if preparation fails
        }

        // Bind the parameters and execute the query
        $activation_code = NULL; // Default activation code is NULL
        $stmt->bind_param("sssssssssss", $business_name, $email, $google_id, $google_token, $google_avatar, $name, $last_name, $phone_number, $hashed_password, $activation_code, $avatar);

        if ($stmt->execute()) {
            // Success message, redirect to login
            $message = "Registration successful! You can now login.";
            header("Location: Login1.php?message=" . urlencode($message));
            exit(); // Ensure no further code is executed after redirection
        } else {
            die("Error executing query: " . $stmt->error); // Capture query execution errors
        }
    } else {
        // Passwords do not match
        $message = "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/register1.css" />
    <script>
        window.onload = function() {
            <?php if ($message): ?>
                alert("<?php echo $message; ?>");
            <?php endif; ?>
        };
    </script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
    <div class="logo">
        <a href="index.php">
            <img src="assets/image/logo putih.svg" alt="Logo">
        </a>
    </div>
</nav>

    <!-- Registration Form -->
    <div class="container">
        <div class="left">
            <h1>Join Us Today!</h1>
            <h2>Welcome to the Smart Lighting Revolution</h2>
            <p>Join us to transform your lighting experience with intelligent control and seamless integration.</p>
        </div>
        <div class="right">
            <form method="POST" action="register1.php">
                <div class="name-container">
                    <input type="text" name="name" placeholder="First Name" required />
                    <input type="text" name="last_name" placeholder="Last Name" required />
                </div>
                <input type="text" name="business_name" placeholder="Business Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="tel" name="phone_number" placeholder="Phone Number" required />
                <input type="password" id="password" name="password" required placeholder="Password" />
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm Password" />
                
                <button type="submit">Register</button>
            </form>

            <div class="login">
                <p>Already have an account? <a href="login1.php">Login here</a></p>
            </div>
        </div>
    </div>

</body>
</html>
