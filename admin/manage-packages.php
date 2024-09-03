<?php
include 'connection.php'; 

// Fetch all packages
$sql = "SELECT * FROM packages";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching packages: " . $conn->error);
}

// Handle deletion of a package
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    $deleteSql = "DELETE FROM packages WHERE package_id = ?";

    if ($stmt = $conn->prepare($deleteSql)) {
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
        $stmt->close();
        // Redirect to avoid resubmission
        header("Location: manage-packages.php");
        exit();
    } else {
        die("Error deleting package: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Packages - Adventura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('pkgbackground.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .package-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .package-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            background: #fff;
            padding: 20px;
        }

        .package-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .package-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .package-description {
            font-size: 14px;
            margin: 10px 0;
        }

        .package-price {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
        }

        .package-inclusions {
            font-size: 14px;
            margin: 10px 0;
            text-align: left;
        }

        .package-inclusions ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .package-actions {
            margin-top: 10px;
        }

        .package-actions a {
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

        .add-button {
            background-color: #28a745;
            margin-bottom: 20px;
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-button:hover {
            background-color: #218838;
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
        <h1>Manage Packages</h1>
        <a href="create-package.php" class="add-button">Create Package</a>
        <div class="package-container">
            <?php while ($package = $result->fetch_assoc()): ?>
                <div class="package-item">
                    <img src="<?php echo htmlspecialchars($package['image']); ?>" alt="<?php echo htmlspecialchars($package['package_title']); ?>">
                    <div class="package-title"><?php echo htmlspecialchars($package['package_title']); ?></div>
                    <div class="package-description"><?php echo htmlspecialchars($package['description']); ?></div>
                    <div class="package-price">Base Price: <?php echo htmlspecialchars($package['price']); ?></div>
                    <div class="package-inclusions">
                        <h3>Package Inclusions:</h3>
                        <ul>
                            <?php 
                            $inclusions = explode(',', $package['inclusions']);
                            foreach ($inclusions as $inclusion) {
                                echo '<li>' . htmlspecialchars(trim($inclusion)) . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="package-actions">
                        <a href="edit-packages.php?package_id=<?php echo $package['package_id']; ?>" class="edit-button">Edit</a>
                        <a href="manage-packages.php?delete_id=<?php echo $package['package_id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this package?');">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Adventura. All rights reserved.</p>
    </footer>
</body>
</html>
