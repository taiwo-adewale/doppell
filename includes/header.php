<div id="header-container">
    <header>
        <!-- LOGO -->
        <a href="index.php"><img src="images/doppell-logo.png" alt="Doppell Logo"></a>
        <!-- NAVIGATION -->
        <nav>
            <ul>
                <li class="has-dropdown">
                    <div class="dropdown-container">
                        <a href="index.php" class="active-page">Home<i class="fas fa-angle-down"></i></a>
                        <div class="nav-dropdown">
                            <a href="blog-posts.php">Blog</a>
                        </div>
                    </div>
                </li>
                
                <li class="shop has-dropdown">
                    <div class="dropdown-container">
                        <a href="shop.php">Shop<i class="fas fa-angle-down"></i></a>
                        <div class="nav-dropdown">
                            <?php foreach($categories as $category): ?>
                                <a href="categories.php?caname=<?php echo $category['cat_slug']; ?>"><?php echo $category['cat_name']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>

                <li class="has-dropdown">
                    <div class="dropdown-container">
                        <a href="cart.php">My Account<i class="fas fa-angle-down"></i></a>
                        <div class="nav-dropdown">
                            <a href="cart.php">Cart</a>
                            <a href="checkout.php">Checkout</a>
                            <a href="wishlist.php">Wishlist</a>
                            <a href="login.php?v=login">Login</a>
                            <a href="login.php?v=signup">Signup</a>
                        </div>
                    </div>
                </li>

                <li>
                    <a href="about.php">About Us</a>
                </li>

                <li>
                    <a href="contact.php">Contact</a>
                </li>

                <!-- SEARCH BAR -->
                <li class="has-dropdown">
                    <div class="search-bar dropdown-container">
                        <a href=""><i class="fas fa-search"></i></a>
                        <div class="nav-dropdown">
                            <form action="shop.php" id="search-form" method="GET">
                                <input type="search" name="search" placeholder="Search...">
                                <button type="submit" name="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- CART -->
        <div class="cart has-dropdown">
            <div class="dropdown-container">
                <a href="cart.php">
                    <div>
                        <!-- php here -->
                        <p>Cart / <p id="totals"></p></p>
                        <div class="cart-items">
                            <div><span id="cart-count">0</span></div>
                        </div>
                    </div>
                </a>

                <div class="nav-dropdown cart-dropdown">
                    <ul id="cart-menu">
                        
                    </ul>
                    <p>Subtotal: <span id="total"></span></p>
                    <div class="cart-buttons">
                        <a href="cart.php">view cart</a>
                        <a href="checkout.php">checkout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MOBILE HAMBURGER ICON -->
        <div id="mobile-hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </header>
</div>

<!-- MOBILE MENU -->
<div class="mobile-menu-container is-inactive">
    <div class="inner-container">
        <button id="mobile-menu-close"><i class="fas fa-x"></i></button>
        <div class="mobile-menu">
            <ul>
                <!-- SEARCH BAR -->
                <li class="search-bar">
                  <form action="shop.php" id="search-form" method="GET">
                    <input type="search" name="search" placeholder="Search...">
                    <button type="submit" name="submit"><i class="fas fa-search"></i></button>
                </form>
                </li>

                <!-- MOBILE NAV -->
                <li class="has-dropdown-mobile mobile-nav">
                    <a href="index.php" class="active-page">Home</a>
                    <button><i class="fas fa-angle-down"></i></button>
                    <div class="nav-dropdown-mobile is-hidden">
                        <a href="blog-posts.php">Blog</a>
                    </div>
                </li>

                <li class="shop has-dropdown-mobile mobile-nav">
                    <a href="shop.php">Shop</a>
                    <button><i class="fas fa-angle-down"></i></button>
                    <div class="nav-dropdown-mobile is-hidden">
                        <?php foreach($categories as $category): ?>
                            <a href="categories.php?caname=<?php echo $category['cat_slug']; ?>"><?php echo $category['cat_name']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>

                <li class="has-dropdown-mobile mobile-nav">
                    <a href="cart.php">My Account</a>
                    <button><i class="fas fa-angle-down"></i></button>
                    <div class="nav-dropdown-mobile is-hidden">
                        <a href="cart.php">Cart</a>
                        <a href="checkout.php">Checkout</a>
                        <a href="wishlist.php">Wishlist</a>
                        <a href="login.php?v=login">Login</a>
                        <a href="login.php?v=signup">Signup</a>
                    </div>
                </li>

                <li class="mobile-nav">
                    <a href="about.php">About Us</a>
                </li>

                <li class="mobile-nav">
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</div>