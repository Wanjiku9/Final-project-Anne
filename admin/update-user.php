<?php
// Include the connection file
include 'connection.php'; // Make sure this is the correct path to your connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the POST data
    $user_id = $_POST['userid'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement for updating the user
    if (!empty($password)) {
        // If a new password is provided, update it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ? WHERE userid = ?");
        $stmt->bind_param("ssssi", $firstname, $lastname, $email, $hashed_password, $user_id);
    } else {
        // If no new password is provided, do not change the password
        $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE userid = ?");
        $stmt->bind_param("sssi", $firstname, $lastname, $email, $user_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
