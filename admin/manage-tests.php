<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) header("Location: login.php");

// Handle add test
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $category = $_POST['category'];
    $instructions = $_POST['instructions'];
    mysqli_query($conn, "INSERT INTO tests (name, description, price, duration, category, instructions)
        VALUES ('$name', '$desc', '$price', '$duration', '$category', '$instructions')");
    header("Location: manage-tests.php");
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM tests WHERE id=$id");
    header("Location: manage-tests.php");
}
$tests = mysqli_query($conn, "SELECT * FROM tests ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Manage Tests</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Manage Lab Tests</h2>
    <a href="dashboard.php">Back to Dashboard</a>

    <h3>Add New Test</h3>
    <form method="POST">
        <input name="name" required placeholder="Test Name"><br>
        <textarea name="description" placeholder="Short Description"></textarea><br>
        <input name="price" type="number" required placeholder="Price"><br>
        <input name="duration" placeholder="Duration"><br>
        <select name="category">
            <option value="blood">Blood</option>
            <option value="urine">Urine</option>
            <option value="imaging">Imaging</option>
        </select><br>
        <textarea name="instructions" placeholder="Instructions"></textarea><br>
        <button type="submit" name="add">Add Test</button>
    </form>

    <h3>All Tests</h3>
    <table border="1" cellpadding="8">
        <tr><th>ID</th><th>Name</th><th>Price</th><th>Category</th><th>Action</th></tr>
        <?php while ($t = mysqli_fetch_assoc($tests)): ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= $t['name'] ?></td>
            <td>₹<?= $t['price'] ?></td>
            <td><?= $t['category'] ?></td>
            <td><a href="?delete=<?= $t['id'] ?>" onclick="return confirm('Delete this test?')">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
