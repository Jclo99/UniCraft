<?php
// Database connection parameters
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

// Start the session
session_start();

// $username = $_POST['username'];
// $password = $_POST['password'];

// Query to check the credentials and retrieve the user ID
$sql = "SELECT user_id FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Fetch the user ID from the result
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];

        // After successful login, set the user ID in the session
        $_SESSION['user_id'] = $userId;

        // Redirect to item.php or any other page
        header("Location: item.php");
        exit();
    } 
} else {
    // Error in the query
    echo "Error executing the login query: " . $stmt->error;
}

$stmt->close();


// Function to add item to the database
function addItemToDatabase($conn, $userId, $itemName, $itemPrice, $itemCategory, $itemImage) {
    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO items (user_id, item_name, item_price, item_category,item_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in prepare statement: " . $conn->error);
    }

    $stmt->bind_param("issss", $userId, $itemName, $itemPrice, $itemCategory,$itemImage);

    if ($stmt->execute()) {
        echo "Item added successfully";
    } else {
        die("Error adding item to database: " . $stmt->error);
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_item'])) {
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];
    $itemCategory = isset($_POST['item_category']) ? $_POST['item_category'] : '';

    // Handle file upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["item_image"]["name"]);
    
    if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $targetFile)) {
        // File uploaded successfully, now insert item details into the database
        addItemToDatabase($conn, $_SESSION['user_id'], $itemName, $itemPrice, $itemCategory, $targetFile);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>


<!-- HTML Form for Adding Item -->
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Add Item </title>
    <link rel = "stylesheet" href = "style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel ="stylesheet" href = "https://stackpath.bootstrapcdn.com/font-
awesome/4.7.0/css/font-awesome.min.css">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: radial-gradient(#fff,#f1b9e4);
    }

    .add-item-form {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        font-size: 16px;
        color: #333;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    button {
        background-color: #DF4DB0;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #701414;
    }

    .footer {
        background-color: #333;
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer a {
        color: #fff;
        text-decoration: none;
        margin: 0 10px;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .footer hr {
        margin: 10px 0;
        border: none;
        border-top: 1px solid #fff;
    }

    .copyright {
        margin-top: 10px;
        font-size: 14px;
    }
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

</style>

</head>
<body>
<div class="navbar">
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Account</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</div>
    <!-- Add Item Form -->
    <div class="add-item-form">
    <h2>Add Item</h2>
    <form method="post" action="" enctype="multipart/form-data">

        <label for="category-filter">Item Category:</label>
        <select id="category-filter" name="item_category" onchange="filterProducts()">
            <option value="">All Category</option>
            <option value="birthday">Birthday Card</option>
            <option value="gift_box">Gift Box</option>
            <option value="coconut_shell_products">Coconut Shell Products</option>
            <option value="graduation_toys">Gift Toys</option>
            <!-- Add more categories as needed -->
        </select>

        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required>

        <!-- <label for="item_description">Item Description:</label>
        <textarea id="item_description" name="item_description" required></textarea> -->

        <label for="item_price">Item Price:</label>
        <input type="number" id="item_price" name="item_price" required>

        <!-- <label for="item_image">Item Image:</label>
        <input type="file" id="item_image" name="item_image" accept="image/*" required> -->

        <label for="item_image">Item Image:</label>
        <input type="file" id="item_image" name="item_image" accept="image/*" required>

        <button type="submit" name="add_item">Add Item</button>

    </form>
</div>

<!-- <script>
    function validateForm() {
        // Perform client-side validation if needed
        // Return true to submit the form, or false to prevent submission
        return true;
    }
</script> -->
 

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
