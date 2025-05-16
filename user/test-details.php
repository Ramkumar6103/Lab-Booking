<?php
include('../includes/db.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: tests.php");
    exit();
}

$test_id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM tests WHERE id = $test_id");

if (mysqli_num_rows($query) == 0) {
    echo "Test not found.";
    exit();
}

$test = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($test['name']) ?> - Test Details</title>
    <link rel="stylesheet" href="../assets/css/test-details.css">
</head>
<body>

<div class="container">
    <h1><?= htmlspecialchars($test['name']) ?></h1>
    
    <div class="section">
        <h2>Full Description</h2>
        <p><?= nl2br(htmlspecialchars($test['description'])) ?></p>
    </div>
    
    <div class="section">
        <h2>Instructions</h2>
        <p><?= !empty($test['instructions']) ? nl2br(htmlspecialchars($test['instructions'])) : 'No special instructions.' ?></p>
    </div>
    
    <div class="section">
        <h2>Duration</h2>
        <p><?= !empty($test['duration']) ? htmlspecialchars($test['duration']) : 'N/A' ?></p>
    </div>
    
    <div class="price">
        Price: ₹<?= number_format($test['price'], 2) ?>
    </div>
    
    <a href="book-test.php?id=<?= $test['id'] ?>" class="btn-primary">Book Now</a>
</div>

</body>
</html>
