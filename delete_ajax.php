<?php

  $username  = 'root';
  $password  = '';
  try {
   $conn = new PDO('mysql:host=localhost;
    dbname=store',
    $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  } catch (PDOException $e) {
     print "Error!: " . $e->getMessage() . "<br/>";
     die();
  }

  $result = 0;
  echo $id = intval($_POST['pid']);

  if(intval($id)){
    $stat = $conn->prepare(
      "DELETE FROM product
        WHERE id = :id");
      $stat->bindParam(':id', $id, PDO::PARAM_INT);
      if($stat->execute()){
      $result = 1;
  }
}
  echo $result;
  $conn = null;

  ?>