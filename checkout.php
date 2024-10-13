<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to account.php
    header("Location: account.php");
    exit();
}
?>

<?php include('header.php'); ?>
<?php include('function.php');?>

<!-- checkout.php -->
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

// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
$username = $_SESSION['username'];
// Function to process and save order details to the 'submit' table
function processOrder($postData, $conn) {
    // Get order details from the form data
    $name = sanitizeInput($postData['username']);
    $email = sanitizeInput($postData['email']);
    $mobile = sanitizeInput($postData['mobile']);
    $address = sanitizeInput($postData['address']);
    $orderTotal = sanitizeInput($postData['orderTotal']); // Added line to retrieve order total

    

    // Check if required fields are filled
    if (empty($name) || empty($email) || empty($mobile) || empty($address)) {
        echo "Please fill in all required fields.";
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !endsWith($email, '@gmail.com')) {
        echo "Invalid email address. Please use a valid Gmail address.";
        // Optionally, you can redirect the user back to the signup form or handle the error in another way
        exit();
    }
    $mobileRegex = '/^[0-9]{10}$/';
    if (!preg_match($mobileRegex, $mobile)) {
        echo "Invalid mobile number";
        // Optionally, you can redirect the user back to the signup form or handle the error in another way
        exit();
    }
     

    // Insert order details into the 'submit' table
    $sql = "INSERT INTO submit (name, email, mobile, address) VALUES ('$name', '$email', '$mobile', '$address')";
    $success = $conn->query($sql);

    if ($success) {
        // Get the order_id of the recently inserted order
        $order_id = $conn->insert_id;

        // Assuming you store items as JSON in the session
        $cartItems = isset($_SESSION['cartItems']) ? $_SESSION['cartItems'] : [];

        $totalAmount = calculateTotalAmount($conn, $cartItems);

        // Insert into orders table
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

        // Check if the username is valid
        if (!$username) {
            echo "Invalid user.";
            return false;
        }

        // Get the user_id based on the provided username
        $getUserIDQuery = "SELECT user_id FROM users WHERE username = '$username' LIMIT 1";
        $userResult = $conn->query($getUserIDQuery);

        if ($userResult && $userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $user_id = $userRow['user_id'];

            // Insert into orders table with user_id and order total
            $sqlOrders = "INSERT INTO orders (username, total_amount, user_id) VALUES ('$username', '$orderTotal', '$user_id')";
            $successOrders = $conn->query($sqlOrders);

            if ($successOrders) {
                // Set order summary in session
                $_SESSION['order_summary'] = [
                    'order_id' => $order_id,
                    'total_amount' => $totalAmount,
                ];

                // Clear cartItems from session
                unset($_SESSION['cartItems']);

                sendOrderConfirmationEmail($email, $order_id, $totalAmount);

                return true;
            } else {
                // Handle the case where order processing failed
                echo "Order processing failed. Please try again.";
                return false;
            }
        } else {
            // Handle the case where user lookup failed
            echo "Failed to retrieve user information.";
            return false;
        }
    } else {
        // Handle the case where order processing failed
        echo "Order processing failed. Please try again.";
        return false;
    }
}



function calculateTotalAmount($conn, $orderItems) {
    $totalAmount = 0;

    foreach ($orderItems as $item) {
        $productName = $item['name'];
        $price = $item['price'];

        // Ensure the price is a valid number
        if (is_numeric($price)) {
            $totalAmount += $price;
        } else {
            echo "Invalid price for product '$productName'.";
        }
    }

    return $totalAmount;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have set $_SESSION['cartItems'] before
    $cartItems = isset($_SESSION['cartItems']) ? $_SESSION['cartItems'] : [];

    // Validate and process the order
    $orderSuccess = processOrder($_POST, $conn);

    if ($orderSuccess) {
        // Order processed successfully, you might redirect to a confirmation page
        header("Location: confirmation.php");
        exit();
    } else {
        // Order processing failed, you might show an error message
        $errorMessage = "Order processing failed. Please try again.";
        echo $errorMessage;
    }
}

function addToCart($productName, $price) {
    // Retrieve the existing cart items from the session
    $cartItems = isset($_SESSION['cartItems']) ? $_SESSION['cartItems'] : [];

    // Add the new item to the cart
    $cartItems[] = ['name' => $productName, 'price' => $price];

    // Update the cart items in the session
    $_SESSION['cartItems'] = $cartItems;
}

$conn->close();
?>

<!-- // Rest of your existing code


    
    // You might redirect the user or perform other actions
    // 
// // Close the connection after all queries are executed


 
// // ... (your existing code)

// // After successfully inserting order details into the 'submit' table

// // Get the order_id of the recently inserted order
// $order_id = $conn->insert_id;

// // Loop through cart items and insert into order_items table
// $cartItems = [];
// foreach ($cartItems as $item) {
//     $productName = $item['name'];
//     $price = $item['price'];
//     // You need to modify this based on your logic

//     // Insert item into order_items table
//     $itemSql = "INSERT INTO order_items ( product_name, price,) VALUES ( '$productName', '$price')";
//     $conn->query($itemSql);
// }
// $conn->close();
// // ... (rest of your code)  -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Ecommerce Website Design</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
           
            background-size: cover;
            background-position: center;
        }
    
        .header{
            background-image: url("images/pexels-pixabay-264787.jpg") ;
            
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
    
        .containercheck {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
        form {
            display: flex;
            flex-direction: column;
            background: radial-gradient(#fff,#abd0f6);
            padding: 20px;
            border-radius: 8px;
        }
    
        h1 {
            text-align: center;
            color: #f55353;
            margin-bottom: 20px;
        }
    
        input,
        textarea {
            margin: 10px 0;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: rgb(237, 231, 231);
            color: #373535;
            font-size: 16px;
        }
    
        button {
            background: #e3536b;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
    
        button:hover {
            background-color: #b37070;
        }
    
        .check,
        .cancel {
            text-align: center;
            margin-top: 20px;
        }
    
        .check button {
            background-color: #120779;
        }
    
        .check button:hover {
            
            background:#859ed8;
        }
    
        /* Styles for Cancel button */
        .cancel button {
            background-color: #f44336;
            margin-bottom: 20px;
        }
    
        .cancel button:hover {
            background-color: #d32f2f;
        }
    
        /* Order Summary Styles */
        #orderSummary {
            margin-top: 20px;
            padding: 20px;
            border: 2px solid #e3536b;
            border-radius: 8px;
            background: #fff;
            color: #373535;
        }
      
        h2{
            text-align: center;
            color: #f55353;
            margin-bottom: 5px;
            font-size: 25px;
        }
        #orderSummary p {
            margin: 10px 0;
            font-size: 16px;
        }
    </style>
    
    
</head>

<body>
    <div class="header">
     
        <div class="containercheck">
            <form id="checkoutForm" method= "post" action="">
                <h1>Checkout</h1>
        
                <!-- User Information -->
                <<label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
                <input type="text" name="email" id="email" placeholder="email" autocomplete="email">

                <input type="tel" name="mobile" id="mobile" placeholder="mobile" autocomplete="mobile">
                <textarea name="address" id="address" placeholder = "address" autocomplete="address"></textarea>

        
                <h2>Order Summary</h2>
                <!-- Order Summary -->
                        <div id="orderSummary">
                        
               <!-- Order summary content will be dynamically added here -->
                        </div>



                <!-- Checkout and Cancel buttons -->
                <div class="check">
                    <button type="button" onclick="placeOrder()">SUBMIT</button>
                </div>
        
                <div class="cancel">
                    <button type="button" onclick="cancel()">CANCEL</button>
                </div>
            </form>
        </div>

 

        <script>
            // Initialize an empty cartItems array
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        
            // Function to add an item to the cart
            function addToCart(productName, price) {
        //         let username = document.getElementById('username').value;
        // let email = document.getElementById('email').value;
        // let mobile = document.getElementById('mobile').value;
        // let address = document.getElementById('address').value;

        // // Validate email using filter_var
        // if (!filter_var(email, FILTER_VALIDATE_EMAIL)|| !endsWith($email, '@gmail.com')) {
        //     alert("Invalid email address");
        //     return;}

                cartItems.push({ name: productName, price: price });
                updateOrderSummary();
            }
        
            // Function to remove an item from the cart
            function removeFromCart(index) {
                cartItems.splice(index, 1);
                updateOrderSummary();
            }
        
            // Function to update the order summary
            function updateOrderSummary() {
                let orderSummary = document.getElementById('orderSummary');
        
                // Clear existing content
                orderSummary.innerHTML = '';
        
                // Display order summary
                if (cartItems.length > 0) {
                    let total = 0;
        
                    // Create a list of items in the order summary
                    let ul = document.createElement('ul');
                    cartItems.forEach((item, index) => {
                        let li = document.createElement('li');
                        li.textContent = `${item.name} - Rs.${item.price}`;
                        ul.appendChild(li);
        
                        // Calculate the total price
                        total += item.price;
                    });
        
                    // Display the list and total in the order summary
                    orderSummary.appendChild(ul);
        
                    // Display total price
                    let totalElement = document.createElement('p');
                    totalElement.textContent = `Total: Rs.${total}`;
                    orderSummary.appendChild(totalElement);

                    // Create a hidden input field to store the total amount
                let hiddenTotalInput = document.createElement('input');
                hiddenTotalInput.type = 'hidden';
                hiddenTotalInput.name = 'orderTotal';  // This will be the key used on the server-side
                hiddenTotalInput.value = total;
                orderSummary.appendChild(hiddenTotalInput);
                } else {
                    // Display a message when the cart is empty
                    let emptyMessage = document.createElement('p');
                    emptyMessage.textContent = 'Your cart is empty.';
                    orderSummary.appendChild(emptyMessage);
                }
        
                // Update local storage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }
        
            function placeOrder() {
                // Perform any necessary actions before submitting the order
                // For example, you might want to validate the form inputs
        //         let username = document.getElementById('username').value;
        // let email = document.getElementById('email').value;
        // let mobile = document.getElementById('mobile').value;
        // let address = document.getElementById('address').value;

        // // Validate email using filter_var
        // if (!filter_var(email, FILTER_VALIDATE_EMAIL)|| !endsWith($email, '@gmail.com')) {
        //     alert("Invalid email address");
        //     return;}

                // Update the order summary before submitting
                updateOrderSummary();
        
                // After validation and updating the order summary, you can submit the form
                document.getElementById('checkoutForm').submit();
                resetCart();
            }
        
            function resetCart() {
    // Clear cartItems in both session and localStorage
    localStorage.removeItem('cartItems');
    cartItems = [];
    
    // Update the cart icon to show 0 items
    updateCartIcon();
}

function updateCartIcon() {
    // You need to implement the logic to update the cart icon
    // This might involve updating the displayed count or hiding the icon if there are no items
    // For example, you could set the content of an element with an ID like 'cartItemCount' to 0
    document.getElementById('cartItemCount').textContent = 0;
}
            function cancel() {
                // Redirect back to the dashboard or wherever you want
                window.location.href = "product.php";
            }
        
            // Initial update to set the order summary
            updateOrderSummary();
        </script>
        

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-col-1">
                        <h3>USEFUL LINKS</h3>
                        <a href="#">About |</a>
                        <a href="#">Contact |</a>
                        <a href="#">Products</a>
                    </div>

                    <div class="footer-col-2">
                        <img src="images/UniCraft.png">
                        <p>Our purpose is to sustainably make the pleasure and benefits to the university students.</p>
                    </div>

                    <div class="footer-col-3">
                        <h3>CONTACT</h3>
                        <p>070-582-4289: Jayathi
                            <br>076-381-9762: Isuru <br> unicraftwaya@gmail.com</p>
                    </div>
                </div>

                <hr>
                <p class="copyright">Copyright@2023</p>
            </div>
        
    </div>
</body>

</html>