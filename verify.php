<?php

  include("config/session.php");
  $conn = $pdo->open();

  $errors = array();
  $_SESSION['login_error'] = $errors;

  if(isset($_POST['login'])) {

    if(empty($_POST['login_email'])) {
      $_SESSION['login_error']['email'] = 'This field is required';
      header('location: login.php?v=login');
    } else {
      $email = htmlspecialchars($_POST['login_email']);

      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_error']['email'] = 'Not a valid email';
        header('location: login.php?v=login');
      } else {

        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();

        if($row['numrows'] < 1) {
          $_SESSION['login_error']['email'] = "Email not found";
          header('location: login.php?v=login');
        }
      }
    }


    if(empty($_POST['login_password'])) {
      $_SESSION['login_error']['password'] = 'This field is required';
      header('location: login.php?v=login');
    } else {
      $password = htmlspecialchars($_POST['login_password']);        
    }


    $_SESSION['email'] = $email;   


    if(!array_filter($_SESSION['login_error'])) {

      $email = $_POST['login_email'];

      $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
      $stmt->execute([':email' => $email]);
      $row = $stmt->fetch();

      if(password_verify($password, $row['password'])) {
        unset($_SESSION['email']);

        $stmt = $conn->prepare("SELECT user_id, firstname, lastname FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        $_SESSION['user'] = $user;

        header('location: index.php');
      } else {
        $_SESSION['login_error']['password'] = 'Incorrect password';
        header('location: login.php?v=login');
      }

    }

  }

  $pdo->close();

?>