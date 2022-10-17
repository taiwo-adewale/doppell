<?php

  include('config/session.php');
  $conn = $pdo->open();

  if(isset($_POST['min_price']) && isset($_POST['max_price'])) {

    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];

    if(isset($_POST['cat_id'])) {
      $cat_id = $_POST['cat_id'];

      $stmt = $conn->prepare("SELECT * FROM products LEFT JOIN categories on products.cat_id = categories.cat_id WHERE products.cat_id = :cat_id AND prd_price BETWEEN :min_price AND :max_price");
      $stmt->execute([':cat_id' => $cat_id, ':min_price' => $min_price, ':max_price' => $max_price]);
    } else {
      $stmt = $conn->prepare("SELECT * FROM products LEFT JOIN categories on products.cat_id = categories.cat_id WHERE prd_price BETWEEN :min_price AND :max_price");
      $stmt->execute([':min_price' => $min_price, ':max_price' => $max_price]);
    }

    $filtProd = $stmt->fetchAll();

    if(count($filtProd) == 0) {
      echo "Sorry no product found!";
    }

  }

  $pdo->close();

?>

<?php foreach($filtProd as $product): ?>
    <div class="product">
        <div class="product-inner">
            <div class="image-box">
                <a href="product-details.php?prname=<?php echo $product['prd_slug']; ?>">
                    <img src="images/<?php echo $product['prd_image']; ?>">
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