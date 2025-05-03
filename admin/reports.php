<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) header("Location: login.php");

$bookings = mysqli_query($conn, "
    SELECT b.*, t.name AS test_name 
    FROM bookings b JOIN tests t ON b.test_id = t.id 
    ORDER BY b.created_at DESC
");
?>
<!DOCTYPE html>
<html>
<head><title>Reports</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Download Reports</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    <table border="1" cellpadding="8">
        <tr><th>ID</th><th>Test</th><th>Name</th><th>Date</th><th>Status</th></tr>
        <?php while ($b = mysqli_fetch_assoc($bookings)): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['test_name'] ?></td>
            <td><?= $b['name'] ?></td>
            <td><?= $b['preferred_date'] ?></td>
            <td><?= ucfirst($b['status']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
