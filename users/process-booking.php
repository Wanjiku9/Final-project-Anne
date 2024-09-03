<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "adventura";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize form inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $arrivalDate = htmlspecialchars($_POST['arrivalDate']);
    $departureDate = htmlspecialchars($_POST['departureDate']);
    $packageType = htmlspecialchars($_POST['packageType']);
    $roomType = htmlspecialchars($_POST['roomType']);
    $numRooms = htmlspecialchars($_POST['numRooms']);
    $confirmBooking = isset($_POST['confirmBooking']) ? 1 : 0;

    // Define arrays mapping IDs to names and prices
    $packagePrices = [
        1 => ['name' => 'Wellness and Beach Fitness Package', 'price' => 32000.00],
        2 => ['name' => 'Water Sports Adventure Package', 'price' => 40000.00],
        3 => ['name' => 'Relaxation and Leisure Package', 'price' => 30000.00],
        4 => ['name' => 'Beach Party and Nightlife Package', 'price' => 30000.00],
        5 => ['name' => 'Family Beach Vacation Package', 'price' => 35000.00],
        6 => ['name' => 'Romantic Beach Retreat Package', 'price' => 40000.00],
    ];

    $roomPrices = [
        1 => ['name' => 'Standard Room', 'price' => 7500.00],
        2 => ['name' => 'Deluxe Room', 'price' => 9000.00],
        3 => ['name' => 'Suite', 'price' => 10000.00],
        4 => ['name' => 'Family Room', 'price' => 12000.00],
        5 => ['name' => 'Twin Room', 'price' => 8500.00],
    ];

    // Retrieve prices based on selected IDs
    $package = $packagePrices[$packageType] ?? ['name' => 'Unknown Package', 'price' => 0];
    $room = $roomPrices[$roomType] ?? ['name' => 'Unknown Room', 'price' => 0];

    $totalPrice = ($package['price'] + $room['price']) * $numRooms;

    // Prepare SQL query to insert booking information
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, arrival_date, departure_date, package_type, room_type, number_of_rooms, total_price, confirmed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiiidb", $name, $email, $arrivalDate, $departureDate, $packageType, $roomType, $numRooms, $totalPrice, $confirmBooking);

    if ($stmt->execute()) {
        // Display booking information
        echo "<h1>Booking Confirmation</h1>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Arrival Date: $arrivalDate</p>";
        echo "<p>Departure Date: $departureDate</p>";
        echo "<p>Package Type: " . htmlspecialchars($package['name']) . "</p>";
        echo "<p>Room Type: " . htmlspecialchars($room['name']) . "</p>";
        echo "<p>Number of Rooms: $numRooms</p>";
        echo "<p>Total Price: Ksh " . number_format($totalPrice, 2) . "</p>";

        if ($confirmBooking) {
            echo "<p>Your booking has been confirmed!</p>";
        } else {
            echo "<p>Booking confirmation is required to complete the process.</p>";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request method.</p>";
}
?>
