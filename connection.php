<?php

    $username  = 'root';
    $password  = '';
    $result = 0;
    try {
        $conn = new PDO('mysql:host=localhost;dbname=store', $username, $password);
    } catch (PDOException $e) {
        print "Greska!: " . $e->getMessage() . "<br/>";
        die();
}
