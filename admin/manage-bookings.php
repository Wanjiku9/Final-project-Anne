<?php
include 'header.php';
include 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .main-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn-add-booking {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-add-booking:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        thead {
            background-color: #f0f0f0;
        }

    
    </style>
</head>
<body>
<div class="main-content">
    <h1>Manage Bookings</h1>
    
    <button class="btn-add-booking" onclick="window.location.href='add-booking.php'">Add New Booking</button>
  
    <table class="booking-table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Arrival Date</th>
                <th>Departure Date</th>
                <th>Package Type</th>
                <th>Room Type</th>
                <th>Number of Rooms</th>
                <th>Total Price</th>
                <th>Confirmed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch bookings from the database
            $sql = "SELECT booking_id, name, email, arrival_date, departure_date, package_type, room_type, number_of_rooms, total_price, confirmed FROM bookings";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $confirmedStatus = $row['confirmed'] ? 'Yes' : 'No'; // Convert 0/1 to Yes/No
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['booking_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['arrival_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['departure_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['package_type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['room_type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['number_of_rooms']) . "</td>";
                    echo "<td>" . htmlspecialchars('Ksh ' . number_format($row['total_price'], 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($confirmedStatus) . "</td>";
                    
                }
            } else {
                echo "<tr><td colspan='11'>No bookings found</td></tr>";
            }

            $conn->close(); 
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
include 'footer.php';
?>
