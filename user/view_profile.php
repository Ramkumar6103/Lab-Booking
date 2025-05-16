<?php
session_start();
include('../includes/db.php');

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user details from DB
$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Profile - HealthCheck Lab</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .profile-box {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
        }
        .profile-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1e90ff;
        }
        .profile-info {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .profile-info strong {
            width: 120px;
            display: inline-block;
            color: #333;
        }
    </style>
</head>
<body>

<div class="profile-box">
    <h2>My Profile</h2>
    <div class="profile-info"><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></div>
    <div class="profile-info"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></div>
    <div class="profile-info"><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></div>
    <div class="profile-info"><strong>Status:</strong> <?= htmlspecialchars($user['status']) ?></div>
</div>

</body>
</html>
