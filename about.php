<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> About Us Page </title>
    <link rel = "stylesheet" href = "style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel ="stylesheet" href = "https://stackpath.bootstrapcdn.com/font-
awesome/4.7.0/css/font-awesome.min.css">

<style>
    /* About */

.heading{
    width:90%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
    margin: 10px auto;
    margin-top: 3px;

}

.heading h1{
   
    font-size: 50px;
    color:#000;
    margin-bottom: 30px;
    position: relative;
    margin-top: 20px;
}

.heading h1::after{
    content: "";
    position: absolute;
    width: 100%;
    height: 4px;
    display: block;
    margin: 0 auto;
    background-color: #DF4DB0;
}

.heading p{
    font-size: 18px;
    color:#666;
    margin-bottom: 35px;
    
}

.containerabt
{
    width:90%;
    margin: 0 auto;
    padding: 10px 20px;
    
}

.about{
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    
}

.about-image{
    flex: 1;
    margin-right: 40px;
    overflow: hidden;
}

.about-image img{
    max-width: 100%;
    height: auto;
    display: block;
    transition: 0.5s ease;
}

.about-image:hover img{
    transform: scale(1.2);
}

.about-content{
    flex:1;

}
.about-content h2{
    font-size: 23;
    margin-bottom: 15px;
    color:#333;
}

.about-content p{
    font-size: 18px;
    line-height: 1.5;
    color: #333;
    
    
    
}

 .extra{
    display: none;
}

 .orginal{
    display:inline;
 }

 input[type="checkbox"]{
    height: 2em;
    display: block;
    appearance: none;
 }

 label{
    position: relative;
    padding: 1em;
    background-color: #DF4DB0;
    color: #fff;
    cursor: pointer;
    
 }

label::before{
    content: "Read More";
}

input[type="checkbox"]:checked ~ label::before{
    content:"Read less";

}

.dots:has(~ input[type="checkbox"]:checked)
{
    display: none;
}

.extra:has(~ input[type="checkbox"]:checked)
{
    display: inline;
}

.backabt{
   
    background: radial-gradient(#fff,#f1b9e4);
     
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
<div class = "backabt">

   
    

    <div class="heading">
        <h1>About Us</h1>
        <p> Explore a world of throughtful suprises and memorable moments</p>
    </div>
   
    <div class ="containerabt">
        <section class="about">
            <div class = "about-image">
                <img src = "images/pexels-alleksana-6478788.jpg">
            </div>

            <div class="about-content">
                <h2>Welcome To Our Website</h2>
                <p class ="orginal"> Welcome to UniCraft, your destination for unique handmade
                    treasures. our curated collection features birthday cards,
                    Coconut shell products, gift boxes and gift toys.Each crafted
                    with care and creativity.At Unicraft,we celebrate the artistry behind
                    everypiece,offering one of a kind items that bring joy to your
                    celebrations.
                </p>    
                <span class = "dots"></span>
                    <p class="extra">
                        <br><br>By chossing us you're not just purchasing products,you're supporting
                        skilled artisans and adding a touch of handcrafted charm to your life.
                        Explore UniCraft and Join Us in embracing the beauty of artisanal craftsmanship.
        
                    </p>
                <input type ="checkbox" id ="btn">
                <label for ="btn"> </label>
            </div>
        </section>
    </div>
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



     <!--------Footer------->

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
                    <br> 076-381-9762: Isuru <br> unicraftwaya@gmail.com</p>
                </div>
            </div>

            <hr>
            <p class ="copyright"> Copyright@2023 </p>
        </div>
</div>

</body>

</html>