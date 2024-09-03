<?php
include 'header.php';
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstName = $conn->real_escape_string($_POST['firstname']);
    $lastName = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validatng the  password
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match.'); window.location.href='add-user.php';</script>";
        exit();
    }
    if (strlen($password) < 8 || !preg_match('/[!@#$%^&*]/', $password)) {
        echo "<script>alert('Password must have at least 8 characters and a special character (!@#$%^&*).'); window.location.href='add-user.php';</script>";
        exit();
    }

    // Hashing the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Checking if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists.'); window.location.href='add-user.php';</script>";
    } else {
        // Inserting the new user into the database
        $insertQuery = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('ssss', $firstName, $lastName, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('User added successfully.'); window.location.href='manage-users.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='add-user.php';</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-box {
            padding: 20px;
        }
        #title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-field {
            margin-bottom: 20px;
        }
        .input-field input[type="text"], 
        .input-field input[type="email"], 
        .input-field input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
        }
        .input-field input[type="text"]:focus, 
        .input-field input[type="email"]:focus, 
        .input-field input[type="password"]:focus {
            border-color: #aaa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            outline: none;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .btn-field {
            margin-top: 20px;
        }
        button[type="submit"], 
        button[type="button"] {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
        }
        button[type="submit"]:hover {
            background-color: #3e8e41;
        }
        button[type="button"] {
            background-color: #aaa;
            color: #fff;
        }
        button[type="button"]:hover {
            background-color: #999;
        }
        a {
            text-decoration: none;
            color: #337ab7;
        }
        a:hover {
            color: #23527c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Add New User</h1>
            <form method="POST" action="add-user.php">
                <div class="input-group">
                    <div class="input-field">
                        <input type="text" name="firstname" placeholder="First Name" required>
                    </div>
                    <div class="input-field">
                        <input type="text" name="lastname" placeholder="Last Name" required>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="btn-field">
                        <button type="submit">Add User</button>
                        <button type="button" onclick="window.location.href='manage-users.php'">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
