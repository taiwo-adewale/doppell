<?php
	include 'config/session.php';
  $conn = $pdo->open();

	if(isset($_SESSION['user'])){

    $user_id = $_SESSION['user']['user_id'];

    $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.prd_id = cart.prd_id WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $cart = $stmt->fetchAll();

		$total = 0;
		foreach($cart as $row){
			$subtotal = $row['prd_price'] * $row['quantity'];
			$total += $subtotal;
		}

    $total = '₦' . number_format($total, 2);

		
	} else {

    if(isset($_SESSION['cart'])) {

      $total = 0;
      foreach($_SESSION['cart'] as $row) {

        $prod_id = $row['productid'];

        $stmt = $conn->prepare("SELECT prd_price FROM products WHERE prd_id = :prod_id");
        $stmt->execute([':prod_id' => $prod_id]);
        $prod = $stmt->fetch();

        $subtotal = $prod['prd_price'] * $row['quantity'];
        $total += $subtotal;

      }

      $total = '₦' . number_format($total, 2);
    }

  }

    $pdo->close();
    echo json_encode($total);
?>