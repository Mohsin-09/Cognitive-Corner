<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['alert'] = "You must log in to access this page.";
        header("Location: index.php");
        exit();
    }
    
    require 'db.php'; // Database connection

    $user_id = $_SESSION['user_id'];

    // Fetch user details
    $query = "SELECT username, email, password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Fetch orders
    $orders_query = "SELECT id, order_date, order_status, order_number, total_price FROM cognitive_corner_orders WHERE user_id = ?";
    $stmt_orders = $conn->prepare($orders_query);
    $stmt_orders->bind_param("i", $user_id);
    $stmt_orders->execute();
    $orders_result = $stmt_orders->get_result();
    $orders = [];

    while ($order = $orders_result->fetch_assoc()) {
        $order_id = $order['id'];

        // Fetch product IDs for this order
        $products_query = "SELECT product_id FROM cognitive_corner_order_items WHERE order_id = ?";
        $stmt_products = $conn->prepare($products_query);
        $stmt_products->bind_param("i", $order_id);
        $stmt_products->execute();
        $products_result = $stmt_products->get_result();
        
        $products = [];
        while ($product = $products_result->fetch_assoc()) {
            // Get product name from products table
            $product_name_query = "SELECT name FROM products WHERE id = ?";
            $stmt_product_name = $conn->prepare($product_name_query);
            $stmt_product_name->bind_param("i", $product['product_id']);
            $stmt_product_name->execute();
            $product_name_result = $stmt_product_name->get_result();
            $product_name_row = $product_name_result->fetch_assoc();
            
            // Fix: Use correct key and handle empty result
            $products[] = $product_name_row['name'] ?? 'Unknown Product';
        }
        

        $order['products'] = $products;
        $orders[] = $order;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <!-- Bootstrap & Animate.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* General Styles */
        body {
            background: #16697A;
            color: #EDE7E3;
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }
        .card {
            background: #489FB5;
            color: #EDE7E3;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }

        /* Buttons */
        .btn-1 {
            background: #FFA62B;
            border: none;
            transition: all 0.3s ease-in-out;
        }
        .btn-1:hover {
            background: #EDE7E3;
            color: #16697A;
        }
        .btn-2 {
            background: #FFA62B;
            border: none;
            transition: all 0.3s ease-in-out;
        }
        .btn-2:hover {
            background: #EDE7E3;
            color: #16697A;
        }
        .btn-warning {
            background: #EDE7E3;
            color: #16697A;
            transition: all 0.3s ease-in-out;
        }
        .btn-warning:hover {
            background: #FFA62B;
            color: #EDE7E3;
        }

        /* Modal Styling */
        .modal-content {
            background: #489FB5;
            color: #EDE7E3;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Input Styling */
        .input-group .form-control {
            border-radius: 10px;
            border: none;
        }

        /* Animations */
        .animate-slide {
            animation: fadeInUp 0.8s;
        }
        .modal .modal-content {
            animation: zoomIn 0.4s;
        }
    </style>
</head>
<body>
    <!-- Profile Card -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card mx-auto p-4 animate-slide" style="max-width: 500px;">
            <div class="text-center">
                <h3 class="animate__animated animate__fadeInDown">User Profile</h3>
            </div>
            <div class="card-body">
            <p>
                <strong style="font-family: 'Poppins', sans-serif; font-size: 18px;">Name:</strong> 
                <span style="font-family: 'Roboto', sans-serif; font-size: 16px;">
                    <?php echo htmlspecialchars($user['username']); ?>
                </span>
            </p>
            <p>
                <strong style="font-family: 'Merriweather', serif; font-size: 18px;">Email:</strong> 
                <span style="font-family: 'Lato', sans-serif; font-size: 16px;">
                    <?php echo htmlspecialchars($user['email']); ?>
                </span>
            </p>
            <p>
                <strong style="font-family: 'Montserrat', sans-serif; font-size: 18px;">Password:</strong> 
                <span style="font-family: 'Courier New', monospace; font-size: 16px;">******</span>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    Change
                </button>
            </p>
                <hr>
                <button class="btn btn-1 w-100 mb-2" data-bs-toggle="modal" data-bs-target="#orderDetailsModal">
                    Orders History
                </button>
                <a href="logout.php" class="btn btn-2 w-100">
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title animate__animated animate__fadeInDown" id="orderDetailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (empty($orders)) : ?>
                        <p class="animate__animated animate__fadeIn">No orders found.</p>
                    <?php else : ?>
                        <?php foreach ($orders as $order) : ?>
                            <div class="border p-3 mb-3 animate__animated animate__zoomIn" style="background:#82C0CC; border-radius: 8px;">
                                <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
                                <p><strong>Status:</strong> <?php echo $order['order_status']; ?></p>
                                <p><strong>Order Number:</strong> <?php echo $order['order_number']; ?></p>
                                <p><strong>Total Price:</strong> $<?php echo $order['total_price']; ?></p>
                                <p><strong>Products:</strong> <?php echo !empty($order['products']) ? implode(", ", $order['products']) : "No products"; ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Change Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Irish Grover', cursive; font-size: 30px;" class="modal-title animate__animated animate__fadeInDown" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_password.php" method="POST">
                        <div class="mb-3 position-relative">
                            <label for="newPassword" style="font-family: 'Irish Grover', cursive; font-size: 21px;" class="form-label mb-lg-3">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye-slash" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div><br>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <button type="submit" class="btn btn-1 w-100">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Show/Hide Password -->
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            var passwordField = document.getElementById("newPassword");
            var eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.add("fa-eye");
                eyeIcon.classList.remove("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.add("fa-eye-slash");
                eyeIcon.classList.remove("fa-eye");
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
