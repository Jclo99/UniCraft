
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> UniCraft | Ecommerce Website Design</title>
    <link rel = "stylesheet" href = "style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel ="stylesheet" href = "https://stackpath.bootstrapcdn.com/font-
awesome/4.7.0/css/font-awesome.min.css">

<?php include('header.php'); ?>

<style>

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

.btn1 {
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

.btn1:hover {
    background-color: #563434;
}
</style>
</head>


<body>
    <div class="header">

        <div class="row">
            <div class = "col-2">
                <h1> Explore UniCraft For <br> Handcrafted Tresures</h1>
                <p> Success isn't always about greatness. It's about consistency. Consistent<br>hard work gains successs.
                    Greatness will.
                
                </p>
                <a href ="product.php" class = "btn"> Explore Now</a>
            </div>
            <div class = "col-2">
                <img src ="images/back.jpg" width= 700px height= 600px>
            </div>
        </div>

   
   

</div>
   <!-----featured categories------>
   <div class = "categories">
        <div class="small-container">
            <div class ="row">
                <div class = "col-3">
                    <img src = "images/hbd4.jpg">
                </div>
                <div class = "col-3">
                    <img src = "images/cc1.jpg">
                </div>
                <div class = "col-3">
                    <img src = "images/gb2.jpg">
                </div>
    
            </div>
        </div>
   </div>

   <!------featured products------>
        <div class = "small-container">
            <h2 class = "title"> Featured Products</h2>
            <div class = "row">
                <div class = "col-4">
                    <img src = "images/hbdf2.jpg" >
                    <h4> Birthday Card </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div> -->
                    <p> Rs.100.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/gb4.jpg">
                    <h4> Gift Box </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.500.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/cc5.jpg">
                    <h4> Cocount Shell Product </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.700.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/grad2.jpg">
                    <h4> Graduation Gift Toys </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.1000.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

               
            </div>
            <h2 class = "title"> Latest Products</h2>
            <div class = "row">
                <div class = "col-4">
                    <img src = "images/hbd5.jpg" >
                    <h4> Birthday Card </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div> -->
                    <p> Rs.100.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/cc9.jpg">
                    <h4> Coconut Shell Keytag </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.500.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/cc7.jpg">
                    <h4> Cocount Shell Product </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.700.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/gb3.jpg">
                    <h4> Gift Box </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.100.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/cc8.jpg">
                    <h4> Coconut Shell Keytag </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.100.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/cc10.jpg">
                    <h4> Coconut Shell Product </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.700.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/hbd1.jpg">
                    <h4> Birthday Card </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.150.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>

                <div class = "col-4">
                    <img src = "images/hb4.jpg">
                    <h4> Birthday Card </h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <p> Rs.150.00</p>
                    <a href ="" class = "btn"> Add to Cart</a>
                </div>
        </div>
    </div>
       <!---------Offer-------->
       <div class = "offer">
            <div class = "small-container">
                <div class ="row">
                    <div class="col-2">
                        <img src = "images/pexels-budgeron-bach-6532979.jpg "class = "offer-img">
                    </div>
                    <div class = "col-2">
                        <p> Exclusively Avalible on UniCraft</p>
                        <h1> Surprise Gift Box</h1>
                        <small> Surprise your loved ones with our elegant gift boxes,curated with care are 
                            filled with delightful products, making every moment special.
                        </small>
                        <!-- <a href=""class="btn">Buy Now &#8594;</a> -->
                        <button class="btn" onclick="addToCart('Surprise Gift Box', 1000,'images/pexels-budgeron-bach-6532979.jpg')">Buy Now</button> 
                        
                    </div>
                </div>
            </div>
       </div>
       <div id="cartPopup" class="cart-popup">
    <div class="cart-content">
        <span class="close" onclick="closeCartPopup()">&times;</span>
        <h2>Your Cart</h2>
        <ul id="cartItems"></ul>
        <a href="checkout.php">
                    <button class = "btn1" onclick="checkout()"> Checkout</button>
                </a>
        <button class="btn1 cancel" onclick="cancelCheckout()">Cancel</button>
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
                    <p> 070-582-4289:Jayathi
                    <br> 076-381-9762:Isuru <br> unicraftwaya@gmail.com</p>
                </div>
            </div>

            <hr>
            <p class ="copyright"> Copyright@2023 </p>
        </div>
    </div>
</header>
</body>

</html>
