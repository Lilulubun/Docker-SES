<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/navbarDashboard.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    <style>
  
  /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Plus Jakarta Sans", sans-serif; /* Changed to "Plus Jakarta Sans", sans-serif */
}

body {

    color: #000000;
}

/* Navigation Bar */
.navbar {
    width: 100%;
    padding: 10px 20px; /* Menambahkan padding untuk ruang di dalam navbar */
    display: flex;
    justify-content: flex-start; /* Menyusun logo dan menu di kiri */
    align-items: center;
    position: fixed; /* Navbar tetap di atas halaman */
    top: 18px; /* Turunkan navbar sedikit */
    left: 0;
    z-index: 100;
}

.logo img {
    margin-top: 2px;
    margin-left: 25px;
    width: 100px; /* Ukuran logo */
    margin-right: 40px; /* Memberi jarak antara logo dan menu */
}

.nav-links {
    list-style: none;
    display: flex;
}

.nav-links li {
    margin-left: 0px; /* Memberikan jarak antar item menu */
    margin-right: 40px;
}

.nav-links a {
    color: #000000;
    text-decoration: none;
    font-size: 1.1em;
    font-weight: 500;
    transition: color 0.3s ease;
    font-family: "Plus Jakarta Sans", sans-serif; /* Changed to "Plus Jakarta Sans", sans-serif */
    font-weight: 200;
}

.nav-links a:hover {
    color: #b9b9b9; /* Efek hover */
}

    </style>
</head>

<body>
   
<nav class="navbar">
    <div class="logo">
        <img src="assets/image/logo hitam.svg" alt="Logo"> <!-- Change path/logo as needed -->
    </div>
    <ul class="nav-links">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="explore2.php">Explore</a></li>
        <li><a href="blog2.php">Blog</a></li>
     
    </ul>
</nav>


</body>
</html>
