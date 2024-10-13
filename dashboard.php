<?php
session_start();

// // Check if the user is not logged in
// if (!isset($_SESSION['username'])) {
//     // If not logged in, redirect to account.php
//     header("Location: account.php");
//     exit();
// }

// Rest of your existing code for dashboard.php
?>
<!-- product.php -->

<?php include('header.php'); ?>

<!-- Rest of your product page content goes here -->


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

 
 <?php include("connect.php"); 
 ?>




<style>
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

        
.cart-popup {
    display: none;
    position: fixed;
    z-index: 1;
    right: 0;
    top: 0;
    width: 300px;
    height: 100%;
    overflow: auto;
    
    background: radial-gradient(#fff,#efe0ec);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding-top: 20px;
}

.cart-content {
    margin: 0 auto;
    padding: 20px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #333;
    text-decoration: none;
}

#cartItems {
    list-style: none;
    padding: 0;
}

#cartItems li {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

#cartItems img {
    margin-right: 10px;
}

.btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #DF4DB0;
    color: #fff;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border: none;
    border-radius: 30px;
    transition: background 0.3s;
}

.btn:hover {
    background-color: #563434;
}
    </style>

</head>


<body>
    
   
   



<div class="my-account-section">
    <div class= "myacc">    
        <h2>My Account</h2>
           <div class="go-to-home">
             <p><a href="index.php"> Home</a> / My Account</p>
          </div>

    </div>      
        <p>Welcome to your Dashboard, <?php echo $_SESSION['username']; ?></p>
         <p> From your account dashboard you can view your recent orders, 
        manage your shipping and billing addresses, and edit your password and account details.
        </p>

    

        
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="account_details.php">Account Details</a></li>
                <!-- <li><a href="item.php">Listing Items</a></li> -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
</div>
<div id="cartPopup" class="cart-popup">
    <div class="cart-content">
        <span class="close" onclick="closeCartPopup()">&times;</span>
        <h2>Your Cart</h2>
        <ul id="cartItems"></ul>
        <a href="checkout.php">
                    <button class = "btn" onclick="checkout()"> Checkout</button>
                </a>
        <button class="btn cancel" onclick="cancelCheckout()">Cancel</button>
    </div>
</div>

    <!-- Add this script tag at the end of your body section -->
<!-- Add this script tag at the end of your body section -->
<script>
    function toggleCartPopup() {
        var cartPopup = document.getElementById('cartPopup');
        if (cartPopup) {
            var cartPopupStyle = window.getComputedStyle(cartPopup);
            if (cartPopupStyle.display === 'block') {
                cartPopup.style.display = 'none';
            } else {
                cartPopup.style.display = 'block';
                // You may want to load the cart items into the popup here
            }
        }
    }

    function addToCart(productName, price, imageSrc) {
        let cartItemsList = document.getElementById('cartItems');
        let li = document.createElement('li');
        li.innerHTML = `
            <img src="${imageSrc}" alt="${productName}" width="50">
            ${productName} - Rs.${price}
        `;
        cartItemsList.appendChild(li);
        
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        cartItems.push({ name: productName, price: price, imageSrc: imageSrc });
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        // Open the cart popup immediately after adding an item
        openCartPopup();
        updateCartItemCount();
    }

    function openCartPopup() {
        document.getElementById('cartPopup').style.display = 'block';
    }

    function closeCartPopup() {
        document.getElementById('cartPopup').style.display = 'none';
    }

    function initializeCart() {
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        
        // Update the cart item count
        updateCartItemCount(cartItems.length);
    }

    function cancelCheckout() {
        localStorage.removeItem('cartItems');
        document.getElementById('cartItems').innerHTML = '';
        closeCartPopup();
        updateCartItemCount(0);
    }
    function updateCartItemCount(count) {
        // Check if 'cartItems' exists in localStorage
        let cartItems = JSON.parse(localStorage.getItem('cartItems'));
        let itemCount = cartItems ? cartItems.length : 0;

        // Update the cart item count
        document.getElementById('cartItemCount').innerText = itemCount;
    }

    // Call the function on page load
    window.onload = function() {
        initializeCart();
        updateCartItemCount(); // No need to pass a count initially
    };
</script>


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
