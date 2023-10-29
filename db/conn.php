<?php
include(__DIR__ . '/../config.php');

function getDBConnection() {
    try {
        $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return null;
    }
}
