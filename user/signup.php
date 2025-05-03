<?php
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];

    // Check for existing user
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already exists!";
    } else {
        mysqli_query($conn, "INSERT INTO users (name, email, password, phone) 
            VALUES ('$name', '$email', '$pass', '$phone')");
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Sign Up</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Create Account</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input name="name" required placeholder="Full Name"><br>
        <input name="email" type="email" required placeholder="Email"><br>
        <input name="phone" required placeholder="Phone Number"><br>
        <input name="password" type="password" required placeholder="Password"><br>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
