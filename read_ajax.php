<?php

  require_once('connection.php');

   $id  = trim($_GET["id"]);

    $stat = $conn->prepare("select * from product where id = :id");
    $stat->bindParam(':id', $id);

    $stat->execute();
    $data = $stat->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
    $conn = null;

?>