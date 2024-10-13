<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to UniCraft</title>
    <link rel="stylesheet" href="style.css">
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('images/pexels-pixabay-264787.jpg') no-repeat center center/cover;

        }

        .welcome-container {
            text-align: center;
            padding: 50px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            background: radial-gradient(#fff,#abd0f6);
            font-family: 'Times New Roman', Times, serif;
            font-size: 15px;
            font-weight: 500;

        }

        .welcome-message {
            font-size: 30px;
            color: 0a0537;
            margin-bottom: 20px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: 800;

        }

        .explore-link {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 30px;
        }

        .explore-link:hover {
            background-color: #2980b9;
        }
    </style>

</head>
<body>

<div class="welcome-container">
    <?php
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<p class='welcome-message'>Welcome, $username!</p>";
    } else {
        // Redirect to the login page if not logged in
        header("Location: account.php");
        exit();
    }
    ?>
    <p><b>Thank you for logging in to UniCraft. Explore our amazing products.</b> <a href="product.html" class="explore-link">All Products</a>.</p>
</div>

</body>
</html>
