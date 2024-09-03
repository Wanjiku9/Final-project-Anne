<?php
include 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Initialize error messages
    $errors = [];

    // Validate form input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    if (empty($password)) {
        $errors[] = 'Password is required';
    }

    if (empty($errors)) {
        // Prepare and execute query to fetch the user
        $sql = "SELECT password FROM admins WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashedPassword)) {
                // Redirect to dashboard.php
                header("Location: dashboard.php");
                exit(); 
            } else {
                $errors[] = 'Incorrect password';
            }
        } else {
            $errors[] = 'No account found with that email';
        }

        $stmt->close(); 
    }

    // Display error messages if there are any
    if (!empty($errors)) {
        $errorMessages = implode('\n', $errors);
        echo "<script>alert('Error:\n$errorMessages'); window.location.href='login.php';</script>";
    }

    $conn->close(); 
}
?>
