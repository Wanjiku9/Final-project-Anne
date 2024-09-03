<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book - Adventura</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: url('bookphoto.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    header {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      text-decoration: none;
      color: #333;
    }

    .top-navigation {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navigation {
      list-style-type: none;
      margin: 0;
      padding: 10px;
      display: flex;
    }

    .navigation li {
      display: inline-block;
      margin-right: 40px;
    }

    .navigation li a {
      text-decoration: none;
      color: #333;
    }

    main {
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: auto;
    }

    h1 {
      color: #333;
    }

    .form-section {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #000; 
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    select {
      width: 100%; 
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      color: #000; 
      background-color: #fff; 
    }

    input[type="checkbox"] {
      margin-right: 10px;
    }

    button {
      padding: 10px 20px;
      background-color: #ff6600;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #e65c00;
    }

    footer {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      text-align: center;
      margin-top: 20px;
    }

    footer p {
      color: #999;
    }

    #packageType, #roomType {
      width: 100%; 
      color: #000; 
    }

    .form-section select {
      width: 100%; 
    }

    .form-section select option {
      padding: 10px;
      color: #000; 
    }
  </style>
</head>
<body>
  
  <header>
    <div class="top-navigation">
      <a href="#" class="logo">Adventura</a>
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
    </div>
  </header>

  <main>
    <h1>Book Your Stay</h1>
    <form id="bookingForm" method="post" action="process-booking.php">
      <div class="form-section">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
      </div>

      <div class="form-section">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-section">
        <label for="arrivalDate">Arrival Date:</label>
        <input type="date" id="arrivalDate" name="arrivalDate" min="2024-01-01" max="2024-12-31" required>
      </div>

      <div class="form-section">
        <label for="departureDate">Departure Date:</label>
        <input type="date" id="departureDate" name="departureDate" min="2024-01-02" max="2024-12-31" required>
      </div>

      <div class="form-section">
        <label for="packageType">Select Package:</label>
        <select id="packageType" name="packageType" required>
          <option value="1" data-price="32000.00">Wellness and Beach Fitness Package</option>
          <option value="2" data-price="40000.00">Water Sports Adventure Package</option>
          <option value="3" data-price="30000.00">Relaxation and Leisure Package</option>
          <option value="4" data-price="30000.00">Beach Party and Nightlife Package</option>
          <option value="5" data-price="35000.00">Family Beach Vacation Package</option>
          <option value="6" data-price="40000.00">Romantic Beach Retreat Package</option>
        </select>
      </div>

      <div class="form-section">
        <label for="roomType">Select Room Type:</label>
        <select id="roomType" name="roomType" required>
          <option value="1" data-price="7500.00">Standard Room</option>
          <option value="2" data-price="9000.00">Deluxe Room</option>
          <option value="3" data-price="10000.00">Suite</option>
          <option value="4" data-price="12000.00">Family Room</option>
          <option value="5" data-price="8500.00">Twin Room</option>
        </select>
      </div>

      <div class="form-section">
        <label for="numRooms">Number of Rooms:</label>
        <select id="numRooms" name="numRooms" required>
          <?php for ($i = 1; $i <= 10; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>

      <div class="form-section">
        <label for="totalPrice">Total Price:</label>
        <input type="text" id="totalPrice" name="totalPrice" readonly>
      </div>

      <div class="form-section">
        <input type="checkbox" id="confirmBooking" name="confirmBooking" required>
        <label for="confirmBooking">Confirm Booking</label>
      </div>

      <button type="submit">Book Now</button>
    </form>
  </main>

  <footer>
    <p>&copy; 2024 Adventura. All rights reserved.</p>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotal() {
          const packageType = document.getElementById('packageType');
          const roomType = document.getElementById('roomType');
          const numRooms = document.getElementById('numRooms');
          const totalPrice = document.getElementById('totalPrice');

          const packagePrice = parseFloat(packageType.options[packageType.selectedIndex].getAttribute('data-price')) || 0;
          const roomPrice = parseFloat(roomType.options[roomType.selectedIndex].getAttribute('data-price')) || 0;
          const rooms = parseInt(numRooms.value) || 1;

          const total = (packagePrice + roomPrice) * rooms;

          totalPrice.value = 'Ksh ' + total.toFixed(2);
        }

        // Calculate total price on changes
        const packageSelect = document.getElementById('packageType');
        const roomSelect = document.getElementById('roomType');
        const numRoomsSelect = document.getElementById('numRooms');

        if (packageSelect) packageSelect.addEventListener('change', calculateTotal);
        if (roomSelect) roomSelect.addEventListener('change', calculateTotal);
        if (numRoomsSelect) numRoomsSelect.addEventListener('change', calculateTotal);

        // Initial calculation
        calculateTotal();
    });
  </script>
</body>
</html>
