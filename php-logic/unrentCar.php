<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include_once('../php-logic/config.php');
    include_once('../php-logic/header.php');
    session_start();

    $carID = $_GET['carID'];
    $userID = $_SESSION['car_rental_system_userId'];

    $userSql = "UPDATE users SET has_rented = 0, rented_car_id = NULL WHERE userID = $userID";
    $carSql = "UPDATE cars SET status = 'available' WHERE id = $carID";

    $userResult = mysqli_query($conn, $userSql);
    $carResult = mysqli_query($conn, $carSql);

    $_SESSION['rental_car_system_return_car_status'] = "Car returned successfully";
    
    header("Location: ../website/profile.php");