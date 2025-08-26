<?php
include "db.php";

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);

    $stmt = $conn->prepare("SELECT id, name, price FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        echo "<script>
            let product = " . json_encode($product) . ";
            let cart = JSON.parse(localStorage.getItem('cart')) || {};

            if (cart[product.id]) {
                cart[product.id].quantity += 1;
            } else {
                cart[product.id] = {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: 1
                };
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            console.log('Cart updated:', cart);
        </script>";
    } else {
        echo "<script>alert('Product not found');</script>";
    }

    $stmt->close();
    $conn->close();

    // Redirect to shop.php to avoid form resubmission error
    echo "<script>window.location.href = 'shop.php';</script>";
    exit;
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'shop.php';</script>";
    exit;
}
