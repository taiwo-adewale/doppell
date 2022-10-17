<?php
	include 'config/session.php';
  $conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];

	if(isset($_SESSION['user'])){

    try {
      $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = :cart_id");
      $stmt->execute([':cart_id' => $id]);
      $output['message'] = 'Deleted';
    }
    catch (PDOException $e) {
      $output['error'] = true;
      $output['message'] = $e->getMessage();
    }

	} else {

		foreach($_SESSION['cart'] as $key => $row){
			if($row['productid'] == $id){
				unset($_SESSION['cart'][$key]);
				$output['message'] = 'Deleted';
			}
		}

	}

  $pdo->close();
  echo json_encode($output);

?>