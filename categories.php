<?php

  include("config/session.php");
  $conn = $pdo->open();

  $category_name = $_GET['caname'] ?? 'headphones';

  if(isset($category_name)) {

    $stmt = $conn->prepare("SELECT *, categories.cat_name AS prd_category FROM products JOIN categories ON products.cat_id = categories.cat_id WHERE categories.cat_slug  = :cat_name");
    $stmt->execute([':cat_name' => $category_name]);
    $current_category = $stmt->fetchAll();

  }

  include('config/fetch.php');

  $maxPrice = max(array_column($current_category, 'prd_price'));
  $minPrice = min(array_column($current_category, 'prd_price'));

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
    <link rel="stylesheet" href="styles/categories.css?v=<?php echo time(); ?>"/>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Products - Doppell</title>
    
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

        <input type="hidden" id="cat_id" value="<?php echo $current_category[0]['cat_id']; ?>">

        <section class="page-breadcrumbs">
            <div class="container">
                <nav class="breadcrumbs">
                    <a href="index.php">home</a>
                    <span>/</span>
                    <a href="shop.php" class="current">shop</a>
                </nav>
            </div>
        </section>

        <section class="page-main container">
            <aside>
                <div class="categories">
                    <span>browse</span>
                    <div class="hor-divider"></div>
                    <?php foreach($categories as $category): ?>
                        <a href="categories.php?caname=<?php echo $category['cat_slug']; ?>"><?php echo $category['cat_name'] ?? 'uncategorized'; ?></a>
                    <?php endforeach; ?>
                </div>

                <div class="price-filter">
                    <span>filter by price</span>
                    <div class="hor-divider"></div>
                    <div class="wrapper">
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        
                        <div class="range-input">
                            <input type="range" class="range-min" min="<?php echo $minPrice; ?>" max="<?php echo $maxPrice; ?>" value="<?php echo $minPrice; ?>">
                            <input type="range" class="range-max" min="<?php echo $minPrice; ?>" max="<?php echo $maxPrice; ?>" value="<?php echo $maxPrice; ?>">
                        </div>

                        <div class="price-filter-text">
                            <p>Price: 
                                <span class="from"><?php echo '₦' . number_format($minPrice); ?></span> - 
                                <span class="to"><?php echo '₦' . number_format($maxPrice); ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            <section id="featured-products" class="fetch-products">

                <?php foreach( $current_category as $cat_product): ?>
                    <div class="product">
                        <div class="product-inner">
                            <div class="image-box">
                                <a href="product-details.php?prname=<?php echo $cat_product['prd_slug']; ?>">
                                    <img src="images/<?php echo $cat_product['prd_image']; ?>" alt="">
                                </a>
                                <div class="wishlist-icon">
                                    <button type="submit"><i class="fas fa-heart"></i></button>
                                    <input type="hidden" id="p_id" name="p_id" value="<?php echo $cat_product['prd_id']; ?>">
                                    <input type="hidden" id="p_name" name="p_name" value="<?php echo $cat_product['prd_name']; ?>">
                                </div>
                                <div class="quick-view">
                                    <form>
                                        <input type="hidden" class="prod_data" id="prd_name" value="<?php echo $cat_product['prd_name']; ?>">
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
                                    <p class="product-category"><?php echo $cat_product['prd_category']; ?></p>
                                    <a href="product-details.php?product-name=<?php echo $cat_product['prd_slug']; ?>" class="product-name">
                                        <p><?php echo $cat_product['prd_name']; ?></p>
                                    </a>
                                </div>
                                <div class="price-wrapper">
                                    <span class="product-price"><?php echo '₦' . number_format($cat_product['prd_price'], 2); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

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
        </section>

    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>