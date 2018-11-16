<?php

  require_once('connection.php');

    $product_name  = trim($_POST["product_name"]);
    $price = trim($_POST["price"]);
    $category = trim($_POST["category"]);
    $id  = trim($_POST["id"]);

    $stat = $conn->prepare("UPDATE 
    product set product_name
    = :product_name, price = :price , 
    category = :category
    where id = :id");

    $stat->bindParam(':product_name', $product_name);
    $stat->bindParam(':price', $price);
    $stat->bindParam(':category', $category);
    $stat->bindParam(':id', $id);
  
    if($stat->execute()){
      $result =1;
    }
    echo $result;
    $conn = null;

    ?>