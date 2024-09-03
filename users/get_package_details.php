<?php
include 'connection.php';

// Get the package ID from the request
$package_id = $_POST['package_id'];

//  get package details
$query = "SELECT * FROM packages WHERE package_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $package_id);
$stmt->execute();
$result = $stmt->get_result();
$package = $result->fetch_assoc();

if ($package) {
    // Send the package details as a JSON response
    echo json_encode($package);
} else {
    // Return an empty JSON response if no package is found
    echo json_encode([]);
}

$conn->close();
?>
