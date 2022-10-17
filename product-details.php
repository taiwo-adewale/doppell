<?php

  include("config/session.php");
  $conn = $pdo->open();

  $p_name = $_GET['prname'] ?? 'sony_ps4_wireless_controller';

  if(isset($p_name)) {

    $stmt = $conn->prepare("SELECT *, categories.cat_name AS prd_category FROM products JOIN categories ON products.cat_id = categories.cat_id WHERE prd_slug = :prd_name");
    $stmt->execute([':prd_name' => $p_name]);
    $current_product = $stmt->fetch();

    $stmt = $conn->prepare("SELECT *, categories.cat_name AS prd_category FROM products JOIN categories ON products.cat_id = categories.cat_id WHERE products.cat_id = :cat_id");
    $stmt->execute([':cat_id' => $current_product['cat_id']]);
    $related_products = $stmt->fetchAll();

    function removeCurrentItemFromRelatedProducts() {
      global $related_products;
      global $current_product;

      $i = 0;

      foreach($related_products as $product) {
        if($product['prd_id'] === $current_product['prd_id']) {
          unset($related_products[$i]);
        }
        $i++;
      } 
    }

    removeCurrentItemFromRelatedProducts();

  }

  include('config/fetch.php')

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
    <link rel="stylesheet" href="styles/product-details.css?v=<?php echo time(); ?>"/>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="vendor/fontawesome-free-6.1.2-web/css/all.min.css">

    <title><?php echo $current_product['prd_name']; ?> - Doppell</title>
    
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

        <section id="product-main">
            <div class="product-image">
                <img src="images/<?php echo $current_product['prd_image']; ?>" alt="">
                <div class="wishlist-icon">
                    <button type="submit"><i class="fas fa-heart"></i></button>
                    <input type="hidden" id="p_id" name="p_id" value="<?php echo $current_product['prd_id']; ?>">
                    <input type="hidden" id="p_name" name="p_name" value="<?php echo $current_product['prd_name']; ?>">
                </div>
            </div>
            <div id="product-description">
                <div class="breadcrumb">
                    <a href="index.php">home </a>
                    <span>/</span>
                    <a href=""><?php echo $current_product['prd_category']; ?></a>
                </div>
                <h1><?php echo $current_product['prd_name']; ?></h1>
                <div class="hor-divider"></div>
                <h2><?php echo '₦' . number_format($current_product['prd_price'], 2); ?></h2>
                <form id="product-form" class="product-cart-box">
                    <div class="product-cart">
                        <input type="hidden" class="item-stock" value="<?php echo $current_product['prd_stock']; ?>">
                        <input type="hidden" id="product_id" name="product_id" value="<?php echo $current_product['prd_id']; ?>">
                        <input type="hidden" id="product_name" name="product_name" value="<?php echo $current_product['prd_name']; ?>">
                        <input type="button" value="-" class="decrease">
                        <input type="number" id="quantity" name="quantity" id="cart-items" value="1" disabled>
                        <input type="button" value="+" class="increase">
                    </div>
                    <button type="submit">ADD TO CART</button>
                </form>
                <div class="product-details">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut nobis earum commodi, suscipit provident illo neque aperiam perferendis. Expedita perferendis distinctio nostrum, aliquam eos corporis debitis voluptatum velit quam deleniti ea, quasi dolor? Eius, eligendi rerum voluptate repudiandae a distinctio quia temporibus fugit.</p>
                </div>
                <span>Category: <a href=""><?php echo $current_product['prd_category']; ?></a></span>
                <div class="social-icons">
                    <a href="" class="whatsapp"><div><i class="fab fa-whatsapp"></i></div></a>
                    <a href="" class="facebook"><div><i class="fab fa-facebook-f"></i></div></a>
                    <a href="" class="twitter"><div><i class="fab fa-twitter"></i></div></a>
                    <a href="" class="pinterest"><div><i class="fab fa-pinterest"></i></div></a>
                </div>
            </div>
        </section>

        <section id="product-tabs">
            <div class="product-tabs-inner">
                <ul class="tabs">
                    <li data-tab-target="#description" class="tab active">
                        <p>description</p>
                    </li>
                    <li data-tab-target="#reviews" class="tab">
                        <p>reviews</p>
                    </li>
                </ul>
                <div class="tab-panels">
                    <div class="tab-title-description active" id="description" data-tab-content>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Modi, exercitationem. Dolor quidem autem doloribus veritatis vitae explicabo similique nulla fugiat.</p>
                        <ul>
                            <li>Lorem amet consectetur</li>
                            <li>Dolor quidem</li>
                            <li>autem doloribus veritatis vitae</li>
                            <li>nobis earum commodi</li>
                            <li>Expedita perferendis distinctio nostrum</li>
                        </ul>
                    </div>
                    <div class="tab-title-reviews" id="reviews" data-tab-content>
                        <div class="review-row">
                            <h2>Reviews</h2>
                            <p>There are no reviews yet</p>
                        </div>
                        <div class="review-form">
                            <h3>Be the first to review “<?php echo $current_product['prd_name']; ?>”</h3>
                            <form action="" class="form">
                                <div class="review-form-review">
                                    <label for="review">
                                        Your review <span class="required">*</span>
                                    </label>
                                    <textarea name="review" id="review" required></textarea>
                                </div>
                                <div class="review-form-name">
                                    <label for="name">
                                        Name <span class="required">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" required>
                                </div>
                                <div class="review-form-email">
                                    <label for="email">
                                        Email <span class="required">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" required>
                                </div>
                                <div class="review-form-button">
                                    <button type="submit">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="small-gap"></div>

        <!-- RELATED PRODUCTS TITLE -->
        <div class="title">
            <div class="featured-products-title">
                <div class="divider"></div>
                <h2>related products</h2>
                <div class="divider"></div>
            </div>

            <div class="small-gap"></div>
        </div>
    
        <!-- RELATED PRODUCTS -->
        <section id="featured-products">
            <?php if(count($related_products) > 0): ?>
              <?php foreach( $related_products as $product ): ?>
                  <div class="product">
                      <div class="product-inner">
                          <div class="image-box">
                              <a href="product-details.php?prname=<?php echo $product['prd_slug']; ?>">
                                  <img src="images/<?php echo $product['prd_image']; ?>" alt="">
                              </a>
                              <div class="wishlist-icon">
                                  <button type="submit"><i class="fas fa-heart"></i></button>
                                  <input type="hidden" id="p_id" name="p_id" value="<?php echo $product['prd_id']; ?>">
                                  <input type="hidden" id="p_name" name="p_name" value="<?php echo $product['prd_name']; ?>">
                              </div>
                              <div class="quick-view">
                                  <form>
                                      <input type="hidden" class="prod_data" id="prd_name" value="<?php echo $product['prd_name']; ?>">
                                      <button type="button" class="open">
                                          quick view
                                      </button>
                                  </form>
                              </div>
                              <div class="loading-overlay d-none">
                                <i class="fas fa-spinner fa-spin"></i>
                              </div>
                          </div>
                          <div class="text-box">
                              <div class="title-wrapper">
                                  <p class="product-category"><?php echo $product['prd_category']; ?></p>
                                  <a href="product-details.php?prname=<?php echo $product['prd_slug']; ?>" class="product-name"><p><?php echo $product['prd_name']?></p></a>
                              </div>
                              <div class="price-wrapper">
                                  <span class="product-price"><?php echo '₦' . number_format($product['prd_price'], 2) ?? 'Not available'; ?></span>
                              </div>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>
            <?php else:  ?>
              <div class="no-related-products"><p>No products to display</p></div>
            <?php endif;  ?>

            <!-- QUICK VIEW MODAL -->
            <div id="modal-container-box" class="initial">
                <div class="modal-background"></div>

                <div class="modal-container" id="modal-container">
                    <div class="inner-container">
                        <div class="modal-box" id="modal-box">
                            
                        </div>
                    </div>
                </div>

                <button type="button" id="close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
        </section>

        <div class="large-gap"></div>
    </main>

    <?php include('includes/footer.php'); ?>

    <script src="scripts/product-details.js?v=<?php echo time(); ?>"></script>

</body>
</html>