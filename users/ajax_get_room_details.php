<?php
// ajax_get_room_details.php


include 'connection.php';

// Get the room ID from the request
$room_id = $_POST['room_id'] ?? null;

if ($room_id) {
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->bind_param('i', $room_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
        echo json_encode($room);
    } else {
        echo json_encode(['error' => 'Room not found']);
    }
    
    $stmt->close();
}

$conn->close();
?>
