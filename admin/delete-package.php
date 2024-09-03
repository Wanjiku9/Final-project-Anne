<?php
include 'connection.php'; 

$message = "";

// Handle form submission for deleting a package
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);

    if ($package_id > 0) {
        // Delete package
        $sql = "DELETE FROM packages WHERE package_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $package_id);

        if ($stmt->execute()) {
            $message = "Package deleted successfully.";
        } else {
            $message = "Error deleting package.";
        }
    } else {
        $message = "Invalid package ID.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Package - Adventura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('pkgbackground.jpg') no-repeat center center fixed;
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
        <h1>Delete Package</h1>

        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'Error') !== false ? 'error' : ''; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-field">
                <label for="package_id">Select Package to Delete</label>
                <select id="package_id" name="package_id" required>
                    <option value="">--Select a Package--</option>
                    <?php
                    $sql = "SELECT package_id, package_title FROM packages";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . htmlspecialchars($row['package_id']) . "\">" . htmlspecialchars($row['package_title']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit">Delete Package</button>
        </form>

        <a href="manage-packages.php">Back to Packages</a>
    </main>

    <footer>
        <p>&copy; 2024 Adventura. All rights reserved.</p>
    </footer>
</body>
</html>
