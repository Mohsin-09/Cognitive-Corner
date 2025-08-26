<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cognitive Corner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Inter:opsz,wght@14..32,300&family=Irish+Grover&family=Jura:wght@300&family=Kablammo&family=Micro+5&family=Nerko+One&family=Neucha&family=New+Rocker&family=News+Cycle:wght@400;700&family=Ranchers&family=Staatliches&family=Syne&family=Ysabeau+Infant:wght@1..1000&display=swap" rel="stylesheet"><link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="fonts/fonts.css">
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
                <a href="profile.php" class="text-black mx-2" style="all: unset; display: inline-block;  cursor: pointer;"><i class="fa-solid fa-id-card"></i></a>
                <button type="button" class="text-black mx-2" style="all: unset; display: inline-block;  cursor: pointer; " data-bs-toggle="modal" data-bs-target="#contactModal"> <i class="fa-solid fa-phone"></i></button>
                <a href="login.php" class="text-black mx-2"><i class="fa-solid fa-user"></i></a>
                <a href="signup.php" class="text-black mx-2"><i class="fa-solid fa-user-plus"></i></a>
                <a href="shop.php" class="btn btn-light shop-btn-header">&nbsp SHOP NOW &nbsp</a>
            </div>
        </div>
</nav>
    
    <div class="container">
        <div class="announcement-bar" style="font-family: 'Irish Grover';">
            All Types of Unique Mind Games Are Available Here!
        </div>
    </div>
    
    <div class="hero-container container mt-4">
        <div class="hero-section">
            
            <div class="hero-image"></div>
            <div class="hero-content">
                <h2 class="headline">Fun Toys For Your Kids</h2>
                <p class="hero-text">
                    Browse through our huge collection of fun mind games, puzzle games and more for your kids.
                    Shop, play and create fond memories with your little ones!
                </p>
                <button class="btn hero-btn">Shop Now</button>
            </div>
        </div>
    </div>
    
    <div class="section-title" style="margin-left:350px; margin-right:350px; margin-bottom:10px;">SHOP BY CATEGORIES</div>

    <div class="categories">
        <div class="category">
            <a href="shop.php"><img src="image/cards.jpeg" alt="Cards"></a>         
            <span>Cards</span>
        </div>
        <div class="category">
            <a href="shop.php"><img src="image/boards.jpeg" alt="Board"></a>          
            <span>Board</span>
        </div>
        <div class="category">
            <a href="shop.php"><img src="image/puzzles.jpeg" alt="Puzzles"></a>
            <span>Puzzles</span>
        </div>
        <div class="category">
            <a href="suggestions.php"><img src="image/custom.jpeg" alt="More"></a>         
            <span>More.</span>
        </div>
    </div>

    <div class="section-title" style=" margin-left:380px; margin-right:380px; margin-bottom:10px;">NEW ARRIVALS</div>

    <div class="new-arrivals">
        <div class="product-card">
            <img src="image/game1.jpg" alt="Emojify IT!">
            <h3>Emojify IT!</h3>
            <p>Cards with emojis that represent phrases, movies, or words. Players guess the meaning.</p>
            <div class="buttons">
                <button class="buy-now">Buy Now</button>
                <button class="add-cart">Add To Cart</button>
            </div>
        </div>

        <div class="product-card">
            <img src="image/game2.jpg" alt="Equation Blitz">
            <h3>Equation Blitz</h3>
            <p>Cards with random numbers and operations. Players solve equations the fastest.</p>
            <div class="buttons">
                <button class="buy-now">Buy Now</button>
                <button class="add-cart">Add To Cart</button>
            </div>
        </div>

        <div class="product-card">
            <img src="image/game4.jpg" alt="Maze Mastery">
            <h3>Maze Mastery</h3>
            <p>Grid with paths and obstacles. Players navigate using logical moves.</p>
            <div class="buttons">
                <button class="buy-now">Buy Now</button>
                <button class="add-cart">Add To Cart</button>
            </div>
        </div>
    </div>

    <div class="section-title" style=" margin-left:380px; margin-right:380px; margin-bottom:10px;">BEST SELLINGS</div>

    <div class="best-sellings">
        <!-- Card 1 -->
        <div class="product-card">
            <img src="image/game2.jpg" alt="Equation Blitz">
            <h3>Equation Blitz</h3>
            <p>Use numbers and operators to solve math equations in record time!</p>
            <div class="buttons">
                <button class="buy-now">Buy Now</button>
                <button class="add-cart">Add To Cart</button>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="product-card">
            <img src="image/game9.jpg" alt="Galactic Jigsaw">
            <h3>Galactic Jigsaw</h3>
            <p>A 140+ piece puzzle featuring planets, stars, and galaxies!</p>
            <div class="buttons">
                <button class="buy-now">Buy Now</button>
                <button class="add-cart">Add To Cart</button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="product-card">
            <img src="image/game6.jpg" alt="Pathogen Panic">
            <h3>Pathogen Panic</h3>
            <p>Spread or stop a virus in this fast-paced strategy board game.</p>
            <div class="buttons">
                <button class="buy-now">Buy Now</button>
                <button class="add-cart">Add To Cart</button>
            </div>
        </div>
    </div>

    <div class="section-title" style=" margin-left:380px; margin-right:380px; margin-bottom:10px;">Testimonials</div>

    <div class="testimonials">
        <div class="testimonial-card">
            <img src="image/p1.png" alt="User">
            <span class="quote-mark quote-start">“</span>
            <p>These games are fun and educational! My kids love them. Delivery was on time too.</p>
            <span class="quote-mark quote-end">”</span>
        </div>

        <div class="testimonial-card">
            <img src="image/p2.png" alt="User">
            <span class="quote-mark quote-start">“</span>
            <p>The quality is great! The games are engaging and my kids are learning a lot. Delivery was prompt.</p>
            <span class="quote-mark quote-end">”</span>
        </div>

        <div class="testimonial-card">
            <img src="image/p3.png" alt="User">
            <span class="quote-mark quote-start">“</span>
            <p>I'm very impressed with these educational games. They are fun and high quality. The delivery is timely and hassle-free.</p>
            <span class="quote-mark quote-end">”</span>
        </div>

        <div class="testimonial-card">
            <img src="image/p4.png" alt="User">
            <span class="quote-mark quote-start">“</span>
            <p>These games make learning fun! My kids are improving their skills. Delivery was always on time.</p>
            <span class="quote-mark quote-end">”</span>
        </div>

        <div class="testimonial-card">
            <img src="image/p5.png" alt="User">
            <span class="quote-mark quote-start">“</span>
            <p>My kids love playing these games! They're so much fun. Delivery was always on time. Wow!</p>
            <span class="quote-mark quote-end">”</span>
        </div>

        <div class="testimonial-card">
            <img src="image/p6.png" alt="User">
            <span class="quote-mark quote-start">“</span>
            <p>My kids are obsessed with these games! They learn while they play, and the quality is amazing.</p>
            <span class="quote-mark quote-end">”</span>
        </div>
    </div>

    <div class="section-title">About Us</div>

<div class="about-us-container">
    
  <img src="image/logo2.png" alt="Brain Icon" class="brain-image">
    <div class="about-text">
        <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome to Cognitive Corner!</h2>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Our mission is to make learning fun and engaging for students. We started with the vision of 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;creating innovative educational games that educate and develop young minds. Today, we proudly 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;serve parents and educators who want to give their children products that not only engage them 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;but also help them learn and grow at the same time.
        </p>
        <p>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;At Cognitive Corner, we believe in nurturing a love of learning, developing essential skills, 
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; fostering creativity and inclusion, promoting digital literacy, and supporting early childhood 
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; development. Thank you for being a part of our journey toward shaping brighter futures, one 
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; game at a time!
        </p>
    </div>
</div>
     



    <div class="section-title" style=" margin-left:440px!important; margin-right:420px!important; margin-bottom:10px;">Faq's</div>

    <section class="faq-section">
    <div class="faq-container">
        <details>
            <summary>Q: How long does shipping take?</summary>
            <p>Shipping usually takes 5-7 business days.</p>
        </details>
        <details>
            <summary>Q: Do you offer international shipping?</summary>
            <p>No, we only ship in PAKISTAN.</p>
        </details>
        <details>
            <summary>Q: Can I cancel or modify my order?</summary>
            <p>Orders can be modified or canceled within 24 hours.</p>
        </details>
    </div>
        </section>

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
                     </a>
                </div>
            </div>
        </div>
    </footer>

    <div class="chat-button">
        <i class="fa-solid fa-comments"></i>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>