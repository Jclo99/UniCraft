

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Update Account</title>
    <link rel = "stylesheet" href = "style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel ="stylesheet" href = "https://stackpath.bootstrapcdn.com/font-
awesome/4.7.0/css/font-awesome.min.css">

 
 


<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: account.php");
    exit();
}

?>

<style>
        /* ... (your existing styles) ... */
    
        .navbar {
            background-color: #343a40;
            padding: 10px 0;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }

        .navbar li {
            margin-right: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .navbar a:hover {
            color: #ffc107;
        }

        
        .account-details-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 80px;
            max-width: 600px;
            margin: 0 auto;
        }

        .account-details-section h2 {
            text-align: center;
            color: #333;
        }

        .account-details-form {
            margin-top: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        .account-details-form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .account-details-form button {
            background-color: #DF4DB0;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .account-details-form button:hover {
            background-color: #701414;
        }

        .acc_page{
            background: radial-gradient(#fff,#f1b9e4);
        }
    </style>

<body>
<div class= acc_page>
<div class="navbar">
    <nav>
        <ul>
            <li><a href="dashboard.php">Account</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</div>

    <div class="account-details-section">
        <h2>Account Details</h2>

        <div class="account-details-form">
        <?php
                // Display a success message if the account is updated
                if (isset($_GET['success']) && $_GET['success'] == 'true') {
                    echo '<p style="color: green;">Account updated successfully!</p>';
                }
                ?>
            <!-- Form to display and update user details -->
            <form action="update_account.php" method="post">
            <span class="form-label">Username:</span>
                <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" readonly>

                <span class="form-label">Email:</span>
                <input type="email" id="email" name="email" placeholder="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                <span class="form-label">New Password:</span>
                 <input type="password" id="new_password" name="new_password" placeholder="Enter new password">

                  <span class="form-label">Confirm Password:</span>
                  <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">

                <button type="submit" name="update">Update Account</button>
            </form>
        </div>
    </div>
 <!----Footer-->
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

    </div>

  </body>
    </html>
