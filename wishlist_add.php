<?php

  include("config/session.php");
  $conn = $pdo->open();

  $output = array('error' => false);

  $prd_id = $_POST['p_id'];
  $prd_name = $_POST['p_name'];

  if(isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['user_id'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM wishlist WHERE user_id = :user_id AND prd_id = :prd_id");
    $stmt->execute([':user_id' => $user_id, ':prd_id' => $prd_id]);
    $row = $stmt->fetch();

      if( $row['numrows'] < 1) {
        try {
          $stmt = $conn->prepare("INSERT INTO wishlist (user_id, prd_id) VALUES (:user_id, :prd_id)");
          $stmt->execute([':user_id' => $user_id, ':prd_id' => $prd_id]);
          $output['message'] = '“' . $prd_name . '” has been added to your wishlist';
        }
        catch(PDOException $e) {
          $output['error'] = true;
          $output['message'] = 'Connection error: ' . $e->getMessage();
        }
      } else {
        $output['error'] = true;
        $output['message'] = '“' . $prd_name . '” is already in your wishlist';
      }

  } else {

    $output['error'] = true;
    $output['message'] = 'You have to login in to add product to wishlist';

  }

  $pdo->close();
  echo json_encode($output);
    
?>