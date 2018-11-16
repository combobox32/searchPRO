<?php
    if (!isset ($_GET["unos"])){
    echo "Parameter is not sent!";
    } else {
    $pom=$_GET["unos"];
    include "connection.php";
    $mysql = 'mysql:host=localhost;dbname=store';
    $username  = 'root';
    $password  = '';
    try {
     $connection = new PDO($mysql,
      $username, $password);
     $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    } catch (PDOException $e) {
       print "Error!: " . $e->getMessage() . "<br/>";
       die();
    }

    $str = "SELECT product_name FROM product WHERE product_name LIKE '$pom%'ORDER BY product_name";
    $result = $conn->query($str);

    if ($result->rowCount() == 0){
        echo "There is no products starting with: " . $pom;
    } else {
    while($row = $result->fetch()) {
    ?>
        <a href="#" onclick="place(this)"><?php  echo $row['product_name'];?></a>
    <br/>
    <?php
    }
    }

    }
?>

