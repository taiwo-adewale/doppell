<?php
	include 'config/session.php';
  $conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];
	$quantity = $_POST['quantity'];

	if(isset($_SESSION['user'])){

    try {
      $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE prd_id = :prd_id");
      $stmt->execute([':quantity' => $quantity,':prd_id' => $id]);
    }
    catch(PDOException $e) {
      $output['error'] = true;
      $output['message'] = 'Connection error: ' . $e->getMessage();
    }

	} else{

		foreach($_SESSION['cart'] as $key => $row){
			if($row['productid'] == $id){
				$_SESSION['cart'][$key]['quantity'] = $quantity;
			}
		}

	}

  $pdo->close();
	echo json_encode($output);   

?>