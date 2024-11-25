<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_details = $_POST['order_details'];
    $payment_method = $_POST['payment_method'];

    $stmt = $conn->prepare("INSERT INTO orders (user_id, order_details, payment_method) VALUES (:user_id, :order_details, :payment_method)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':order_details', $order_details);
    $stmt->bindParam(':payment_method', $payment_method);
    $stmt->execute();
}

$orders = $conn->query("SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>
    <header><h1>Orderingshit Dashboard</h1></header>
    <main class="container">
        <h2>Place an Order</h2>
        <form method="POST" action="">
            <label>Order Details:</label>
            <textarea name="order_details" required></textarea>
            <label>Payment Method:</label>
            <select name="payment_method" required>
                <option value="Card">Card</option>
                <option value="M-Pesa">M-Pesa</option>
            </select>
            <button class="button" type="submit">Place Order</button>
        </form>

        <h2>Your Orders</h2>
        <?php foreach ($orders as $order): ?>
            <div class="card">
                <p><strong>Order:</strong> <?= htmlspecialchars($order['order_details']); ?></p>
                <p><strong>Payment:</strong> <?= htmlspecialchars($order['payment_method']); ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($order['status']); ?></p>
                <?php if ($order['status'] === 'Pending'): ?>
                    <form method="POST" action="process_order.php">
                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                        <button class="button" type="submit">Mark as Complete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
