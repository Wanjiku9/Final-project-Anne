<?php
session_start();
include 'connection.php';

$name = '';
$email = '';
$results = [];

// This handles form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Query the bookings table based on the provided name and email
    $sql = "SELECT * FROM bookings WHERE name = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param('ss', $name, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results into an array
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            max-width: 1200px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container, .bookings-table {
            margin-top: 20px;
        }

        .form-container input[type="text"], .form-container input[type="submit"] {
            padding: 10px;
            margin: 5px 0;
            font-size: 16px;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bookings-table th, .bookings-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .bookings-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .bookings-table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<header>
    <h1>User Dashboard</h1>
</header>

<div class="container">
    <h2>Search Bookings</h2>
    <div class="form-container">
        <form method="post" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <input type="submit" value="Search Bookings">
        </form>
    </div>

    <?php if ($results): ?>
        <h2>Your Bookings</h2>
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Arrival Date</th>
                    <th>Departure Date</th>
                    <th>Package</th>
                    <th>Room Type</th>
                    <th>Number of Rooms</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['booking_id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['arrival_date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['departure_date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['package_type']); ?></td>
                        <td><?php echo htmlspecialchars($booking['room_type']); ?></td>
                        <td><?php echo htmlspecialchars($booking['number_of_rooms']); ?></td>
                        <td><?php echo htmlspecialchars('Ksh ' . number_format($booking['total_price'], 2)); ?></td>
                        <td><?php echo $booking['confirmed'] ? 'Confirmed' : 'Pending'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No bookings found for the provided name and email.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
