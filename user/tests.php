<?php
include('../includes/db.php');
session_start();

// Handle search and category filter
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';

$query = "SELECT * FROM tests WHERE 1=1";

if ($search) {
    $query .= " AND name LIKE '%$search%'";
}
if ($category && $category !== 'all') {
    $query .= " AND category = '$category'";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Tests - HealthCheck Lab</title>
    <link rel="stylesheet" href="../assets/css/tests.css">
</head>
<body>
    <div class="container">
        <h1>Available Lab Tests</h1>

        <form method="GET" class="filter-form">
            <input type="text" name="search" placeholder="Search tests..." value="<?= htmlspecialchars($search) ?>">
            <select name="category">
                <option value="all" <?= $category == 'all' ? 'selected' : '' ?>>All Categories</option>
                <option value="blood" <?= $category == 'blood' ? 'selected' : '' ?>>Blood</option>
                <option value="urine" <?= $category == 'urine' ? 'selected' : '' ?>>Urine</option>
                <option value="imaging" <?= $category == 'imaging' ? 'selected' : '' ?>>Imaging</option>
                <!-- Add more categories as needed -->
            </select>
            <button type="submit">Filter</button>
        </form>

        <div class="test-list">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="test-card">
                        <h3><?= $row['name'] ?></h3>
                        <p><?= $row['description'] ?></p>
                        <p class="price">₹<?= $row['price'] ?></p>
                        <a href="test-details.php?id=<?= $row['id'] ?>"><button>View Details</button></a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No tests found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
