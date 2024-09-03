<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tour Management System</title>
    <style>
        .main-content {
            margin: 0;
    padding: 20px;
    background-size: cover;
    background-attachment: fixed;
    background-position: center center;
    color: #fff;
        }

        .links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .links a {
            text-decoration: none;
            color: #007bff;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            text-align: center;
        }

        .links a:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Admin Dashboard</h1>
        
        <div class="links">
            <a href="manage-users.php">Manage Users</a>
            <a href="manage-bookings.php">Manage Bookings</a>
            <a href="manage-packages.php">Manage Packages</a>
            <a href="manage-rooms.php">Manage Rooms</a>
            
        </div>
    </div>

<?php
include 'footer.php';
?>
</body>
</html>
