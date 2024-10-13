<?php
session_start();

// Include the database connection code
$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'account';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in as an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: account.php");
    exit();
}

// Check if the connection is valid
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve user data
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Delete user logic
if (isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];
    $sqlDelete = "DELETE FROM users WHERE user_id = $userId";
    $conn->query($sqlDelete);
    // Redirect to refresh the page after deletion
    header("Location: manage_users.php");
    exit();
}

// Logout logic
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: account.php");
    exit();
}

// Close the database connection at the end of your script, after fetching results
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your styles and any other head elements -->
    <style>
        
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        form {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }
    </style>
   
</head>

<body>

    <header>
        <h1>Manage Users (Admin)</h1>
    </header>

    <main>
        <h2>User Management</h2>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display user data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>
                            <form method='post' action=''>
                                <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                                <button type='submit' name='delete_user'>Delete</button>
                            </form>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Logout and Account buttons -->
        <form method="post" action="">
            <button type="submit" name="logout">Logout</button>
        </form>
        <!-- <a href="account.php">Account</a> -->
    </main>

    <footer>
        <!-- Include your footer content -->
    </footer>

</body>

</html>
