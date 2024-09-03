<?php
session_start(); // Start the session
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $error_message = "";

    // Query database for user with the given email using prepared statement
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session and redirect to home.html
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['email'] = $row['email'];
            session_regenerate_id(true); // Regenerate session ID for security
            header('Location: home.html'); // Redirect to home.html
            exit();
        } else {
            $error_message = "Incorrect password";
        }
    } else {
        $error_message = "User not found";
    }

    $stmt->close();
    $conn->close(); 

    // If there is an error, redirect with error message
    if (!empty($error_message)) {
        echo "<script>alert('$error_message'); window.location.href = 'login.html';</script>";
    }
}
?>
