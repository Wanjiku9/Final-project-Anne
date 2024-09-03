<?php
include 'connection.php'; 

// Fetch room data from the database
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching rooms: " . $conn->error);
}

// Handle delete requests
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM rooms WHERE room_id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    header("Location: manage-rooms.php"); // Redirect to avoid re-submission
    exit();
}

// Handle edit form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_room'])) {
    $room_id = intval($_POST['room_id']);
    $title = $conn->real_escape_string($_POST['room_title']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);
    $image = $conn->real_escape_string($_POST['image']);

    $update_sql = "UPDATE rooms SET room_title='$title', description='$description', price=$price, image='$image' WHERE room_id=$room_id";
    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    header("Location: manage-rooms.php"); // Redirect to avoid re-submission
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Rooms - My Tour Website</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('pkgbackground.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #f2f2f2;
      padding: 20px;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      text-decoration: none;
      color: #333;
    }

    .top-navigation {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navigation {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    .navigation li {
      display: inline-block;
      margin-right: 20px;
    }

    .navigation li a {
      text-decoration: none;
      color: black;
    }

    main {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    h1 {
      color: #333;
      text-align: center;
    }

    .room-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 20px;
      width: 100%;
      max-width: 1200px;
    }

    .room-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      text-align: center;
      background: #fff;
      padding: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .room-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    .room-card-content h2 {
      font-size: 18px;
      font-weight: bold;
      margin: 10px 0;
      color: #333;
    }

    .room-card-content p {
      font-size: 16px;
      font-weight: bold;
      margin: 10px 0;
      color: #333;
    }

    .room-card-content ul {
      list-style-type: disc;
      padding-left: 20px;
      text-align: left;
      font-size: 14px;
      color: #666;
      margin: 10px 0;
    }

    .room-card-actions {
      margin-top: 10px;
    }

    .room-card-actions a {
      display: inline-block;
      padding: 10px 20px;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-right: 5px;
    }

    .edit-button {
      background-color: #007BFF;
    }

    .edit-button:hover {
      background-color: #0056b3;
    }

    .delete-button {
      background-color: #dc3545;
    }

    .delete-button:hover {
      background-color: #c82333;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
      clear: both;
    }
  </style>
</head>
<body>
  
  <main>
    <h1>Manage Rooms</h1>

    <div class="room-container">
      <?php while ($room = $result->fetch_assoc()): ?>
      <div class="room-card">
        <img src="<?php echo htmlspecialchars($room['image']); ?>" alt="<?php echo htmlspecialchars($room['room_title']); ?>">
        <div class="room-card-content">
          <h2><?php echo htmlspecialchars($room['room_title']); ?></h2>
          <p><?php echo htmlspecialchars('ksh' . number_format($room['price'], 2)); ?> per room</p>
          <ul>
            <?php 
            // Split description into list items
            $descriptions = explode(';', $room['description']);
            foreach ($descriptions as $desc) {
                echo '<li>' . htmlspecialchars(trim($desc)) . '</li>';
            }
            ?>
          </ul>
          <div class="room-card-actions">
            <a href="edit-rooms.php?room_id=<?php echo $room['room_id']; ?>" class="edit-button">Edit</a>
            <a href="?delete_id=<?php echo $room['room_id']; ?>" onclick="return confirm('Are you sure you want to delete this room?');" class="delete-button">Delete</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </main>

  <footer>
    <p>&copy; 2024 Tour Management. All rights reserved.</p>
  </footer>
</body>
</html>
