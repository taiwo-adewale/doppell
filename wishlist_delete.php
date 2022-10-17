<?php
	include 'config/session.php';
  $conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];

	if(isset($_SESSION['user'])){

    try {
      $stmt = $conn->prepare("DELETE FROM wishlist WHERE wishlist_id = :wishlist_id");
      $stmt->execute([':wishlist_id' => $id]);
    }
    catch(PDOException $e) {
      $output['error'] = true;
      $output['message'] = 'Connection error' . $e->getMessage();
    }

	}

  $pdo->close();
  echo json_encode($output);

?>