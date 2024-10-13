
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

?>
<?php


// Fetch product data from the database
$sql = "SELECT * FROM items";

if (isset($_GET['category']) && $_GET['category'] != 'all') {
    $category = $_GET['category'];
    $sql .= " WHERE item_category = '$category'";
}

// Add filters based on price range
if (isset($_GET['price']) && $_GET['price'] != 'all') {
    $priceRange = explode('-', $_GET['price']);
    $minPrice = $priceRange[0];
    $maxPrice = $priceRange[1];

    // Check if WHERE or AND is needed
    $sql .= isset($_GET['category']) ? " AND" : " WHERE";
    $sql .= " item_price BETWEEN $minPrice AND $maxPrice";
}

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display each product dynamically
        // Similar to the code you provided earlier
    }
} else {
    echo 'No products available.';
}

// Rest of your HTML and other code...
?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> All Products -UniCraft </title>
    <link rel = "stylesheet" href = "style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- product.php -->

<?php include('header.php'); ?>

<!-- Rest of your product page content goes here -->


<style>
    
.productbg{
    background: radial-gradient(#fff,#efe0ec);
}
.small-container{
    max-width:1080px;
    margin:auto;
    padding-left: 25px;
    padding-right: 25px;
    margin-top: 20px;

}

.col-4{
    flex-basis:25%;
    padding : 10px;
    min-width: 200px;
    margin-bottom: 50px;
    transition: transform 0.5s;
    background: radial-gradient(#fff,#f1b9e4);
}

.col-4 img{
    width:100%;
}

.title{
    text-align : center;
    font-size:50px;
    margin: 0 auto 80px;
    position: relative;
    line-height: 80px;
    color: black;
}

.title::after{
    content:'';
    background: #DF4DB0;
    width:400px;
    height:5px;
    border-radius: 5px;
   position: absolute;
   bottom:0;
   left:50%;
   transform: translateX(-50%);
}


h4{
    color: #5d3450;
    font-weight:normal;

}
.col-4 price{
    font-size: 14px;
    
}
.rating .fa{
    color:#ff523b;
}

.col-4:hover{
    transform: translateY(-5px)
}

.filter-options #price-filter {
    text-align: left;
    color: #0e0d0d;
    background: radial-gradient(#fff,#f1b9e4);
}

.filter-options #category-filter {
    text-align: left;
    color: #0e0d0d;
    background: radial-gradient(#fff,#f1b9e4);
}

.filter-options {
    margin-bottom: 50px;
    text-align: left;
}

.filter-options label, .filter-options select {
    margin-right: 10px;
    color:#f7efef;
}

.filter-options select {
    padding: 8px;
    border: 1px solid #d31b55;
    border-radius: 4px;
}

.filter-options select:focus {
    outline: none;
    border-color: #DF4DB0;
}

.filter-options label {
    font-weight: bold;
    color: #555;
}

.filter-options select {
    color: #333;
}

.filter-options select option {
    color: #333;
}

.btn-filter {
    display: inline-block;
    background: #DF4DB0;
    color: #323030;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.5s;
}

.btn-filter:hover {
    background: #563434;
}

.row {
    margin-bottom: 20px;
}

.col-4 {
    transition: transform 0.5s;
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
    
   <div class = "productbg">
    <div class="container">
       
       

    </div>

   
    
   
        <div class = "small-container">
            <h2 class = "title"> All Products</h2>
            
            <!-- <div class="search">
                <input type = "text" name = "" id="find" placeholder="
                Search Here....." onkeyup="search()">
            </div> -->

<!-- Add these above your product list -->
<select id="category-filter" onchange="filterProducts()">
        <option value="all" <?php echo (!isset($_GET['category']) || $_GET['category'] == 'all') ? 'selected' : ''; ?>>All Categories</option>
        <option value="birthday" <?php echo (isset($_GET['category']) && $_GET['category'] == 'birthday') ? 'selected' : ''; ?>>Birthday</option>
        <option value="gift-box" <?php echo (isset($_GET['category']) && $_GET['category'] == 'gift-box') ? 'selected' : ''; ?>>Gift Box</option>
        <option value="coconut-shell" <?php echo (isset($_GET['category']) && $_GET['category'] == 'coconut-shell') ? 'selected' : ''; ?>>Coconut Shell Products</option>
        <option value="graduation-toys" <?php echo (isset($_GET['category']) && $_GET['category'] == 'graduation-toys') ? 'selected' : ''; ?>>Graduation Toys</option>
    </select>

    <select id="price-filter" onchange="filterProducts()">
        <option value="all" <?php echo (!isset($_GET['price']) || $_GET['price'] == 'all') ? 'selected' : ''; ?>>All Prices</option>
        <option value="0-100" <?php echo (isset($_GET['price']) && $_GET['price'] == '0-100') ? 'selected' : ''; ?>>Rs.0 - Rs.100</option>
        <option value="101-500" <?php echo (isset($_GET['price']) && $_GET['price'] == '101-500') ? 'selected' : ''; ?>>Rs.101 - Rs.500</option>
        <option value="501-1000" <?php echo (isset($_GET['price']) && $_GET['price'] == '501-1000') ? 'selected' : ''; ?>>Rs.501 - Rs.1000</option>
    </select>



            <div class = "row">
            <?php
        // Assuming you have a database connection already established

        // Fetch product data from the database
        $sql = "SELECT * FROM items";
        $result = $conn->query($sql);

        if (isset($_GET['category']) && $_GET['category'] != 'all') {
            $category = $_GET['category'];
            $sql .= " WHERE item_category = '$category'";
        }
        
        
        if (isset($_GET['price']) && $_GET['price'] != 'all') {
            $priceRange = explode('-', $_GET['price']);
            $minPrice = $priceRange[0];
            $maxPrice = $priceRange[1];
        
            // If there was a category filter, use AND, otherwise use WHERE
            $sql .= isset($_GET['category']) ? " AND item_price BETWEEN $minPrice AND $maxPrice" : " WHERE item_price BETWEEN $minPrice AND $maxPrice";
        }
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Display each product dynamically
                echo '<div class="col-4" data-category="' . $row['item_category'] . '" data-price="' . $row['item_price'] . '">';
                echo '<img src="' . $row['item_image'] . '">';
                echo '<h4>' . $row['item_name'] . '</h4>';
                echo '<p> Rs.' . $row['item_price'] . '</p>';
                echo '<button class="btn" onclick="addToCart(\'' . $row['item_name'] . '\', ' . $row['item_price'] . ', \'' . $row['item_image'] . '\')">Add to Cart</button>';
                echo '</div>';
            }
        } 
         ?>
             

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

        
        <script>
            updateCartItemCount();
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

// function checkout() {
//     // Add logic for checkout if needed
//     alert('Checkout functionality can be added here.');
// }

// Function to initialize the cart details on page load
function initializeCart() {
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    
    // Update the cart item count
    updateCartItemCount(cartItems.length);
}

// Call the function on page load
window.onload = initializeCart;

function cancelCheckout() {
    // Clear the cart and close the popup
    localStorage.removeItem('cartItems');
    document.getElementById('cartItems').innerHTML = '';
    closeCartPopup();
    updateCartItemCount(0);
}

function updateCartItemCount(count) {
    // Update the cart item count
    document.getElementById('cartItemCount').innerText = count || 0;
}
updateCartItemCount(JSON.parse(localStorage.getItem('cartItems')).length || 0);
// Initial update to set the cart count to 0

        </script>
        
    
        
        <script>
function filterProducts() {
    var category = document.getElementById("category-filter").value;
    var price = document.getElementById("price-filter").value;

    // Redirect to the same page with the selected filters as query parameters
    window.location.href = 'product.php?category=' + category + '&price=' + price;
}




</script>

        

       <!--------Footer------->

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
