<?php

    include("config/session.php");
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
    <link rel="stylesheet" href="styles/cart.css?v=<?php echo time(); ?>"/>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Cart- Doppell</title>
    
</head>
<body>

    <?php include('includes/header.php'); ?>
    
    <main>
        <section class="cart-breadcrumbs">
            <div class="container">
                <nav class="breadcrumbs">
                    <a href="cart.php" class="current">Shopping Cart</a>
                    <span class="divider hide-for-small"><i class="fas fa-angle-right"></i></span>
                    <a href="checkout.php">Checkout details</a>
                    <span class="divider hide-for-small"><i class="fas fa-angle-right"></i></span>
                    <a href="">Order Complete</a>
                </nav>
            </div>
        </section>

        <section class="cart-main">
            <div class="container">
                <div class="cart-details">
                    <form>
                        <table class="" cellspacing="0">
                            <thead> 
                                <tr>
                                    <th class="product-name" colspan="3">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>

		                    <tbody id="tbody">

					              </tbody>
	                    </table>
                    </form>
                </div>

                <div class="cart-sidebar">
                    <div class="cart-total">
                        <h2>cart totals</h2>
                        <div class="subtotal">
                            <p>Subtotal</p>
                            <span class="subtotals"></span>
                        </div>
                        <div class="total">
                            <p>Total</p>
                            <span class="subtotals"></span>
                        </div>
                        
                        <?php
                            if(isset($_SESSION['user'])){
                                echo "
                                    <a href='checkout.php'>proceed to checkout</a>
                                ";
                            }
                            else{
                                echo "
                                <p>You need to <a href='login.php?v=login'>login</a> to checkout.</p>
                                ";
                            }
                        ?>

                    </div>

                    <form action="" class="coupon">
                        <h3><i class="fas fa-tag"></i>Coupon</h3>
                        <input type="text" name="" id="" placeholder="Coupon Code">
                        <input type="submit" value="Apply Coupon">
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <script>

        $(function(){

            $(document).on('click', '.increase', function(e){
                e.preventDefault();

                let overlay = $(this).parents('.hoc').find('.loading-overlay');
                overlay.removeClass('d-none');

                let id = $(this).data('id');
                let quantity = $(`.product-quantity input[type="number"][data-id='${id}']`).val();
                let stock = $(`.product-quantity input[type="hidden"][data-id='${id}']`).val();
                if( parseInt(quantity) < parseInt(stock) ) {
                    quantity++;
                }
                $(`.product-quantity input[type="number"][data-id='${id}']`).val(quantity);

                $.ajax({
                    type: 'POST',
                    url: 'cart_update.php',
                    data: {
                        id: id,
                        quantity: quantity,
                    },
                    dataType: 'json',
                    success: function(response){
                        if(!response.error){
                            getDetails();
                            getCart();
                            getTotal();
                            overlay.removeClass('d-none');
                        }
                    }
		        });
            });

            $(document).on('click', '.decrease', function(e){
                e.preventDefault();

                let overlay = $(this).parents('.hoc').find('.loading-overlay');
                overlay.removeClass('d-none');

                let id = $(this).data('id');
                let quantity = $(`.product-quantity input[type="number"][data-id='${id}']`).val();
                let stock = $(`.product-quantity input[type="hidden"][data-id='${id}']`).val();
                if( parseInt(quantity) > 1){
                    quantity--;
                }
                $(`.product-quantity input[type="number"][data-id='${id}']`).val(quantity);

                $.ajax({
                    type: 'POST',
                    url: 'cart_update.php',
                    data: {
                        id: id,
                        quantity: quantity,
                    },
                    dataType: 'json',
                    success: function(response){
                        if(!response.error){
                            getDetails();
                            getCart();
                            getTotal();
                            overlay.removeClass('d-none');
                        }
                    }
		        });
            });
        });
        
    </script>


</body>
</html>