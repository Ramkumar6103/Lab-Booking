<?php
include('../includes/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT b.*, t.name AS test_name 
    FROM bookings b 
    JOIN tests t ON b.test_id = t.id 
    WHERE b.user_id = $user_id 
    ORDER BY b.created_at DESC");
?>
<!DOCTYPE html>
<html>
<head><title>My Bookings</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Welcome, <?= $_SESSION['user_name'] ?></h2>
    <h3>Your Bookings</h3>
    <a href="logout.php">Logout</a>
    <table border="1" cellpadding="8">
        <tr>
            <th>Test</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $row['test_name'] ?></td>
            <td><?= $row['preferred_date'] ?></td>
            <td><?= ucfirst($row['status']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
