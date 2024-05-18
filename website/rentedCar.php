<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include_once('../php-logic/config.php');
    include_once('../php-logic/header.php');
    session_start();

    $userID = $_SESSION['car_rental_system_userId'];

    $sql = "SELECT * FROM users WHERE userID = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param( $stmt, 'i', $userID);

    $result = mysqli_stmt_execute($stmt);

    echo $result;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>