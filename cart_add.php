<?php

  include("config/session.php");
  $conn = $pdo->open();

  $output = array('error' => false);

  $prd_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $prd_name = $_POST['product_name'];

  if(isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['user_id'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM cart WHERE user_id = :user_id AND prd_id = :prd_id");
    $stmt->execute([':user_id' => $user_id, ':prd_id' => $prd_id]);
    $row = $stmt->fetch();

    if( $row['numrows'] < 1) {

      try {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, prd_id, quantity) VALUES (:user_id, :prd_id, :quantity)");
        $stmt->execute([':user_id' => $user_id, ':prd_id' => $prd_id, ':quantity' => $quantity]);
        $output['message'] = '“' . $prd_name . '” has been added to your cart';
      } 
      catch(PDOException $e) {
        $output['error'] = true;
        $output['message'] = $e->getMessage();
      }

    } else {
        $output['error'] = true;
        $output['message'] = '“' . $prd_name . '” is already in your cart';
    }
  } else {

    if(!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }

    $exist = array();

    foreach($_SESSION['cart'] as $row) {
      array_push($exist, $row['productid']);
    }

    if(in_array($prd_id, $exist)) {
      $output['error'] = true;
      $output['message'] = '“' . $prd_name . '” is already in your cart';
    } else {
      $data['productid'] = $prd_id;
      $data['quantity'] = $quantity;

      if(array_push($_SESSION['cart'], $data)){
        $output['message'] = '“' . $prd_name . '” has been added to your cart';
      }
      else{
        $output['error'] = true;
        $output['message'] = 'Cannot add item to cart';
      }
    }
  }

  $pdo->close();
  echo json_encode($output);
    
?>