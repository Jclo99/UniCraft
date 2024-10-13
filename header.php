
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="navbar">
        <div class="logo">
            <img src="images/UniCraft.png" width="200px">
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="product.html">Products</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="account.html">Account</a></li>
            </ul>
        </nav>
        <a href="#" onclick="toggleCartPopup()">
            <img src="images/cart.png" width="30px" height="30px">
            <span id="cartItemCount">0</span>
        </a>
    </div>

    <script>
        // Function to get cart item count from local storage
        function getCartItemCount() {
            var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            return cartItems.length;
        }

        function toggleCartPopup() {
            var cartPopup = document.getElementById('cartPopup');
            if (cartPopup.style.display === 'block') {
                cartPopup.style.display = 'none';
            } else {
                cartPopup.style.display = 'block';
                // You may want to load the cart items into the popup here
            }
        }

        // Update cart item count initially
        document.getElementById('cartItemCount').innerText = getCartItemCount();
    </script>
</body>

</html>
