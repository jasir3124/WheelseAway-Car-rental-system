<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './rentCar.php');
session_start();
include_once('config.php');


$carId = $_GET['carId'];
$userId = $_SESSION['car_rental_system_userId'];
$carStatus = 'rented';
$userHasRented = 1;

function checkIfUserHasRented($conn, $id){
    $sql = "SELECT * FROM users WHERE userID = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result); 
    if ($row['has_rented'] != true){
        return true;
    } else{
        return false;
    }
}


if (checkIfUserHasRented($conn, $userId)){
    // Update car status
    $carSql = "UPDATE cars SET status = ? WHERE id = ?";
    $carStmt = mysqli_prepare($conn, $carSql);
    mysqli_stmt_bind_param($carStmt, 'si', $carStatus, $carId);
    mysqli_stmt_execute($carStmt);
    
    // Update user rented status and rented car id
    $userSql = "UPDATE users SET has_rented = ?, rented_car_id = ? WHERE userID = ?";
    $userStmt = mysqli_prepare($conn, $userSql);
    mysqli_stmt_bind_param($userStmt, 'iii', $userHasRented, $carId, $userId);
    mysqli_stmt_execute($userStmt);
    $_SESSION['car_rental_system_rented_car_result'] = "Car Rented";
    header("Location: ../website/carForRent.php?carId=$carId");
} else{
    $_SESSION['car_rental_system_rented_car_result'] = "You have Already rented a Car";
    header("Location: ../website/carForRent.php?carId=$carId");
}