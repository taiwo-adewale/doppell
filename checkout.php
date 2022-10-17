<?php

  include("config/session.php");
  $conn = $pdo->open();

  if(!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Sorry, you have to login to checkout";
    header('location: index.php');
  } else {
    $user = $_SESSION['user']['user_id'];

    $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on cart.prd_id = products.prd_id  WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $user]);
    $cart_items = $stmt->fetchAll();
  }

  include('config/fetch.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link rel="icon" href="images/favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="images/favicon-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon" href="images/favicon-180x180.png">
    <!-- HEADER & FOOTER CSS -->
    <link rel="stylesheet" href="styles/header-and-footer.css?v=<?php echo time(); ?>"/>
    <!-- PAGE CSS -->
    <link rel="stylesheet" href="styles/checkout.css?v=<?php echo time(); ?>"/>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="vendor/fontawesome-free-6.1.2-web/css/all.min.css">

    <title>Checkout- Doppell</title>
    
</head>
<body>

    <?php include('includes/header.php'); ?>
    
    <main>
        <section class="checkout-breadcrumbs">
            <div class="container">
                <nav class="breadcrumbs">
                    <a href="cart.php">Shopping Cart</a>
                    <span class="divider hide-for-small"><i class="fas fa-angle-right"></i></span>
                    <a href="checkout.php" class="current">Checkout details</a>
                    <span class="divider hide-for-small"><i class="fas fa-angle-right"></i></span>
                    <a href="">Order Complete</a>
                </nav>
            </div>
        </section>

        <section class="checkout-main">
            <div class="container">
                <div class="coupon">
                    <div class="coupon-text">
                        <p>Have a coupon? <span class="show-coupon">Click here to enter your code</span></p>
                    </div>
                    <form action="" class="checkout-coupon hidden form">
                        <p>If you have a coupon code, please apply it below.</p>
                        <div class="checkout-coupon-form">
                            <div>
                                <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code" id="coupon_code">
                            </div>
                            <div>
                                <button type="submit" class="" name="apply_coupon" value="Apply coupon">Apply coupon</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="checkout-form">
                    <form action="" class="form">
                        <h3>Billing details</h3>
                        <div class="first-name">
                            <label for="first_name">First name <span class="required">*</span></label>
                            <input type="text" name="first_name" id="first_name">
                        </div>
                        <div class="last-name">
                            <label for="last_name">Last name <span class="required">*</span></label>
                            <input type="text" name="last_name" id="last_name">
                        </div>
                        <div>
                            <label for="company_name">Company name (optional)</label>
                            <input type="text" name="company_name" id="company_name">
                        </div>
                        <div>
                            <label for="country">Country / Region <span class="required">*</span></label>
                            <input type="text" name="country" id="country" placeholder="Nigeria">
                        </div>
                        <div class="address">
                            <label for="address">Street address <span class="required">*</span></label>
                            <input type="text" name="street_name" id="street_name" placeholder="House number and street name">
                        </div>
                        <div class="apartment">
                            <label for=""></label>
                            <input type="text" name="apartment_name" id="apartment_name" placeholder="Apartment, suite, unit, etc. (optional)">
                        </div>
                        <div>
                            <label for="city">Town / City <span class="required">*</span></label>
                            <input type="text" name="city" id="city">
                        </div>
                        <div>
                            <label for="state">State / County <span class="required">*</span></label>
                            <input type="text" name="state" id="state">
                        </div>
                        <div>
                            <label for="postcode">Postcode / ZIP <span class="required">*</span></label>
                            <input type="number" name="postcode" id="postocode">
                        </div>
                        <div>
                            <label for="phone">Phone <span class="required">*</span></label>
                            <input type="tel" name="phone" id="phone">
                        </div>
                        <div>
                            <label for="email">Email address <span class="required">*</span></label>
                            <input type="email" name="email" id="email">
                        </div>

                        <h3>Additional information</h3>
                        <div class="additional-info">
                            <label for="additional_info">Order notes (optional)</label>
                            <textarea name="additional_info" id="additional_info" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </form>
                </div>

                <div class="checkout-details">
                    <div class="inner-col">
                        <h3>Your order</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($cart_items as $cart_item): ?>

                                    <tr class="cart-item">
                                        <td class="product-name">
                                            <?php echo $cart_item['prd_name']; ?><span class="product-quantity">× <?php echo $cart_item['quantity']; ?></span>
                                        </td>
                                        <td class="product-total">
                                            <span class="product-total-price"><?php $subtotal = $cart_item['prd_price'] * $cart_item['quantity'] ; echo '₦' . number_format($subtotal, 2); ?></span>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>

                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td><span class="subtotals"></span></td>
                                </tr>
                                
                                <tr class="order-total">
                                    <th>Total</th>
                                    <td><span class="subtotals"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <p>Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.</p>
                        <form action="">
                            <label><input type="checkbox"> I would like to receive exclusive emails with discounts and product information (optional)</label>
                        </form>
                        <button type="submit">Place order</button>
                        <p class="privacy-policy">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="" target="_blank">privacy policy</a>.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <script>
        const openCoupon = $('.checkout-main .coupon-text span.show-coupon');
        const couponContainer = $('.checkout-main .checkout-coupon');

        openCoupon.click(function() {
            couponContainer.toggleClass('hidden');
        })
    </script>

</body>
</html>