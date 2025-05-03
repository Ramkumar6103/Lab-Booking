<?php
$host = "localhost";       // Usually 'localhost'
$dbname = "lab_booking";    // Your database name
$user = "root";            // Your DB username
$pass = "password";                // Your DB password (empty for XAMPP default)

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
