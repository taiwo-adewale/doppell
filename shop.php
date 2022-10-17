<?php

    include("config/session.php");
    include('config/fetch.php');

    $maxPrice = max(array_column($products, 'prd_price'));
    $minPrice = min(array_column($products, 'prd_price'));

    if(isset($_GET['submit'])) {
      $search_string = htmlspecialchars($_GET['search']);
      $search_query = '%' . $search_string . '%';

      $conn = $pdo->open();

      try {
        $stmt = $conn->prepare('SELECT * FROM products LEFT JOIN categories on products.cat_id = categories.cat_id WHERE prd_name LIKE :search_query OR cat_name LIKE :search_query');
        $stmt->execute([':search_query' => $search_query]);
        $search_results = $stmt->fetchAll();

        if(count($search_results) > 0) {
          $maxPrice = max(array_column($search_results, 'prd_price'));
          $minPrice = min(array_column($search_results, 'prd_price'));
        } else {
          $maxPrice = 0;
          $minPrice = 0;
        }

      } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
      }
    }

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
    <link rel="stylesheet" href="vendor/fontawesome-free-6.1.2-web/css/all.min.css">

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

        <section class="page-breadcrumbs">
            <div class="container">
                <nav class="breadcrumbs">
                    <a href="index.php">home</a>
                    <span>/</span>

                    <?php if(isset($_GET['submit'])): ?>
                      <a href="shop.php">shop</a>
                      <span>/</span>
                      <a href="" class="current">search results for “<?php echo $search_string ?>”</a>
                    <?php else: ?>
                      <a href="shop.php" class="current">shop</a>
                    <?php endif; ?>

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

            <!-- FEATURED PRODUCTS -->
            <section id="featured-products" class="fetch-products">

                <!-- check if we are displaying all products or search results -->
                <?php if(isset($_GET['submit'])): ?>

                  <!-- check if search results are empty -->
                  <?php if(count($search_results) > 0): ?>

                    <!-- display search results -->
                    <?php foreach($search_results as $product): ?>
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
                                      <p class="product-category"><?php echo $product['cat_name']; ?></p>
                                      <a href="product-details.php?prname=<?php echo $product['prd_slug']; ?>" class="product-name"><p><?php echo $product['prd_name']?></p></a>
                                  </div>
                                  <div class="price-wrapper">
                                      <span class="product-price"><?php echo '₦' . number_format($product['prd_price'], 2) ?? 'Not available'; ?></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <?php endforeach; ?>

                  <?php else: ?>

                    Sorry no product found!

                  <?php endif; ?>
                  

                <?php else: ?>

                  <!-- display all products -->
                  <?php foreach($products as $product): ?>
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
                <?php endif; ?>
                

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