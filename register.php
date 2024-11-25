<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "your_username"; // Replace with your MySQL username
$password = "your_password"; // Replace with your MySQL password
$dbname = "orderingshit"; // Replace with your database name

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Hash the password
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    // Bind parameters
    $stmt->bind_param("sss", $user, $email, $hashedPassword);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <main>
        <form method="POST" action="register.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </main>
</body>
</html>