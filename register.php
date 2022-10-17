<?php

  include("config/session.php");
  $conn = $pdo->open();

  $errors = array();
  $_SESSION['signup_error'] = $errors;

  if(isset($_POST['signup'])) {


    if(empty($_POST['signup_firstname'])) {
      $_SESSION['signup_error']['firstname'] = 'This field is required';
      header('location: login.php?v=signup');
    } else {
      $firstname = htmlspecialchars($_POST['signup_firstname']);
    }


    if(empty($_POST['signup_lastname'])) {
      $_SESSION['signup_error']['lastname'] = 'This field is required';
      header('location: login.php?v=signup');
    } else {
      $lastname = htmlspecialchars($_POST['signup_lastname']);
    }


    if(empty($_POST['signup_email'])) {
      $_SESSION['signup_error']['email'] = 'This field is required';
      header('location: login.php?v=signup');
    } else {
      $email = htmlspecialchars($_POST['signup_email']);

      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['signup_error']['email'] = 'Not a valid email';
        header('location: login.php?v=signup');
      } else {

        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();

        if($row['numrows'] > 0) {
          $_SESSION['signup_error']['email'] = "Email is already taken";
          header('location: login.php?v=signup');
        }
      }
    }
      

    if(empty($_POST['signup_password'])) {
      $_SESSION['signup_error']['password'] = 'This field is required';
      header('location: login.php?v=signup');
    } else {
      $password = htmlspecialchars($_POST['signup_password']);        
    }


    if(empty($_POST['signup_repassword'])) {
      $_SESSION['signup_error']['repassword'] = 'This field is required';
      header('location: login.php?v=signup');
    } else {
      $repassword = htmlspecialchars($_POST['signup_repassword']);

      if($password != $repassword){
        $_SESSION['signup_error']['password'] = 'Passwords did not match';
        $_SESSION['signup_error']['repassword'] = 'Passwords did not match';
        header('location: login.php?v=signup');
      } 
    }


    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;   
  

    if(!array_filter($_SESSION['signup_error'])) {

      $firstname = $_POST['signup_firstname'];
      $lastname = $_POST['signup_lastname'];
      $email = $_POST['signup_email'];
      $password = password_hash($password, PASSWORD_DEFAULT);

      try {
        $stmt = $conn->prepare("INSERT INTO users(email,password,firstname,lastname) VALUES(:email, :password, :firstname, :lastname)");
        $stmt->execute([':email' => $email, ':password' => $password, ':firstname' => $firstname, ':lastname' => $lastname]);

        unset($_SESSION['firstname']);
        unset($_SESSION['lastname']);
        unset($_SESSION['email']);

        try {
          $stmt = $conn->prepare("SELECT user_id, firstname, lastname FROM users WHERE email = :email");
          $stmt->execute([':email' => $email]);
          $user = $stmt->fetch();

          $_SESSION['user'] = $user;

          header('location: index.php');
        }
        catch(PDOException $e) {
          echo 'Query error: ' . $e->getMessage();
        }
      }
      catch(PDOException $e) {
        echo 'Query error: ' . $e->getMessage();
      }

    } 

  }

  $pdo->close();

?>