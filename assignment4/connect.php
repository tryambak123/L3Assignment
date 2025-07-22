<?php
    try {
        // Database connection parameters
        $dbhost = 'localhost'; // Hostname of the database server
        $dbname = 'result';    // Name of the database
        $dbuser = 'root';      // Username for the database
        $dbpass = '123456';    // Password for the database

        // Create a new PDO instance to connect to the database
        $connect = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    }
    catch (PDOException $e) {
        // Handle connection errors
        echo "Error : " . $e->getMessage() . "<br/>";
        die(); // Terminate script execution on error
    }
?>