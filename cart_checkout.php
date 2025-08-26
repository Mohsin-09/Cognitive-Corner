<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cartData'])) {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $payment_method = "COD"; // Fixed Payment Method

    if (empty($name) || empty($address) || empty($phone)) {
        die("All fields are required.");
    }

    // Decode LocalStorage cart data
    $cart = json_decode($_POST['cartData'], true);
    if (!$cart || count($cart) === 0) {
        die("Cart is empty.");
    }

    $product_ids = [];
    $quantities = [];
    $prices = [];
    $total_price = 0;

    foreach ($cart as $item) {
        $product_id = intval($item['id']); // Ensure ID is valid
        $quantity = intval($item['quantity']);

        if ($product_id > 0 && $quantity > 0) {
            $product_ids[] = $product_id;
            $quantities[$product_id] = $quantity;
        }
    }

    if (empty($product_ids)) {
        die("Invalid cart data.");
    }

    // Fetch product details from the database
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    $sql = "SELECT id, price FROM products WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $prices[$row['id']] = $row['price'];
        $total_price += $row['price'] * $quantities[$row['id']];
    }
    $stmt->close();

    // Generate order number
    $order_number = rand(100000, 999999);

    // Insert order details into cognitive_corner_orders
    $stmt = $conn->prepare("INSERT INTO cognitive_corner_orders (order_number, user_id, name, address, phone, payment_method, total_price, order_status, order_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', NOW())");
    $stmt->bind_param("iissssd", $order_number, $user_id, $name, $address, $phone, $payment_method, $total_price);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert each product into cognitive_corner_order_items with price
    $stmt = $conn->prepare("INSERT INTO cognitive_corner_order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($quantities as $product_id => $quantity) {
        $price = $prices[$product_id]; // Get price of the product
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    // Clear cart after order is placed
    echo "<script>
            localStorage.removeItem('cart');
            window.location.href = 'order_statuss.php?order_id=$order_id';
          </script>";
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background:  #16697A;
            color: #EDE7E3;
            font-family: Arial, sans-serif;
        }

        .checkout-container {
            max-width: 500px;
            background-color: #489FB5;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #FFA62B;
            font-weight: bold;
        }

        .form-label {
            font-weight: bold;
            color: #EDE7E3;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            color: #FFF;
            border: none;
            border-radius: 10px;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            color: #FFF;
            outline: none;
            box-shadow: 0 0 10px #FFA62B;
        }

        .checkout-btn {
            background-color: #FFA62B;
            color: #16697A;
            font-size: 18px;
            font-weight: bold;
            border: none;
            padding: 10px;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .checkout-btn:hover {
            background-color: #EDE7E3;
            color: #16697A;
            box-shadow: 0 0 10px #FFA62B;
        }
    </style>
</head>
<body>
<div class="container checkout-container mt-5">
    <h2 class="text-center">Checkout</h2>
    <form id="checkoutForm" action="cart_checkout.php" method="POST">
        <input type="hidden" name="cartData" id="cartData">

        <div class="mb-3">
            <label for="name" class="form-label">Full Name:</label>
            <input type="text" name="name" id="name" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <textarea name="address" id="address" required class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number:</label>
            <input type="text" name="phone" id="phone" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method:</label>
            <select name="payment_method"  style="color:black;" class="form-control" disabled>
                <option value="COD" selected>Cash on Delivery</option>
            </select>
        </div>

        <button type="submit" class="btn checkout-btn w-100">Place Order</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        if (cart.length === 0) {
            alert("Your cart is empty!");
            window.location.href = "shop.php";
        } else {
            document.getElementById("cartData").value = JSON.stringify(cart);
        }
    });
</script>
</body>
</html>
