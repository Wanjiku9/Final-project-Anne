<?php
include 'connection.php';

$package = null;
$message = "";

// Handle form submission for selecting a package to edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['package_id']) && !isset($_POST['package_title'])) {
    $package_id = intval($_POST['package_id']);

    if ($package_id > 0) {
        // Fetch package details
        $sql = "SELECT * FROM packages WHERE package_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $package_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $package = $result->fetch_assoc();

        if (!$package) {
            $message = "Package not found.";
        }
    } else {
        $message = "Invalid package ID.";
    }
}

// Handle form submission for updating the package
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['package_title']) && isset($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);
    $package_title = $_POST['package_title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    if ($package_id > 0) {
        // Update package details
        $sql = "UPDATE packages SET package_title = ?, description = ?, price = ?, image = ?, updated_at = NOW() WHERE package_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $package_title, $description, $price, $image, $package_id);

        if ($stmt->execute()) {
            // Redirect with a confirmation message
            header("Location: manage-packages.php?message=Package updated successfully.");
            exit();
        } else {
            $message = "Error updating package.";
        }
    } else {
        $message = "Invalid package ID.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Package - Adventura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('pkgbackground.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
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

        .input-field input, .input-field textarea, .input-field select {
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
            background-color: #007BFF;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <main>
        <h1>Edit Package</h1>

        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'Error') !== false ? 'error' : ''; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!$package): ?>
            <form method="POST" action="">
                <div class="input-field">
                    <label for="package_id">Select Package to Edit</label>
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
                <button type="submit">Select Package</button>
            </form>
        <?php else: ?>
            <form method="POST" action="">
                <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package['package_id']); ?>">
                <div class="input-field">
                    <label for="package_title">Package Title</label>
                    <input type="text" id="package_title" name="package_title" value="<?php echo htmlspecialchars($package['package_title']); ?>" required>
                </div>
                <div class="input-field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($package['description']); ?></textarea>
                </div>
                <div class="input-field">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($package['price']); ?>" required>
                </div>
                <div class="input-field">
                    <label for="image">Image URL</label>
                    <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($package['image']); ?>" required>
                </div>
                <button type="submit">Update Package</button>
            </form>
        <?php endif; ?>

        <a href="manage-packages.php" class="back-button">Back to Manage Packages</a>
    </main>
</body>
</html>
