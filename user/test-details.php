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
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #1e90ff;
            margin-bottom: 15px;
        }
        .price {
            font-size: 24px;
            color: #28a745;
            margin: 20px 0;
        }
        .book-btn {
            background-color: #1e90ff;
            color: #fff;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .book-btn:hover {
            background-color: #0077cc;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }
        p {
            line-height: 1.5;
            color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><?= htmlspecialchars($test['name']) ?></h1>
    
    <div>
        <span class="section-title">Full Description:</span>
        <p><?= nl2br(htmlspecialchars($test['description'])) ?></p>
    </div>
    
    <div>
        <span class="section-title">Instructions:</span>
        <p><?= isset($test['instructions']) ? nl2br(htmlspecialchars($test['instructions'])) : 'No special instructions.' ?></p>
    </div>
    
    <div>
        <span class="section-title">Duration:</span>
        <p><?= isset($test['duration']) ? htmlspecialchars($test['duration']) : 'N/A' ?></p>
    </div>
    
    <div class="price">
        Price: ₹<?= number_format($test['price'], 2) ?>
    </div>
    
    <a href="book-test.php?id=<?= $test['id'] ?>" class="book-btn">Book Now</a>
</div>

</body>
</html>
