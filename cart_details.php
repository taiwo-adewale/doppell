<?php

  // this code is responsible for cart items on cart page

  include("config/session.php");
  $conn = $pdo->open();

  $output = '';

  // check if a user is logged in
	if(isset($_SESSION['user'])){

    $user_id = $_SESSION['user']['user_id'];

    // check if the user already added some items to the cart before logging in and add the items if any
		if(isset($_SESSION['cart'])){

			foreach($_SESSION['cart'] as $row){

        $prd_id = $row['productid'];
        $quantity = $row['quantity'];

        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM cart WHERE user_id = :user_id AND prd_id = :prd_id");
        $stmt->execute([':user_id' => $user_id, ':prd_id' => $prd_id]);
        $crow = $stmt->fetch();

				if($crow['numrows'] < 1){
          $stmt = $conn->prepare("INSERT INTO cart (user_id, prd_id, quantity) VALUES ( :user_id, :prd_id, :quantity )");
          $stmt->execute([':user_id' => $user_id, ':prd_id' => $prd_id, ':quantity' => $quantity]);
				}
				else{
          $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE user_id = :user_id  AND prd_id = :prd_id");
          $stmt->execute([':quantity' => $quantity, ':user_id' => $user_id, ':prd_id' => $prd_id]);
				}

			}

			unset($_SESSION['cart']);
            
		}

    // fetch the user's updated cart
    $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.prd_id = cart.prd_id WHERE user_id= :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $cart_items = $stmt->fetchAll();

    if(count($cart_items) != 0) {

      foreach($cart_items as $row){
        
        $prod_id = $row['prd_id'];
        $subtotal = $row['prd_price'] * $row['quantity'];
        $output .= "
          <tr class='hoc'>
            <td class='product-remove'>
              <a href='' class='cart-delete' data-id='" . $row['cart_id'] . "'>×</a>
            </td>
  
            <td class='product-thumbnail'>
              <a href=''><img src='images/" . $row['prd_image'] . "'></a>
            </td>
  
            <td class='product-name'>
              <a href='product-details.php?prname=" . $row['prd_slug'] . "'>" . $row['prd_name'] . "</a>							
              <div class='hidden-for-large-screens'>
                <span class='quantity'>" . $row['quantity'] . " x </span>
                <span class='price'><span>₦</span>". number_format($row['prd_price'], 2) ."</span>							
              </div>
            </td>
  
            <td class='product-price'>
              <span><span>₦</span>". number_format($row['prd_price'], 2) ."</span>
            </td>
  
            <td class='product-quantity'>
              <form>
                <div class='product-cart'>
                  <input type='hidden' data-id='" . $prod_id . "' name='items-in-cart' value='" . $row['prd_stock'] . "'>
                  <input type='button' data-id='" . $prod_id . "' value='-' class='decrease'>
                  <input type='number' data-id='" . $prod_id . "' name='cart-items' id='cart-items' value='" . $row['quantity'] . "' disabled>
                  <input type='button' data-id='" . $prod_id . "' value='+' class='increase'>
                </div>
              </form>
            </td>
  
            <td class='product-subtotal'>
              <span><span>₦</span>". number_format($subtotal, 2) ."</span>
            </td>

            <td class='loading-overlay d-none'>
              <i class='fas fa-spinner fa-spin'></i>
            </td>
          </tr>	
          ";
      }
  
      $output .= "
        <tr>
          <td colspan='6' class='cart-buttons'>
            <div class='continue-shopping'>
              <a href='shop.php'>
                ←&nbsp;Continue shopping
              </a>
            </div>
          </td>
        </tr>
      ";
      
    } else {
      // no items in cart
      $output .= "
        <tr>
          <td colspan='6'>
            <div class='no-cart'>
              <img src='images/cart.png' alt='no items in cart image'>
            </div>
          </td>
        </tr>
      ";
    }

	}
	else{

    // cart for guest users (users that haven't logged in)
		if(count($_SESSION['cart']) != 0){

			foreach($_SESSION['cart'] as $row){

        $prod_id = $row['productid'];

        $stmt = $conn->prepare("SELECT * FROM products LEFT JOIN categories ON categories.cat_id = products.cat_id WHERE products.prd_id = :prod_id");
        $stmt->execute([':prod_id' => $prod_id]);
        $product = $stmt->fetch();
                
				$subtotal = $product['prd_price'] * $row['quantity'];
				$output .= "
          <tr class='hoc'>
            <td class='product-remove'>
              <a href='' class='cart-delete' data-id='" . $prod_id . "'>×</a>
            </td>

            <td class='product-thumbnail'>
              <a href='product-details.php?prname=" . $product['prd_slug'] . "'><img src='images/" . $product['prd_image'] . "'></a>
            </td>

            <td class='product-name'>
              <a href=''>" . $product['prd_name'] . "</a>							
              <div class='hidden-for-large-screens'>
                <span class='quantity'>" . $row['quantity'] . " x </span>
                <span class='price'><span>₦</span>". number_format($product['prd_price'], 2) ."</span>							
              </div>
            </td>

            <td class='product-price'>
              <span><span>₦</span>". number_format($product['prd_price'], 2) ."</span>
            </td>

            <td class='product-quantity'>
              <form>
                <div class='product-cart'>
                  <input type='hidden' data-id='" . $prod_id . "' name='items-in-cart' value='" . $product['prd_stock'] . "'>
                  <input type='button' data-id='" . $prod_id . "' value='-' class='decrease'>
                  <input type='number' data-id='" . $prod_id . "' name='cart-items' id='cart-items' value='" . $row['quantity'] . "' disabled>
                  <input type='button' data-id='" . $prod_id . "' value='+' class='increase'>
                </div>
              </form>
            </td>

            <td class='product-subtotal'>
              <span><span>₦</span>". number_format($subtotal, 2) ."</span>
            </td>

            <td class='loading-overlay d-none'>
              <i class='fas fa-spinner fa-spin'></i>
            </td>
          </tr>	
      ";
				
			}

			$output .= "
        <tr>
          <td colspan='6' class='cart-buttons'>
            <div class='continue-shopping'>
              <a href='shop.php'>
                ←&nbsp;Continue shopping
              </a>
            </div>
          </td>
        </tr>
    ";
		} else {
      // no items in cart
      $output .= "
        <tr>
          <td colspan='6'>
            <div class='no-cart'>
              <img src='images/cart.png' alt='no items in cart image'>
            </div>
          </td>
        </tr>
      ";
    }
		
	}

  $pdo->close();
	echo json_encode($output);

?>
