<?php
include 'connection.php';

$room = null;
$message = "";

// Handle form submission for selecting a room to edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['room_id']) && !isset($_POST['room_title'])) {
    $room_id = intval($_POST['room_id']);

    if ($room_id > 0) {
        // Fetch room details
        $sql = "SELECT * FROM rooms WHERE room_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $room = $result->fetch_assoc();

        if (!$room) {
            $message = "Room not found.";
        }
    } else {
        $message = "Invalid room ID.";
    }
}

// Handle form submission for updating the room
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['room_title']) && isset($_POST['room_id'])) {
    $room_id = intval($_POST['room_id']);
    $room_title = $_POST['room_title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    if ($room_id > 0) {
        // Update room details
        $sql = "UPDATE rooms SET room_title = ?, description = ?, price = ?, image = ?, updated_at = NOW() WHERE room_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $room_title, $description, $price, $image, $room_id);

        if ($stmt->execute()) {
            // Redirect with a confirmation message
            header("Location: manage-rooms.php?message=Room updated successfully.");
            exit();
        } else {
            $message = "Error updating room.";
        }
    } else {
        $message = "Invalid room ID.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room - Adventura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('pkgbackground.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .input-field {
            margin-bottom: 15px;
        }

        .input-field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-field input, .input-field textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #007BFF;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            color: #fff;
            background-color: #28a745;
            border-radius: 5px;
            text-align: center;
        }

        .message.error {
            background-color: #dc3545;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <main>
        <h1>Edit Room</h1>

        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'Error') !== false ? 'error' : ''; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!$room): ?>
            <form method="POST" action="">
                <div class="input-field">
                    <label for="room_id">Select Room to Edit</label>
                    <select id="room_id" name="room_id" required>
                        <option value="">--Select a Room--</option>
                        <?php
                        $sql = "SELECT room_id, room_title FROM rooms";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . htmlspecialchars($row['room_id']) . "\">" . htmlspecialchars($row['room_title']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit">Select Room</button>
            </form>
        <?php else: ?>
            <form method="POST" action="">
                <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room['room_id']); ?>">
                <div class="input-field">
                    <label for="room_title">Room Title</label>
                    <input type="text" id="room_title" name="room_title" value="<?php echo htmlspecialchars($room['room_title']); ?>" required>
                </div>
                <div class="input-field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($room['description']); ?></textarea>
                </div>
                <div class="input-field">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($room['price']); ?>" required>
                </div>
                <div class="input-field">
                    <label for="image">Image URL</label>
                    <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($room['image']); ?>" required>
                </div>
                <button type="submit">Update Room</button>
            </form>
        <?php endif; ?>

        <a href="manage-rooms.php" class="back-button">Back to Manage Rooms</a>
    </main>
</body>
</html>
