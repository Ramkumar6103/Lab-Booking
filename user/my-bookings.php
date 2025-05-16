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
<head>
    <title>My Bookings - HealthCheck Lab</title>
    <link rel="stylesheet" href="../assets/css/my_bookings.css">
</head>
<body>

<div class="container">
    <div class="top-bar">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></h2>
        <div>
            <a href="index.php">← Back to Home</a>
            <a href="logout.php" style="background-color: #dc3545;">Logout</a>
        </div>
    </div>

    <h3>Your Bookings</h3>

    <table>
        <tr>
            <th>Test</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= htmlspecialchars($row['test_name']) ?></td>
            <td><?= htmlspecialchars($row['preferred_datetime']) ?></td>
            <td class="status <?= strtolower($row['status']) ?>">
                <?= ucfirst($row['status']) ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
