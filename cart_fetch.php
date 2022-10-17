<?php

  include('config/session.php');
  $conn = $pdo->open();

  $output = array('list' => '', 'count' => 0, 'empty' => '');

  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user']['user_id'];

    $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.prd_id = cart.prd_id LEFT JOIN categories ON categories.cat_id = products.cat_id WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $user]);
    $cart_items = $stmt->fetchAll();

    foreach($cart_items as $row) {
      $output['count']++;
      $price = number_format($row['prd_price'], 2);
      $output['list'] .= "
        <li class='cart-item'>
          <div class='hoc'>
            <a href='product-details.php?prname=".$row['prd_slug']."' class='image-box'><img src='images/".$row['prd_image']."'></a>
            <div class='cart-item-details'>
              <a href='product-details.php?prname=".$row['prd_slug']."'>".$row['prd_name']."</a>
              <p><span>".$row['quantity']."</span> <span>x</span> <span>₦".$price."</span></p>
            </div>
            <button class='cart-delete' data-id='". $row['cart_id'] ."'>×</button>

            <div class='loading-overlay d-none'>
              <i class='fas fa-spinner fa-spin'></i>
            </div>
          </div>
        </li>
      ";
    }

    if($output['count'] == 0) {
      $output['empty'] .= "
        <div class='cart-empty'><p>You have no item(s) in cart</p></div>
      ";
    }

  } else {

    if(!isset($_SESSION['cart'])){
      $_SESSION['cart'] = array();
    }

    if(empty($_SESSION['cart'])){
      $output['count'] = 0;
      $output['empty'] .= "
        <div class='cart-empty'><p>You have no item(s) in cart</p></div>
      ";
    } else {
      foreach($_SESSION['cart'] as $row){
        $product_id = $row['productid'];

        $stmt = $conn->prepare("SELECT * FROM products WHERE prd_id = :product_id");
        $stmt->execute([':product_id' => $product_id]);
        $cart_item = $stmt->fetch();

        $output['count']++;
        $price = number_format($cart_item['prd_price'], 2);
        $output['list'] .= "
          <li class='cart-item'>
            <div class='hoc'>
              <a href='product-details.php?prname=".$cart_item['prd_slug']."' class='image-box'><img src='images/".$cart_item['prd_image']."'></a>
              <div class='cart-item-details'>
                <a  href='product-details.php?prname=".$cart_item['prd_slug']."'>".$cart_item['prd_name']."</a>
                <p><span>".$row['quantity']."</span> <span>x</span> <span>₦".$price."</span></p>
              </div>
              <button class='cart-delete' data-id='". $row['productid'] ."'>×</button>

              <div class='loading-overlay d-none'>
                <i class='fas fa-spinner fa-spin'></i>
              </div>
            </div>
          </li>
        ";
      }
    }
  }

  $pdo->close();
  echo json_encode($output);

?>