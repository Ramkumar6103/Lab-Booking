<?php
session_start();

if (!isset($_SESSION['booking_id'])) {
    // Redirect if no booking info
    header("Location: tests.php");
    exit();
}

$booking_id = $_SESSION['booking_id'];
$booking_summary = $_SESSION['booking_summary'] ?? null;

// Clear session data to avoid resubmission on refresh
unset($_SESSION['booking_id']);
unset($_SESSION['booking_summary']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .confirmation-container {
            max-width: 600px;
            margin: 50px auto;
            background: #e9f7ef;
            border: 1px solid #28a745;
            padding: 30px;
            border-radius: 10px;
            font-family: Arial, sans-serif;
            color: #155724;
            box-shadow: 0 0 10px rgba(40,167,69,0.4);
            text-align: center;
        }
        .confirmation-container h2 {
            margin-bottom: 20px;
        }
        .booking-details {
            text-align: left;
            margin-top: 20px;
            padding: 15px;
            background: #d4edda;
            border-radius: 6px;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        a.button {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a.button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="confirmation-container">
    <h2>Booking Submitted Successfully!</h2>
    <p>Your booking ID is: <strong>#<?= htmlspecialchars($booking_id) ?></strong></p>

    <?php if ($booking_summary): ?>
    <div class="booking-details">
        <h3>Booking Summary:</h3>
        <p><strong>Test:</strong> <?= htmlspecialchars($booking_summary['test_name']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($booking_summary['name']) ?></p>
        <p><strong>Preferred Date/Time:</strong> <?= htmlspecialchars($booking_summary['preferred_datetime']) ?></p>
        <p><strong>Contact:</strong> <?= htmlspecialchars($booking_summary['phone']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($booking_summary['email']) ?></p>
    </div>
    <?php endif; ?>

    <a href="tests.php" class="button">Book Another Test</a>
</div>

</body>
</html>
