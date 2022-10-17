<?php

  include("config/session.php");
  $conn = $pdo->open();

  if(!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Sorry, you have to login to view wishlist";
    header('location: index.php');
  }

  $user_id = $_SESSION['user']['user_id'];

  $stmt = $conn->prepare("SELECT * FROM wishlist LEFT JOIN products ON products.prd_id = wishlist.prd_id WHERE user_id= :user_id");
  $stmt->execute([':user_id' => $user_id]);
  $wishlist = $stmt->fetchAll();

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
    <link rel="stylesheet" href="styles/wishlist.css?v=<?php echo time(); ?>"/>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="vendor/fontawesome-free-6.1.2-web/css/all.min.css">

    <title>Wishlist - Doppell</title>
    
</head>
<body>

    <?php include('includes/header.php'); ?>
    
    <main>
        <div id="callout" class="container">
            <p class="callout-box">
                <span class="callout-icon"></span>
                <span class="callout-message first"></span>
            </p>
        </div>

        <section class="title">
            <div class="inner-col container">
                <h1>wishlist</h1>
            </div>
        </section>

        <section class="wishlist-main">
            <div class="container">
                <form action="">
                    <div class="wishlist-title">
                        <h2>My wishlist</h2>
                    </div>

                    <?php if(count($wishlist) > 0): ?>
                      <table class="hide-on-mobile">
                          <thead> 
                              <tr>
                                  <th class="product-name" colspan="3">Product Name</th>
                                  <th class="product-price">Unit Price</th>
                                  <th class="product-stock">Stock Status</th>
                                  <th></th>
                              </tr>
                          </thead>

                          <tbody>

                              <?php foreach($wishlist as $product): ?>
                                  <tr class="hoc">
                                      <td class="product-remove">
                                          <a href="" class="wishlist-delete" data-id="<?php echo $product['wishlist_id']; ?>">×</a>
                                      </td>

                                      <td class="product-thumbnail">
                                          <a href="product-details.php?prname=<?php echo $product['prd_slug']; ?>"><img src="images/<?php echo $product['prd_image']; ?>"></a>
                                      </td>

                                      <td class="product-name">
                                          <a href="product-details.php?prname=<?php echo $product['prd_slug']; ?>"><?php echo $product['prd_name']; ?></a>
                                      </td>

                                      <td class="product-price">
                                          <span><?php echo '₦' . number_format($product['prd_price'], 2); ?></span>
                                      </td>

                                      <td class="product-stock">
                                          <span>In stock</span>
                                      </td>

                                      <td class="add-to-cart">
                                          <form>
                                              <button type="submit" class="cart-add">add to cart</button>
                                              <input type="hidden" id="product_id" name="product_id" value="<?php echo $product['prd_id']; ?>">
                                              <input type="hidden" id="product_name" name="product_name" value="<?php echo $product['prd_name']; ?>">
                                          </form>
                                      </td>

                                      <td class='loading-overlay d-none'>
                                        <i class='fas fa-spinner fa-spin'></i>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>

                              
                          </tbody>
                      </table>

                      
                      <div class="mobile-wishlist">

                          <?php foreach($wishlist as $product): ?>
                              <div class="product hoc">
                                  <div class="product-thumbnail">
                                      <a href="product-details.php?prname=<?php echo $product['prd_slug']; ?>"><img src="images/<?php echo $product['prd_image']; ?>"></a>
                                  </div>

                                  <div class="product-info">
                                      <div class="product-name-box">
                                          <div class="product-name">
                                              <a href="product-details.php?prname=<?php echo $product['prd_slug']; ?>"><?php echo $product['prd_name']; ?></a>
                                          </div>
                                      </div>

                                      <div class="product-price-box">
                                          <div class="product-price-text">
                                              <p>Price:</p>
                                          </div>

                                          <div class="product-price">
                                              <span><?php echo '₦' . number_format($product['prd_price'], 2); ?></span>
                                          </div>
                                      </div>

                                      <div class="product-stock-box">
                                          <div class="product-stock-text">
                                              <p>Stock:</p>
                                          </div>

                                          <div class="product-price">
                                              <span>In stock</span>
                                          </div>
                                      </div>

                                      <div class="add-to-cart-box">
                                          <div class="add-to-cart">
                                              <form>
                                                  <button type="submit" class="cart-add">add to cart</button>
                                                  <input type="hidden" id="product_id" name="product_id" value="<?php echo $product['prd_id']; ?>">
                                                  <input type="hidden" id="product_name" name="product_name" value="<?php echo $product['prd_name']; ?>">
                                              </form>
                                          </div>
                                          <div class="product-remove">
                                              <button class="wishlist-delete" data-id="<?php echo $product['wishlist_id']; ?>">remove</button>
                                          </div>
                                      </div>
                                  </div>

                                  <div class='loading-overlay d-none'>
                                    <i class='fas fa-spinner fa-spin'></i>
                                  </div>
                              </div>
                          <?php endforeach; ?>

                      </div>
                    <?php else: ?>
                      <div class="no-wishlist">
                        <p>You have no items in wishlist</p>
                      </div>
                    <?php endif; ?>
                </form>

                <div class="social-icons">
                    <a href="" class="whatsapp"><div><i class="fab fa-whatsapp"></i></div></a>
                    <a href="" class="facebook"><div><i class="fab fa-facebook-f"></i></div></a>
                    <a href="" class="twitter"><div><i class="fab fa-twitter"></i></div></a>
                    <a href="" class="pinterest"><div><i class="fab fa-pinterest"></i></div></a>
                </div>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <script>
        $(function(){
            $(document).on('click', '.wishlist-delete', function(e){
                e.preventDefault();

                let overlay = $(this).parents('.hoc').find('.loading-overlay');
                overlay.removeClass('d-none');

                let id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: 'wishlist_delete.php',
                    data: {
                        id : id
                    },
                    dataType: 'json',
                    success: function(response){
                        if(!response.error){
                            document.location.reload(true);
                        }
                        
                        overlay.removeClass('d-none');
                    }
                });
            });
        });

        $(function(){
            $(document).on('click', '.cart-add', function(e){
                e.preventDefault();
                
                let button = $(this).parent().find('button');
                button.html('<i class="fas fa-spinner fa-spin"></i>');

                let product_id = $(this).parent().find("#product_id").val();
                let product_name = $(this).parent().find("#product_name").val();
                let quantity = 1;
                $.ajax({
                    type: 'POST',
                    url: 'cart_add.php',
                    data: {
                        "product_id": product_id,
                        "product_name": product_name,
                        "quantity": quantity
                    },
                    success: function(response){
                        response = JSON.parse(response);
                        button.html('ADD TO CART');
                        $('#callout').show();
                        $('.callout-message.first').html(response.message);
                        if(response.error){
                            $('#callout').removeClass('callout-success').addClass('callout-danger');
                            $('.callout-icon').html('<i class="fas fa-x"></i>');
                        }
                        else{
                            $('#callout').removeClass('callout-danger').addClass('callout-success');
                            $('.callout-icon').html('<i class="fas fa-check"></i>');
                            getCart();
                            getTotal();
                        }
                        $("#product-main").css("padding", "0");
                        goToTop();
                    }
                });
            });
        });
    </script>

</body>
</html>