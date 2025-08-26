<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_password = $_POST['newPassword'];

    // Hash the new password for security
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $query = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $hashed_password, $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Password updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update password!";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to profile page
    header("Location: profile.php");
    exit();
}
?>
