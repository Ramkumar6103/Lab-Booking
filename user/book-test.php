<?php
include('../includes/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
    <title>Book Test: <?= htmlspecialchars($test['name']) ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #1e90ff;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
            box-sizing: border-box;
        }
        button {
            margin-top: 25px;
            background-color: #1e90ff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0077cc;
        }
        .price {
            font-size: 18px;
            margin-bottom: 25px;
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Book Test: <?= htmlspecialchars($test['name']) ?></h2>
    <div class="price">Price: ₹<?= number_format($test['price'], 2) ?></div>

    <form action="process-booking.php" method="POST">
        <input type="hidden" name="test_id" value="<?= $test['id'] ?>">

        <label for="name">Name*</label>
        <input type="text" name="name" id="name" required>

        <label for="phone">Phone Number*</label>
        <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" placeholder="10 digit phone number" required>

        <label for="alt_phone">Alternate Phone Number</label>
        <input type="tel" name="alt_phone" id="alt_phone" pattern="[0-9]{10}" placeholder="Optional">

        <label for="email">Email*</label>
        <input type="email" name="email" id="email" required>

        <label for="address">Address*</label>
        <textarea name="address" id="address" rows="3" required></textarea>

        <label for="preferred_datetime">Preferred Date and Time*</label>
        <input type="datetime-local" name="preferred_datetime" id="preferred_datetime" required>

        <button type="submit">Submit Booking</button>
    </form>
</div>

</body>
</html>
