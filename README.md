# 🧩 Cognitive Corner

Cognitive Corner is an **educational e-commerce platform** designed to sell **board games, puzzles, cards, and fun educational toys**.  
The site is built using **PHP, MySQL, Bootstrap 5, and Font Awesome** to deliver a modern, user-friendly shopping experience.

---

## 🚀 Features

- 🛒 **Shop System** – Categories: Cards, Board Games, Puzzles, Custom Suggestions.  
- ✨ **New Arrivals & Best Sellers** – Highlighted educational games with purchase options.  
- 👨‍👩‍👧‍👦 **Testimonials Section** – Customer reviews & feedback showcase.  
- 📞 **Contact Modal** – Email, phone, and social media links integrated.  
- 🔑 **User Accounts** – Includes Login, Signup, and Profile pages.  
- 🎨 **Responsive Design** – Styled with Bootstrap 5, Font Awesome icons, and custom CSS.  
- ❓ **FAQ Section** – Common queries about shipping and orders.  
- 🧑‍💻 **MySQL Integration** – Data stored and managed via a MySQL database.  

---

## 🗂️ Project Structure

```
project-folder/
│── index.php        # Homepage
│── profile.php      # User profile page
│── login.php        # User login
│── signup.php       # User registration
│── shop.php         # Shop page (products)
│── review.php       # Reviews page
│── suggestions.php  # Custom game suggestions
│── css/styles.css   # Custom styles
│── fonts/           # Custom fonts
│── image/           # Images & product pictures
│── README.md        # Documentation
```

---

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, Bootstrap 5, Font Awesome  
- **Backend**: PHP  
- **Database**: MySQL  
- **Other**: Google Fonts, JavaScript (Bootstrap Bundle)  

---

## ⚙️ Installation & Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/cognitive-corner.git
   cd cognitive-corner
   ```

2. **Move Project to Server Directory**
   - If using **XAMPP**: place files inside `htdocs/cognitive-corner/`  
   - If using **WAMP**: place files inside `www/cognitive-corner/`  

3. **Set Up Database**
   - Import the provided `cognitive_corner.sql` file into MySQL.  
   - Update database credentials in your PHP files:
     ```php
     $servername = "localhost";
     $username   = "root";     // change if needed
     $password   = "";         // change if set
     $dbname     = "cognitive_corner";
     ```

4. **Run the Project**
   - Start Apache & MySQL from XAMPP/WAMP.  
   - Open in browser:  
     ```
     http://localhost/cognitive-corner/
     ```

---

## 📌 Future Improvements

- 🛍️ Shopping Cart with Checkout & Payment Gateway  
- 📦 Order Tracking System  
- 📊 Admin Dashboard for Product Management  
- 🌍 Multi-language Support  

---

## 👨‍💻 Author

Developed by **Muhammed Mohsin** 🚀  
📧 Contact: cognitivecornerI9@gmail.com  
