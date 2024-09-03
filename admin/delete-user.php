<?php
include 'connection.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    
    $stmt = $conn->prepare("DELETE FROM users WHERE userid = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No user ID provided.";
}

$conn->close();
?>
