<?php
include 'connection.php'; 

$package_title = $description = $price = $inclusions = $image = "";
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_title = $_POST['package_title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $inclusions = $_POST['inclusions'];
    $image = $_POST['image'];

    if (empty($package_title)) {
        $errors[] = "Package title is required";
    }
    if (empty($description)) {
        $errors[] = "Description is required";
    }
    if (empty($price) || !is_numeric($price)) {
        $errors[] = "Valid price is required";
    }
    if (empty($image)) {
        $errors[] = "Image URL is required";
    }

    // If no errors, insert the new package into the database
    if (empty($errors)) {
        $sql = "INSERT INTO packages (package_title, description, price, inclusions, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdss", $package_title, $description, $price, $inclusions, $image);
        
        if ($stmt->execute()) {
            header("Location: manage-packages.php");
            exit();
        } else {
            $errors[] = "Error creating package: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Package - Adventura</title>
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
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
        }
        h1 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            color: #dc3545;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <main>
        <h1>Create New Package</h1>

        <?php
        if (!empty($errors)) {
            echo '<div class="error"><ul>';
            foreach ($errors as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul></div>';
        }
        ?>

        <form method="POST" action="create-package.php">
            <label for="package_title">Title</label>
            <input type="text" id="package_title" name="package_title" value="<?php echo htmlspecialchars($package_title); ?>">

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($description); ?></textarea>

            <label for="price">Price (ksh)</label>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>">

            <label for="inclusions">Inclusions (comma separated)</label>
            <input type="text" id="inclusions" name="inclusions" value="<?php echo htmlspecialchars($inclusions); ?>">

            <label for="image">Image URL</label>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($image); ?>">

            <input type="submit" value="Create Package">
        </form>
    </main>
</body>
</html>
