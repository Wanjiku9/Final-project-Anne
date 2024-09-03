<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else if (!preg_match('/^(?=.*[!@#$%^&*])(?=.{8,})/', $password)) {
        echo "<script>alert('Password must have at least 8 characters and a special character (!@#$%^&*).');</script>";
    } else {
        try {
            // Use BCRYPT for hashing
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstname, $lastname, $email, $passwordHash);

            // Execute the prepared statement
            if ($stmt->execute() === TRUE) {
                session_regenerate_id(true); // Regenerate session ID for security
                header('Location: home.html'); // Redirect to home.html
                exit(); // Stop further execution after redirection
            } else {
                echo "<script>alert('Registration Failed: " . $stmt->error . "');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        } finally {
            $stmt->close();
            $conn->close();
        }
    }
}
