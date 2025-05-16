<?php
include('../includes/db.php');
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and collect form inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $alt_phone = mysqli_real_escape_string($conn, $_POST['alt_phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $preferred_datetime = mysqli_real_escape_string($conn, $_POST['preferred_datetime']);
    $test_id = mysqli_real_escape_string($conn, $_POST['test_id']);

    // Optional: validate required fields
    if (empty($name) || empty($phone) || empty($preferred_datetime) || empty($test_id)) {
        $_SESSION['error'] = "Please fill all required fields.";
        header("Location: booking-form.php?test_id=$test_id");
        exit();
    }

    // Store booking in database
    $query = "INSERT INTO bookings (user_id, test_id, name, phone, alt_phone, email, address, preferred_datetime, status, created_at)
              VALUES (
                  " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NULL') . ",
                  '$test_id', '$name', '$phone', '$alt_phone', '$email', '$address', 
                  '$preferred_datetime', 'pending', NOW()
              )";

    if (mysqli_query($conn, $query)) {
        $booking_id = mysqli_insert_id($conn);
        // Redirect to confirmation page
        header("Location: booking-confirmation.php?id=$booking_id");
        exit();
    } else {
        $_SESSION['error'] = "Failed to process booking. Please try again.";
        header("Location: booking-form.php?test_id=$test_id");
        exit();
    }
} else {
    // Invalid access
    header("Location: tests.php");
    exit();
}
?>
