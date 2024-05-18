<?php
    $host = 'localhost';
    $password = 'root';
    $username = 'root';
    $dbName = 'car rental systme';

    try {
        $conn = mysqli_connect($host, $password, $username, $dbName);
    } catch (\Throwable $th) {
        echo 'Error connecting to car rental system ' . $dbName . ': ' . $th->getMessage();
    }