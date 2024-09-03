<?php
include 'connection.php'; 
include 'header.php';

// Check if ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("User ID not specified.");
}

$user_id = intval($_GET['id']); 

// Prepare the SQL statement to get user data
$stmt = $conn->prepare("SELECT * FROM users WHERE userid = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

// Fetch user data
$user = $result->fetch_assoc();


$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.container {
    max-width: 500px;
    margin: 60px auto;
    padding: 30px;
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
    margin-bottom: 50px;
}

.input-field {
    margin-bottom: 50px;
}

.input-field input[type="text"], 
.input-field input[type="email"], 
.input-field input[type="password"] {
    width: 200%;
    padding: 10px;
    font-size: 16px;
    border: 3px solid #ccc;
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

button[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background-color: #4CAF50;
    color: #fff;
}

button[type="submit"]:hover {
    background-color: #3e8e41;
}

button[type="button"] {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
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
        <h1 id="title">Edit User</h1>
        <form method="POST" action="update-user.php">
            <input type="hidden" name="userid" value="<?php echo htmlspecialchars($user['userid']); ?>">
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" placeholder="First Name" required>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" placeholder="Last Name" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Email" required>
            <input type="password" name="password" placeholder="New Password">
            <button type="submit">Update User</button>
        </form>
    </div>
</body>
</html>
