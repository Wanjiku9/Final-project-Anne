<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      text-align: center;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color: #337ab7;
      color: #fff;
    }
    button:hover {
      background-color: #23527c;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome to Adventura</h1>
    <p>You are logged in as <?php echo htmlspecialchars($_SESSION['email']); ?>.</p>
    <form action="logout.php" method="POST">
      <button type="submit">Logout</button>
    </form>
  </div>
</body>
</html>
