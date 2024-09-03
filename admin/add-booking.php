<?php
include 'header.php';
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting the form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $arrivalDate = $conn->real_escape_string($_POST['arrivalDate']);
    $departureDate = $conn->real_escape_string($_POST['departureDate']);
    $packageType = $conn->real_escape_string($_POST['packageType']);
    $roomType = $conn->real_escape_string($_POST['roomType']);
    $numRooms = (int)$_POST['numRooms'];
    $totalPrice = (float)$_POST['totalPrice'];
    $confirmed = isset($_POST['confirmed']) ? 1 : 0;

    
    $sql = "INSERT INTO bookings (name, email, arrival_date, departure_date, package_type, room_type, number_of_rooms, total_price, confirmed)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssidi", $name, $email, $arrivalDate, $departureDate, $packageType, $roomType, $numRooms, $totalPrice, $confirmed);
        
        if ($stmt->execute()) {
            echo "<script>alert('Booking added successfully.'); window.location.href='manage-bookings.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='add-booking.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->error . "'); window.location.href='add-booking.php';</script>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-box {
            padding: 20px;
        }
        #title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-field {
            margin-bottom: 20px;
        }
        .input-field input[type="text"], 
        .input-field input[type="email"], 
        .input-field input[type="date"], 
        .input-field input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
        }
        .input-field input[type="text"]:focus, 
        .input-field input[type="email"]:focus, 
        .input-field input[type="date"]:focus, 
        .input-field input[type="number"]:focus {
            border-color: #aaa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            outline: none;
        }
        .btn-field {
            margin-top: 20px;
        }
        button[type="submit"], 
        button[type="button"] {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
        }
        button[type="submit"]:hover {
            background-color: #3e8e41;
        }
        button[type="button"] {
            background-color: #aaa;
            color: #fff;
        }
        button[type="button"]:hover {
            background-color: #999;
        }
        a {
            text-decoration: none;
            color: #337ab7;
        }
        a:hover {
            color: #23527c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Add New Booking</h1>
            <form method="POST" action="add-booking.php">
                <div class="input-group">
                    <div class="input-field">
                        <input type="text" name="name" placeholder="Name" required>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-field">
                        <input type="date" name="arrivalDate" placeholder="Arrival Date" required>
                    </div>
                    <div class="input-field">
                        <input type="date" name="departureDate" placeholder="Departure Date" required>
                    </div>
                    <div class="input-field">
                        <select name="packageType" required>
                            <option value="">Select Package Type</option>
                            <option value="Wellness and Beach Fitness Package">Wellness and Beach Fitness Package</option>
                            <option value="Water Sports and Adventure Package">Water Sports and Adventure Package</option>
                            <option value="Relaxation and Leisure Package">Relaxation and Leisure Package</option>
                            <option value="Beach Party and Nightlife Package">Beach Party and Nightlife Package</option>
                            <option value="Family Beach Vacation Package">Family Beach Vacation Package</option>
                            <option value="Romantic Beach Retreat Package">Romantic Beach Retreat Package</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <select name="roomType" required>
                            <option value="">Select Room Type</option>
                            <option value="Standard Room">Standard Room</option>
                            <option value="Deluxe Room">Deluxe Room</option>
                            <option value="Suite">Suite</option>
                            <option value="Family Room">Family Room</option>
                            <option value="Twin Room">Twin Room</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <input type="number" name="numRooms" placeholder="Number of Rooms" required>
                    </div>
                    <div class="input-field">
                        <input type="number" name="totalPrice" placeholder="Total Price" step="0.01" required>
                    </div>
                    <div class="input-field">
                        <label>
                            <input type="checkbox" name="confirmed">
                            Confirmed
                        </label>
                    </div>
                    <div class="btn-field">
                        <button type="submit">Add Booking</button>
                        <button type="button" onclick="window.location.href='manage-bookings.php'">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
