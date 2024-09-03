<?php
include 'connection.php'; 

$message = "";

// Handle form submission for deleting a room
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['room_id'])) {
    $room_id = intval($_POST['room_id']);

    if ($room_id > 0) {
        // Delete room
        $sql = "DELETE FROM rooms WHERE room_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $room_id);

        if ($stmt->execute()) {
            $message = "Room deleted successfully.";
        } else {
            $message = "Error deleting room.";
        }
    } else {
        $message = "Invalid room ID.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Room - Adventura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('roombackground.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
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

        .input-field select {
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
            background-color: #dc3545;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c82333;
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

        a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            box-sizing: border-box;
        }

        a:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <header>
        <h1>Adventura</h1>
    </header>

    <main>
        <h1>Delete Room</h1>

        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'Error') !== false ? 'error' : ''; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-field">
                <label for="room_id">Select Room to Delete</label>
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
            <button type="submit">Delete Room</button>
        </form>

        <a href="manage-rooms.php">Back to Rooms</a>
    </main>

    <footer>
        <p>&copy; 2024 Adventura. All rights reserved.</p>
    </footer>
</body>
</html>
