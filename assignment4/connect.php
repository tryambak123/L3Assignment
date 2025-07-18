<?php
    try {
        $dbhost = 'localhost';
        $dbname='result';
        $dbuser = 'root';
        $dbpass = '123456';
        $connect = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    }
   catch (PDOException $e) {
        echo "Error : " . $e->getMessage() . "<br/>";
        die();
    }
?>