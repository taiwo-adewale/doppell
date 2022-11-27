<?php

    $conn = $pdo->open();

    // fetch blog posts data
    try {
      $stmt = $conn->query('SELECT * FROM posts ORDER BY post_date DESC');
      $posts = $stmt->fetchAll();
    }
    catch(PDOException $e) {
      echo 'Connection error: ' . $e->getMessage();
    }

    // fetch products data
    try {
      $stmt = $conn->query('SELECT *, categories.cat_name AS prd_category FROM products JOIN categories ON products.cat_id = categories.cat_id ORDER BY prd_date DESC');
      $products = $stmt->fetchAll();
    }
    catch(PDOException $e) {
      echo 'Connection error: ' . $e->getMessage();
    }

    // fetch categories
    try {
      $stmt = $conn->query('SELECT * FROM categories');
      $categories = $stmt->fetchAll();
    }
    catch(PDOException $e) {
      echo 'Connection error: ' . $e->getMessage();
    }

    $pdo->close();

?>