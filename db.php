<?php
session_start(); // Start the session

$servername = "localhost"; // Your database server
$username = "denleywasbanned"; // Your database username
$password = "Kijolp05!"; // Your database password
$dbname = "Mongo"; // Your database name

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>