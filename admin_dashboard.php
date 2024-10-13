<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // If not logged in or not an admin, redirect to the account page
    header("Location: account.php");
    exit();
}
?>
<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Login and Signup</title>
    <link rel = "stylesheet" href = "style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel ="stylesheet" href = "https://stackpath.bootstrapcdn.com/font-
awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .dashboard-page{
            background: radial-gradient(#fff,#f1b9e4);
        }


        .my-account-section {
        position: relative;
        background: radial-gradient(#fff,#f1b9e4);
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        
        }


    

    .go-to-home a {
        text-decoration: none;
        color: #DF4DB0;
        text-align:center;
        font-size: 11px;
        
    }

    .go-to-home p {
        text-decoration: none;
        color:#701414;
        text-align:center;
        font-size: 11px;
        
    }

        .my-account-section h2 {
            text-align:center;
            color: #333;
        }

        .my-account-section p {
            color: #555;
            margin-bottom: 20px;
            text-align:center;
        }

        
        .my-account-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
           margin-top:50px;
        }

        .my-account-section ul li {
            margin-right: 20px;
        }

        .my-account-section ul li a {
            text-decoration: none;
            color: #fff;
            background-color: #DF4DB0;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .my-account-section ul li a:hover {
            background-color: #701414;
        }

        .myacc{
            background:rgba(194,194,194,0.713);
        }

    </style>
</head>

<body>

<div class="my-account-section">
    <div class= "myacc">    
        <h2>Admin Account</h2>
           <div class="go-to-home">
             <p><a href="index.php"> Home</a> / My Account</p>
          </div>

    </div>      
        <p>Welcome to your Dashboard, <?php echo $_SESSION['username']; ?></p>
         <p> From your account dashboard you can view your recent orders, 
        manage your shipping and billing addresses, and edit your password and account details.
        </p>

    

        
            <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_products.php">Manage Products</a></li>
        <li><a href="manage_orders.php">Manage Orders</a></li>
        <li><a href="item.php">Listing Items</a></li>
        <li><a href="logout.php"> Logout </a></li>
            </ul>
</div>

    <div class="footer">
        <div class="container">
            <div class = "row">
                <div class="footer-col-1">
                    <h3> USEFUL LINKS </h3>
                    <a href ="#"> About |</a>
                    <a href ="#"> Contact |</a>
                    <a href ="#"> Products</a>

                </div>

                <div class="footer-col-2">
                    <img src ="images/UniCraft.png" >
                    <p> Our purpose is to sustainably make the pleasure and
                        benefits to the university students.
                    </p>
                </div>

                <div class="footer-col-3">
                    <h3>CONTACT</h3>
                    <p> 070-582-4289: Jayathi
                    <br> 076-376-5276: Isuru <br> unicraftwaya@gmail.com</p>
                </div>
            </div>

            <hr>
            <p class ="copyright"> Copyright@2023 </p>
        </div>

</body>

</html>
