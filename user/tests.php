<?php
include('../includes/db.php');
$category = $_GET['category'] ?? '';
$filter = $category ? "WHERE category='$category'" : "";
$query = mysqli_query($conn, "SELECT * FROM tests $filter");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Tests</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>All Tests</h2>
    <form method="get">
        <select name="category" onchange="this.form.submit()">
            <option value="">All Categories</option>
            <option value="blood" <?= $category=='blood'?'selected':'' ?>>Blood</option>
            <option value="urine" <?= $category=='urine'?'selected':'' ?>>Urine</option>
            <option value="imaging" <?= $category=='imaging'?'selected':'' ?>>Imaging</option>
        </select>
    </form>

    <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="test-card">
            <h3><?= $row['name'] ?></h3>
            <p><?= $row['description'] ?></p>
            <p>₹<?= $row['price'] ?></p>
            <a href="test-details.php?id=<?= $row['id'] ?>"><button>View Details</button></a>
        </div>
    <?php endwhile; ?>
</body>
</html>
