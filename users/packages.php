<?php
include 'connection.php';

// Fetch all packages from the database
$query = "SELECT * FROM packages";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $packages = [];
    while ($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
} else {
    $packages = [];
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Packages - Adventura</title>
    <style>
         body {
    font-family: Arial, sans-serif;
    background: url('pkgbackground.jpg') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.top-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;
}

.navigation {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.navigation li {
    margin-right: 40px;
}

.navigation a {
    text-decoration: none;
    color: #fff;
}

.navigation a:hover {
    color: #ccc;
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

.package-photo {
    cursor: pointer;
}

.package-photo img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}

.package-title {
    font-size: 18px;
    font-weight: bold;
    margin-top: 10px;
}

#package-details {
    display: none;
    font-weight: bold;
    padding: 20px;
    max-width: 800px;
    margin: 20px;
    text-align: center;
}

#package-details h2 {
    margin-top: 0;
}

#package-details p {
    margin: 10px 0;
}

#package-details ul {
    list-style-type: disc;
    padding-left: 20px;
    margin: 10px 0;
    text-align: left;
}

#package-details ul li {
    margin: 10px 0;
}

.book-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007BFF;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
}

.book-button:hover {
    background-color: #0056b3;
}

.back-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #6c757d;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    cursor: pointer;
}

.back-button:hover {
    background-color: #5a6268;
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
    <header>
        <nav class="top-navigation">
            <a class="logo" href="#">Adventura</a>
            <ul class="navigation">
                <li><a href="home.html">Home</a></li>
                <li><a href="book.php">Book</a></li>
                <li><a href="packages.php">Packages</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Explore Our Adventure Packages</h1>
        <div id="packages-view" class="package-container">
            <?php if (!empty($packages)): ?>
                <?php foreach ($packages as $package): ?>
                    <div class="package-photo" onclick="ShowPackageDetails('<?php echo $package['package_id']; ?>')">
                        <img src="<?php echo $package['image']; ?>" alt="<?php echo htmlspecialchars($package['package_title']); ?>">
                        <div class="package-title"><?php echo htmlspecialchars($package['package_title']); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No packages available.</p>
            <?php endif; ?>
        </div>
        <div id="package-details"></div>
    </main>

    <footer>
        <p>&copy; 2024 Adventura. All rights reserved.</p>
    </footer>

    <script>
    function ShowPackageDetails(packageId) {
        // Hide the package overview view
        var packagesView = document.getElementById('packages-view');
        packagesView.style.display = 'none';

        // Show the package details view
        var packageDetails = document.getElementById('package-details');
        packageDetails.style.display = 'block';

        // Define content for package details based on the selected package
        var detailsContent = '';

        // Fetch package details via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_package_details.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response) {
                    detailsContent = `
                        <h2>${response.title}</h2>
                        <p>${response.description}</p>
                        <p>Base package Price: ${response.price}</p>
                        <h3>Package Inclusions:</h3>
                        <ul>
                            ${response.inclusions.split(',').map(inclusion => `<li>${inclusion.trim()}</li>`).join('')}
                        </ul>
                        <a href="book.html" class="book-button">Book Now</a>
                        <div class="back-button" onclick="showPackagesView()">Back to Packages</div>
                    `;
                    packageDetails.innerHTML = detailsContent;
                }
            }
        };
        xhr.send('package_id=' + encodeURIComponent(packageId));
    }

    function showPackagesView() {
        var packagesView = document.getElementById('packages-view');
        packagesView.style.display = 'grid';
        var packageDetails = document.getElementById('package-details');
        packageDetails.style.display = 'none';
    }
</script>

</body>
</html>
