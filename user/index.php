<?php
include('../includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab Homepage</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Welcome to HealthCheck Lab</h1>
    <p>Your trusted partner for diagnostics</p>
    <a href="tests.php"><button>Book a Test</button></a>

    <h2>Highlighted Tests</h2>
    <div class="test-list">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM tests LIMIT 3");
        while($row = mysqli_fetch_assoc($query)) {
            echo "<div class='test-card'>";
            echo "<h3>{$row['name']}</h3>";
            echo "<p>{$row['description']}</p>";
            echo "<p>₹{$row['price']}</p>";
            echo "<a href='test-details.php?id={$row['id']}'><button>View Details</button></a>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
