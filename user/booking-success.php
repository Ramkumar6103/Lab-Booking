<?php
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head><title>Booking Confirmed</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Booking Successful!</h2>
    <p>Your booking ID: <strong>#<?= $id ?></strong></p>
    <a href="my-bookings.php">View My Bookings</a>
</body>
</html>
