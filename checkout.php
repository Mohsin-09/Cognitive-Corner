<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    $_SESSION['alert'] = "You must log in to access this page.";
    header("Location: shop.php");
    exit();
}

// Validate product ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid product.");
}

$product_id = intval($_GET['id']);
$query = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($query);

if ($result->num_rows != 1) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

// Function to generate unique order number
function generateOrderNumber($conn) {
    do {
        $order_number = mt_rand(100000, 999999); // Generate 6-digit order number
        $check_query = "SELECT id FROM cognitive_corner_orders WHERE order_number = '$order_number'";
        $check_result = $conn->query($check_query);
    } while ($check_result->num_rows > 0); // Ensure uniqueness
    return $order_number;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $total_price = $product['price'];
    $payment_method = 'COD'; // Only COD allowed

    // Generate a unique order number
    $order_number = generateOrderNumber($conn);

    // Insert order into cognitive_corner_orders
    $order_query = "INSERT INTO cognitive_corner_orders (order_number, user_id, name, address, phone, payment_method, total_price) 
                    VALUES ('$order_number', '$user_id', '$name', '$address', '$phone', '$payment_method', '$total_price')";

    if ($conn->query($order_query) === TRUE) {
        $order_id = $conn->insert_id; // Retrieve the auto-incremented ID

        // Insert into cognitive_corner_order_items using order_number
        $order_item_query = "INSERT INTO cognitive_corner_order_items (order_id, product_id, price) 
                             VALUES ('$order_number', '$product_id', '$total_price')";

        if ($conn->query($order_item_query) === TRUE) {
            header("Location: order_status.php?order_id=$order_number");
            exit();
        } else {
            die("Failed to insert order item: " . $conn->error);
        }
    } else {
        die("Order failed: " . $conn->error);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Inter:opsz,wght@14..32,300&family=Irish+Grover&family=Jura:wght@300&family=Kablammo&family=Micro+5&family=Nerko+One&family=Neucha&family=New+Rocker&family=News+Cycle:wght@400;700&family=Ranchers&family=Staatliches&family=Syne&family=Ysabeau+Infant:wght@1..1000&display=swap" rel="stylesheet"><link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>        
            body {
            background-color: #16697A; /* Updated theme background */
            color:   #EDE7E3 ;
            font-family: Arial, sans-serif;
        }
        .checkout-container {
            background-color: #489FB5; /* Updated container background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 50px auto;
        }
        .checkout-title {
            font-family: "kablammo";
            text-align: center;
            color: #EDE7E3; /* Updated text color */
            font-size: 24px;
            margin-bottom: 20px;

        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #489FB5;
        }
        .btn-primary {
            background-color: #FFA62B;
            border: none;
            width: 100%;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
            color: #EDE7E3; /* Updated button text color */
        }
        .btn-primary:hover {
            background-color: #EDE7E3;
            color: #16697A;
            border: 1px solid #FFA62B;
        }

    </style>
</head>
<body>

<div class="checkout-container">
    <h2 class="checkout-title">Checkout</h2>
    
    <form action="" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="hidden" name="price" value="<?= $product['price'] ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Shipping Address</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <input type="text" class="form-control" id="payment_method" value="Cash on Delivery (COD)" disabled>
        </div>

        <div class="mb-3 text-center">
            <strong>Total Price: $<?= number_format($product['price'], 2) ?></strong>
        </div>

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>

</body>
</html>
