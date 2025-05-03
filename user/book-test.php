<?php
include('../includes/db.php');
$test_id = $_GET['test_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $alt = $_POST['alt'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $date = $_POST['date'];

    mysqli_query($conn, "INSERT INTO bookings (test_id, name, phone, alt_phone, email, address, preferred_date)
        VALUES ('$test_id', '$name', '$phone', '$alt', '$email', '$address', '$date')");
    
    $last_id = mysqli_insert_id($conn);
    header("Location: booking-success.php?id=$last_id");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Book Test</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Book Test</h2>
    <form method="POST">
        <input name="name" required placeholder="Full Name"><br>
        <input name="phone" required placeholder="Phone Number"><br>
        <input name="alt" placeholder="Alternate Phone"><br>
        <input name="email" placeholder="Email"><br>
        <textarea name="address" required placeholder="Address"></textarea><br>
        <input type="datetime-local" name="date" required><br>
        <button type="submit">Submit Booking</button>
    </form>
</body>
</html>
