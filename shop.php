<?php
session_start();

$is_logged_in = isset($_SESSION['user_id']); // Check if user is logged in

// Check for flash message
$alert_message = "";
if (isset($_SESSION['alert'])) {
    $alert_message = $_SESSION['alert'];
    unset($_SESSION['alert']); // Remove after displaying
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cognitive_corner_products";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from database
$sql = "SELECT * FROM products ORDER BY category";
$result = $conn->query($sql);

$products_by_category = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products_by_category[$row['category']][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cognitive Corner || Shop</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Inter:opsz,wght@14..32,300&family=Irish+Grover&family=Jura:wght@300&family=Kablammo&family=Micro+5&family=Nerko+One&family=Neucha&family=New+Rocker&family=News+Cycle:wght@400;700&family=Ranchers&family=Staatliches&family=Syne&family=Ysabeau+Infant:wght@1..1000&display=swap" rel="stylesheet"><link rel="stylesheet" href="css/styles.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

   
</head>
<body>

<!-- Contact Us Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #489FB5; border-radius: 10px; padding: 20px;">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel" style="color: #EDE7E3;">We’re Here to Help!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p style="color: #EDE7E3;">Feel free to reach out via email, phone, or social media. We’d love to hear from you!</p>

                <div style="display: flex; flex-direction: column; gap: 15px; align-items: center; font-size: 18px;">
                    <div>
                        <i class="fas fa-envelope" style="color: #FFA62B; margin-right: 10px;"></i> 
                        <a href="mailto:info@example.com" style="color: #EDE7E3; text-decoration: none;">cognitivecornerI9@gmail.com</a>
                    </div>

                    <div>
                        <i class="fas fa-phone-alt" style="color: #FFA62B; margin-right: 10px;"></i> 
                        <a href="tel:+1234567890" style="color: #EDE7E3; text-decoration: none;">+92 3152801587</a>
                    </div>

                </div>

                <div class="contact-socials" style="display: flex; gap: 15px; margin-top: 20px; justify-content:center;">
                    <a href="#" style="color: #FFA62B; font-size: 24px;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #FFA62B; font-size: 24px;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #FFA62B; font-size: 24px;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: #FFA62B; font-size: 24px;"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Off-Canvas Cart -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" 
    style="background-color: #16697A; color: #EDE7E3;">
    
    <div class="offcanvas-header" 
        style="background-color: #489FB5; color: #FFA62B;">
        <h5 class="offcanvas-title" style="font-weight: bold; color: #FFA62B;">
            Shopping Cart
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" 
            style="filter: invert(1);">
        </button>
    </div>

    <div class="offcanvas-body" style="padding: 20px; background-color: #82C0CC;">
        <div id="cartItems">
            <p style="text-align: center; color: #FFA62B; font-weight: bold;">
                Your cart is empty
            </p>
        </div>
        <a href="cart_checkout.php" class="btn w-100 mt-3" 
            style="background-color: #FFA62B; color: #16697A; font-weight: bold;"
            onmouseover="this.style.backgroundColor='#EDE7E3'; this.style.color='#16697A';" 
            onmouseout="this.style.backgroundColor='#FFA62B'; this.style.color='#16697A';">
            Checkout
        </a>
        <button id="clearCart" class="btn w-100 mt-3" 
            style="background-color: #FFA62B; color: #16697A; font-weight: bold;"
            onmouseover="this.style.backgroundColor='#EDE7E3'; this.style.color='#16697A';" 
            onmouseout="this.style.backgroundColor='#FFA62B'; this.style.color='#16697A';">
            Clear Cart
        </button>
    </div>
</div>


    <!-- Bootstrap & Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", loadCart);

        function loadCart() {
            let cart = JSON.parse(localStorage.getItem("cart")) || {};
            let cartItemsContainer = document.getElementById("cartItems");
            cartItemsContainer.innerHTML = ""; // Clear previous items

            if (Object.keys(cart).length === 0) {
                cartItemsContainer.innerHTML = "<p>Your cart is empty</p>";
                return;
            }

            for (let id in cart) {
                let item = cart[id];
                let cartItem = document.createElement("div");
                cartItem.classList.add("border", "p-2", "mb-2", "rounded");
                cartItem.innerHTML = `
                    <p><strong>${item.name}</strong></p>
                    <p>Price: $${item.price}</p>
                    <p>Quantity: ${item.quantity}</p>
                `;
                cartItemsContainer.appendChild(cartItem);
            }
        }

        document.getElementById("clearCart").addEventListener("click", function () {
            localStorage.removeItem("cart");
            loadCart();
        });
    </script>

    <nav class="navbar navbar-expand-lg p-3">
        <div class="container">
            <a class="navbar-brand text-white" href="#">
                <img src="image/logo2.png" height="50px" width="50px" alt="LOGO"> Cognitive Corner
            </a>
            <div class="ms-auto">
                <a href="index.php" class="text-black mx-2"><i class="fa-solid fa-home"></i></a>
                <button href="#" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" class="text-black mx-2" style="all: unset; display: inline-block;  cursor: pointer; " type="button" ><i class="fa-solid fa-shopping-cart"></i></button>
                <button type="button" class="text-black mx-2" style="all: unset; display: inline-block;  cursor: pointer; " data-bs-toggle="modal" data-bs-target="#contactModal"> <i class="fa-solid fa-phone"></i></button>
                <a href="login.php" class="text-black mx-2"><i class="fa-solid fa-user"></i></a>
                <a href="signup.php" class="text-black mx-2"><i class="fa-solid fa-user-plus"></i></a>
                <a href="shop.php" class="btn btn-light shop-btn-header">&nbsp SHOP NOW &nbsp</a>
            </div>
        </div>
    </nav>

<div class="section-title" style=" margin-left:360px; margin-right:340px; margin-bottom:10px;">Check Our <span>SHop</span></div>
    

<?php
    // Define the preferred order for categories
    $category_order = ["Cards", "Board Games", "Puzzles"];

    // Sort the array based on the defined order
    uksort($products_by_category, function ($a, $b) use ($category_order) {
        $indexA = array_search($a, $category_order);
        $indexB = array_search($b, $category_order);

        return $indexA - $indexB;
    });
    ?>

    <?php if (!empty($products_by_category)): ?>
        <?php foreach ($products_by_category as $category => $products): ?>
            
                <?php if ($category == "Cards"): ?>
                    <div class="section-title cards" style="margin-left: 420px; margin-right: 320px; margin-bottom: 10px;">Cards</div>
                <?php elseif ($category == "Board Games"): ?>
                    <div class="section-title boardGames" style="margin-left: 380px; margin-right: 340px; margin-bottom: 10px;">Board Games</div>
                <?php elseif ($category == "Puzzles"): ?>
                    <div class="section-title puzzles" style="margin-left: 410px; margin-right: 340px; margin-bottom: 10px;">Puzzles</div>
                <?php endif; ?>

            <div class="shop-cards">
                <?php foreach ($products as $product): ?>
                    <div class="product-card" id="product-<?= htmlspecialchars($product["id"]) ?>">
                        <img class="product-image" src="<?= htmlspecialchars($product["image"]) ?>" alt="<?= htmlspecialchars($product["name"]) ?>">
                        <h3 class="product-name"><?= htmlspecialchars($product["name"]) ?></h3>
                        <p class="product-description"><?= htmlspecialchars($product["description"]) ?></p>
                        <!-- If user is logged in, go to checkout. Otherwise, show alert -->
                        <a href="<?= $is_logged_in ? "checkout.php?id={$product["id"]}" : "#" ?>" 
                            class="buy-now" 
                            <?= !$is_logged_in ? 'data-bs-toggle="modal" data-bs-target="#loginAlertModal"' : '' ?>
                            style="text-decoration: none;">
                            Buy Now
                            </a>&nbsp;&nbsp;


                                                
                            <a 
                                href="addtocart.php?product_id=<?= urlencode($product['id']) ?>"
                                class="btn add-cart"
                                <?php if (!$is_logged_in): ?> 
                                    data-bs-toggle="modal" data-bs-target="#loginAlertModal"
                                <?php endif; ?>
                                style="text-decoration: none;">
                                Add to Cart
                            </a>



                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-products-message">No products found.</p>
    <?php endif; ?>

    <?php $conn->close(); 
?>


<div class="container">
        
        <div class="messages" style="width: 93%; margin-left: 35px; margin-right: auto; margin-top:50px; margin-bottom:10px;">Stay Tuned For <span>New REleases</span></div>
       
        </div>
    
        <footer class="footer">
            <div class="footer-container">
            <div class="footer-logo">
                <img src="image/logo2.png" alt="Cognitive Corner">
                <p class="logo-text">Cognitive Corner</p>
            </div>
            <div class="footer-links">
                <div class="footer-section">
                    <h3>Categories</h3>
                    <ul>
                        <li>Cards</li>
                        <li>Board</li>
                        <li>Puzzles</li>
                        <li>And Much More</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>About Us</h3>
                    <ul>
                        <li>Help Center</li>
                        <li>Store Locations</li>
                        <li>Privacy Policy</li>
                        <li>Terms of Service</li>
                    </ul>
                </div>
                <div class="footer-section contact">
                    <h3>Contact Us</h3>
                    <p><i class="fa fa-envelope"></i> cognitivecornerI9@gmail.com</p>
                    <div class="social-icons" >
                        <a href="https://www.twitter.com/cognitivecornerI9"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://www.facebook.com/cognitivecornerI9"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://www.instagram.com/cognitivecornerI9"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                    <a href="review.php">
                        <button class="btn review-button" style="color: #EDE7E3; background-color: #489FB5; border:solid rgb(214, 214, 214) 3px; font-size: 13px; padding:6px;  font-weight: bold; border-radius: 5px;  margin-top:10px; transition: 0.3s; ">Leave a Review

                        </button>            
                    </a></div></div></div>
        </footer>
    
<!-- model for good looking alert -->
<div class="modal fade" id="loginAlertModal" tabindex="-1" aria-labelledby="loginAlertLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #82C0CC; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background-color: #16697A; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h3 class="modal-title" id="loginAlertLabel" style="margin: 0; font-weight: bold;">Login Required</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body" style="color: #EDE7E3; text-align: center; padding: 20px;">
                <h6 style="margin-bottom: 20px;">You must log in to add items to your cart.</h6>
                <a href="login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="btn" style="background-color: #FFA62B; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Login</a>
                <button type="button" class="btn" data-bs-dismiss="modal" 
                        style="background-color: #489FB5; color: white; padding: 10px 20px; border-radius: 5px;">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>
