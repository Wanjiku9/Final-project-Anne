<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        
        .footer {
            background-color: #333;
            padding: 20px;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #444;
            font-family: Arial, sans-serif;
        }

        .footer p {
            margin: 0;
            color: #fff;
            font-size: 14px;
        }

        .footer a {
            color: #66d9ef;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            text-decoration: underline;
            color: #9fdefe;
        }
    </style>
</head>
<body>
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Tour Management System. All rights reserved. | >
        </p>
    </div>
</body>
</html>
