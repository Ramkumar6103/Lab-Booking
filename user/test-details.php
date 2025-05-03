<?php
include('../includes/db.php');
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tests WHERE id=$id");
$row = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head><title><?= $row['name'] ?> Details</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2><?= $row['name'] ?></h2>
    <p><?= $row['description'] ?></p>
    <p>Instructions: <?= $row['instructions'] ?></p>
    <p>Duration: <?= $row['duration'] ?></p>
    <p>Price: ₹<?= $row['price'] ?></p>
    <a href="book-test.php?test_id=<?= $row['id'] ?>"><button>Book Now</button></a>
</body>
</html>
