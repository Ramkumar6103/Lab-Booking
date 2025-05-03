<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) header("Location: login.php");

// Handle status update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE bookings SET status='$status' WHERE id=$id");
}

$bookings = mysqli_query($conn, "
    SELECT b.*, t.name AS test_name 
    FROM bookings b JOIN tests t ON b.test_id = t.id 
    ORDER BY b.created_at DESC
");
?>
<!DOCTYPE html>
<html>
<head><title>Manage Bookings</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>All Bookings</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Test</th><th>Name</th><th>Phone</th>
            <th>Date</th><th>Status</th><th>Action</th>
        </tr>
        <?php while ($b = mysqli_fetch_assoc($bookings)): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['test_name'] ?></td>
            <td><?= $b['name'] ?></td>
            <td><?= $b['phone'] ?></td>
            <td><?= $b['preferred_date'] ?></td>
            <td><?= ucfirst($b['status']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                    <select name="status" onchange="this.form.submit()">
                        <option value="pending" <?= $b['status']=='pending'?'selected':'' ?>>Pending</option>
                        <option value="confirmed" <?= $b['status']=='confirmed'?'selected':'' ?>>Confirmed</option>
                        <option value="completed" <?= $b['status']=='completed'?'selected':'' ?>>Completed</option>
                    </select>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
