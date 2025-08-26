<?php
    $success = $error = "";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cognitive_reviews";

        $conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $name = trim($_POST["name"]);
        $phone = trim($_POST["phone"]);
        $email = trim($_POST["email"]);
        $rating = (int)$_POST["rating"];
        $comments = trim($_POST["comments"]);

        if (empty($name) || empty($phone) || empty($email) || empty($rating) || empty($comments)) {
            $error = "All fields are required!";
        } else {
            $stmt = $conn->prepare("INSERT INTO reviews (name, phone, email, rating, comments) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $name, $phone, $email, $rating, $comments);
            if ($stmt->execute()) {
                $success = "Thank you! Your review has been submitted.";
            } else {
                $error = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Inter:opsz,wght@14..32,300&family=Irish+Grover&family=Jura:wght@300&family=Kablammo&family=Micro+5&family=Nerko+One&family=Neucha&family=New+Rocker&family=News+Cycle:wght@400;700&family=Ranchers&family=Staatliches&family=Syne&family=Ysabeau+Infant:wght@1..1000&display=swap" rel="stylesheet"><link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Braah+One&family=Inter:opsz,wght@14..32,300&family=Irish+Grover&family=Jura:wght@300&family=Kablammo&family=Micro+5&family=Nerko+One&family=Neucha&family=New+Rocker&family=News+Cycle:wght@400;700&family=Ranchers&family=Staatliches&family=Syne&family=Ysabeau+Infant:wght@1..1000&display=swap');
        .toast {
            background-color: #FFA62B;
            color: #16697A;
            font-weight: bold;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .toast-body {
            font-size: 16px;
        }

        .toast .btn-close {
            color: #16697A;
        }

        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 150px;
            width: 50px;
            height: 50px;
            background-color: #82C0CC;
            color: black;
            border-radius: 50%;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s, transform 0.2s;
            }
            .chat-button:hover {
            transform: scale(1.1);
            }
        /* Contact Section */
        .contact p {
        font-size: 16px;
        display: flex;
        align-items: center;
        }

        .contact i {
        margin-right: 8px;
        }

        /* Social Icons */
        .social-icons {
        margin-top: 10px;
        color: #EDE7E3;
        }

        .social-icons i {
        font-size: 22px;
        margin: 0 8px;
        cursor: pointer;
        transition: 0.3s;
        color: #dbe9ea;
        }

        .social-icons i:hover {
        color: #FFA62B;
        }
        .section-title span{
        color: #FFA62B;
        }

        .messages span{
        color: #FFA62B;
        }


        /* Footer Styling */
        .footer {
        background-color: #489FB5;
        padding: 40px 0;
        text-align: center;
        border-radius: 15px;
        max-width: 90%;
        width: 100%;
        margin: 50px auto;
        }

        /* Footer Layout */
        .footer-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        }

        /* Logo Section */
        .footer-logo {
        text-align: center;
        flex: 1;
        }

        .footer-logo img {
        width: 150px;
        height: 150px;
        }

        .logo-text {
        font-family: 'Ranchers', cursive;
        font-size: 22px;
        color: white;
        margin-top: 10px;
        }

        /* Footer Links */
        .footer-links {
        display: flex;
        justify-content: space-around;
        flex: 2;
        width: 70%;
        }

        .footer-section {
        font-family: 'Ranchers', cursive;
        color: white;
        text-align: left;
        }

        .footer-section h3 {
        font-size: 20px;
        margin-bottom: 20px;
        }

        .footer-section ul {
        list-style: none;
        padding: 0;
        }

        .footer-section ul li {
        font-size: 16px;
        margin-bottom: 10px;
        margin-top: 10px;
        font-family: 'Ranchers', sans-serif;
        }

        /* General Styling */
        body {
            background: #16697A;
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        /* Navigation Bar */
        .navbar {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 15px;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        .navbar-nav .nav-item .nav-link {
            color: #fff;
            transition: 0.3s;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #489FB5;
        }

        /* Review Container */
        .review-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
        }

        /* Outer Form Container */
        .form-container {
            background: #82C0CC;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            justify-content: center;

        }

        /* Inner Form Box */
        .form-box {
            background: #489FB5;
            padding: 25px;
            border-radius: 10px;
        }

        /* Section Title */
        .section-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 5px;
            margin-left: 380px;
            margin-right: 380px;
            margin-bottom: 10px;
        }

       /* Updated Rating Styling */
        .rating {
            display: flex;
            justify-content: space-between;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            width: 100%;
            text-align: center;
        }
        .form-label {
            justify-content: center !important;
            display: flex;
            margin-bottom: .5rem;
            font-family:Staatliches;
            font-size:30px;
        }
        .rating span {
            flex: 1;
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            background: #82C0CC;
            color: white;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            margin: 5px;
        }

        .rating span:hover, 
        .rating span.selected {
            background: #EDE7E3;
            transform: scale(1.1);
        }

                .btn-submit {
                    background: #FFA62B;
                    color:#EDE7E3;
                    border: none;
                    padding: 12px;
                    font-size: 18px;
                    font-weight: bold;
                    transition: 0.3s;
                }

                .btn-submit:hover {
                    background:#EDE7E3;
                    color:Black;
                }
                body {
        background-color:#16697A;
        padding-left: 150px;
        padding-right:150px;
        padding-top: 50px;
        color:white;
        }
        .navbar {
        background-color: #489FB5;
        font-family: 'Inter', sans-serif;
        border-radius: 15px;
        }
        .section-title {
        font-family: 'Kablammo', cursive;
        font-size: 24px;
        background: #489FB5;
        display: inline-block;
        padding: 10px 20px;
        border-radius: 10px;
        margin-top: 20px ;
        margin-bottom:20px;
        margin-left:410px;
        margin-right:410px;
        }
    </style>

    <script>
        function selectRating(rating) {
            document.getElementById('rating').value = rating;
            let spans = document.querySelectorAll('.rating span');
            spans.forEach(span => span.classList.remove('selected'));
            spans[rating - 1].classList.add('selected');
        }
    </script>
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
    <!-- Section Title -->
    <div class="section-title" style=" margin-left:330px; margin-right:320px; margin-bottom:30px;">Customer Review Form</div>

    <!-- Review Form -->
    <div class="container review-container">
        <div class="form-container">
            <div class="form-box">

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone No *</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rate Us *</label>
                        <div class="rating">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <span onclick="selectRating(<?php echo $i; ?>)"><?php echo $i; ?></span>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" id="rating" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Comments</label>
                        <textarea class="form-control" name="comments" placeholder="Comments" rows="6" ></textarea>
                    </div>

                    <div class="mb-lg-5">
                        <label class="form-label">Suggestions</label>
                        <textarea class="form-control" name="suggestions" placeholder="Suggestions" rows="5.5" ></textarea>
                    </div>

                    <button type="submit" class="btn btn-submit w-100">Submit</button><br><br>
                    <p class="text-center mt-3 text-muted ">"Every Word Counts, Every Voice Matters"</p>
                </form>
            </div>
        </div>
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
                </div>
            </div>
        </div>
    </footer>

    <div class="position-fixed  bottom-0 end-0 p-3" style="z-index: 1050">
        <?php if ($success): ?>
            <div class="toast show " role="alert">
                <div class="toast-header">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body"><?php echo $success; ?></div>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="toast show" role="alert">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body"><?php echo $error; ?></div>
            </div>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
