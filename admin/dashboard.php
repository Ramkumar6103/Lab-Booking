<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Stats
$totals = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings"));
$todays = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS today FROM bookings WHERE DATE(created_at)=CURDATE()"));
$popular = mysqli_query($conn, "
    SELECT t.name, COUNT(b.id) as count 
    FROM bookings b JOIN tests t ON b.test_id = t.id 
    GROUP BY b.test_id ORDER BY count DESC LIMIT 1
");
$popular_test = mysqli_fetch_assoc($popular);
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Welcome, <?= $_SESSION['admin_user'] ?></h2>
    <a href="logout.php">Logout</a>
    <h3>Dashboard Summary</h3>
    <ul>
        <li>Total Bookings: <?= $totals['total'] ?></li>
        <li>Today's Bookings: <?= $todays['today'] ?></li>
        <li>Most Popular Test: <?= $popular_test['name'] ?? 'N/A' ?></li>
    </ul>
    <a href="manage-tests.php">Manage Tests</a> |
    <a href="manage-bookings.php">Manage Bookings</a> |
    <a href="reports.php">Reports</a>
</body>
</html>
