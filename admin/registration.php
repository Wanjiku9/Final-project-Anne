<?php
include 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Initialize error messages
    $errors = [];

    // Validate form input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    if (strlen($password) < 8 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $errors[] = 'Password must be at least 8 characters long and include at least one special character';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match';
    }

    if (empty($errors)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute query to insert the new admin user
        $sql = "INSERT INTO admins (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $email, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect to dashboard.php after successful registration
            header("Location: dashboard.php");
            exit(); // Ensure no further code is executed after redirect
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='admin_register.php';</script>";
        }

        $stmt->close(); 
    } else {
        $errorMessages = implode('\n', $errors);
        echo "<script>alert('Error:\n$errorMessages'); window.location.href='admin_register.php';</script>";
    }

    $conn->close(); 
}
?>
