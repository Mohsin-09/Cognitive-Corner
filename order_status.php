<?php
session_start();
require 'db.php';

if (!isset($_GET['order_id'])) {
    die("No order ID provided.");
}

$order_id = intval($_GET['order_id']);

// Fetch order details
$stmt = $conn->prepare("SELECT * FROM cognitive_corner_orders WHERE order_number = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$order) {
    die("Order not found.");
}

// Fetch order items
$stmt = $conn->prepare("SELECT p.name, oi.quantity, oi.price 
                        FROM cognitive_corner_order_items oi 
                        JOIN products p ON oi.product_id = p.id 
                        WHERE oi.order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #16697A;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.2); /* Slight Transparency */
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        h2, h3, p, th, td {
            color: #EDE7E3; /* White Text */
        }
        .order-info {
            background: #489FB5;
            padding: 15px;
            border-radius: 8px;
            color: white;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid #82C0CC;
        }
        th {
            background: #82C0CC;
            color: white;
        }
        .back-btn {
            background: #FFA62B;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: block;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
        .back-btn:hover {
            background: #EDE7E3;
            color: #16697A;
            border: 2px solid #FFA62B;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Order Status</h2>
    <div class="order-info">
        <p><strong>Order ID:</strong> <?= $order['order_number'] ?></p>
        <p><strong>Status:</strong> <?= ucfirst($order['order_status']) ?></p>
        <p><strong>Total Price:</strong> $<?= number_format($order['total_price'], 2) ?></p>
    </div>

    <h3>Products</h3>
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php while ($item = $items->fetch_assoc()) : ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>$<?= number_format($item['price'], 2) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="shop.php" class="back-btn">Back to Shop</a>
</div>

</body>
</html>
