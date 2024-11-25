<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET status = 'Completed' WHERE id = :order_id");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->execute();
}

header("Location: dashboard.php");
exit;
?>
