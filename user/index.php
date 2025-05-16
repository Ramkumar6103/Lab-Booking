<?php
include('../includes/db.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab Homepage</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
        }

        .logo h1 {
            margin: 0;
            color: #1e90ff;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .nav-buttons a button {
            padding: 8px 15px;
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .nav-buttons a button:hover {
            background-color: #0077cc;
        }

        .hero {
            text-align: center;
            padding: 60px 20px 30px;
            background-color: #eef7ff;
        }

        .hero h1 {
            margin-bottom: 10px;
        }

        .test-list {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 30px;
            flex-wrap: wrap;
        }

        .test-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            text-align: center;
        }

        .test-card h3 {
            margin-top: 0;
            color: #333;
        }

        .test-card p {
            margin: 10px 0;
            color: #666;
        }

        .test-card a button {
            background-color: #28a745;
            border: none;
            padding: 8px 15px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .test-card a button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <h1>HealthCheck Lab</h1>
        </div>
        <div class="nav-buttons">
            <a href="tests.php"><button>Book a Test</button></a>
            <?php if (isset($_SESSION['user_id'])): ?>
    <a href="my-bookings.php"><button>My Booking</button></a>
    <a href="view_profile.php"><button>View Profile</button></a>
    <a href="logout.php"><button style="background-color: #dc3545;">Logout</button></a>
<?php else: ?>
    <a href="login.php"><button>Login</button></a>
<?php endif; ?>
        </div>
    </header>

    <div class="hero">
        <h1>Welcome to HealthCheck Lab</h1>
        <p>Your trusted partner for diagnostics</p>
    </div>

    <h2 style="text-align: center;">Highlighted Tests</h2>

</body>
</html>
