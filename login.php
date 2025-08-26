<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Get the redirect URL or go to the index by default
            $redirect_url = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';

            // Redirect user to the last visited page
            header("Location: " . $redirect_url);
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background-color: #16697A;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #489FB5;
            padding: 10px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .login-container {
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
            margin: 80px auto;
            background: rgba(72, 159, 181, 0.9); 
        }
        .login-container h1 {
            color: #FFA62B;
            
        }
        .login-container input {
            width: 90%;
            padding: 10px;
            margin: 5px 0;
            margin-bottom:10px;
            border: 1px solid #489FB5;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1); /* Transparent input */
            color: white;
        }
        .signup-container label {
            width: 100%;
            padding: 2px;
            margin: 2px 0;
        }
        .login-container button {
            background: #82C0CC;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            margin-top:20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-container button:hover {
            background: #489FB5;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
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

    <nav class="navbar navbar-expand-lg p-3">
        <div class="container">
            <a class="navbar-brand text-white" href="#">
                <img src="image/logo2.png" height="50px" width="50px" alt="LOGO"> Cognitive Corner
            </a>
            <div class="ms-auto">
                <a href="index.php" class="text-black mx-2"><i class="fa-solid fa-home"></i></a>
                <button type="button" class="text-black mx-2" style="all: unset; display: inline-block;  cursor: pointer; " data-bs-toggle="modal" data-bs-target="#contactModal"> <i class="fa-solid fa-phone"></i></button>
                <a href="login.php" class="text-black mx-2"><i class="fa-solid fa-user"></i></a>
                <a href="signup.php" class="text-black mx-2"><i class="fa-solid fa-user-plus"></i></a>
                <a href="shop.php" class="btn btn-light shop-btn-header">&nbsp SHOP NOW &nbsp</a>
            </div>
        </div>
    </nav>

<div class="login-container">
    <h1>Login</h1>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post"><br>
        <label for="email">Email</label>
        <input type="email" name="email"  required><br>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
