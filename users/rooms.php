<?php
include 'connection.php';

// Fetch all rooms from the database
$query = "SELECT * FROM rooms";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
} else {
    $rooms = [];
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rooms - Adventura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('pkgbackground.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .top-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
        }

        .navigation {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navigation li {
            margin-right: 40px;
        }

        .navigation a {
            text-decoration: none;
            color: #fff;
        }

        .navigation a:hover {
            color: #ccc;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .room-container {
          display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 20px;
        }

        .room-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .room-card img {
            width: 100%;
            height: 300px; 
            object-fit: cover;
        }

        .room-card-content {
            padding: 15px;
        }

        .room-card-content h2 {
            margin: 0;
            font-size: 24px;
        }

        .room-card-content p {
            font-size: 18px;
            color: brown;
        }

        .room-card-content ul {
            list-style-type: disc;
            margin: 10px 0;
            padding-left: 20px;
        }

        .room-card-content ul li {
            margin: 5px 0;
        }

        .book-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }

        .book-button:hover {
            background-color: #0056b3;
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
    <header>
        <nav class="top-navigation">
            <a class="logo" href="#">Adventura</a>
            <ul class="navigation">
                <li><a href="home.html">Home</a></li>
                <li><a href="book.php">Book</a></li>
                <li><a href="packages.php">Packages</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Our Rooms</h1>
        <div class="room-container">
            <?php if (!empty($rooms)): ?>
                <?php foreach ($rooms as $room): ?>
                    <div class="room-card">
                        <img src="<?php echo htmlspecialchars($room['image']); ?>" alt="<?php echo htmlspecialchars($room['room_title']); ?>">
                        <div class="room-card-content">
                            <h2><?php echo htmlspecialchars($room['room_title']); ?></h2>
                            <p><?php echo htmlspecialchars('Ksh ' . number_format($room['price'], 2)); ?> per room</p>
                            <ul>
                                <?php 
                                // Split description into list items
                                $descriptions = explode(';', $room['description']);
                                foreach ($descriptions as $desc) {
                                    echo '<li>' . htmlspecialchars(trim($desc)) . '</li>';
                                }
                                ?>
                            </ul>
                            <a href="book.php" class="book-button">Book Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No rooms available.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Adventura. All rights reserved.</p>
    </footer>
</body>
</html>
