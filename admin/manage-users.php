<?php
include 'header.php';
include 'connection.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .main-content {
            max-width: 800px;
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

        .btn-add-user {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-add-user:hover {
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

        .actions a {
            margin-right: 10px;
            color: #337ab7;
        }

        .actions a:hover {
            color: #23527c;
        }
    </style>
</head>
<body>
<div class="main-content">
    <h1>Manage Users</h1>
    <button class="btn-add-user" onclick="window.location.href='add-user.php'">Add New User</button>
   
    <table class="user-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $sql = "SELECT userid, first_name, last_name, email FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td class='actions'>
                            <a href='edit-user.php?id=" . $row['userid'] . "' class='edit'>Edit</a>
                            <a href='delete-user.php?id=" . $row['userid'] . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
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
