<?php

  require_once('connection.php');

    $product_name = trim($_POST["product_name"]);
    $price = trim($_POST["price"]);
    $category = trim($_POST["category"]);

    $stat = $conn->prepare("INSERT INTO product(product_name,
     price, category)
    VALUES (:product_name, :price, :category)");
    $stat->bindParam(':product_name', $product_name);
    $stat->bindParam(':price', $price);
    $stat->bindParam(':category', $category);

    if($stat->execute()){
      $result =1;
    }

    echo $result;
    $conn = null;
