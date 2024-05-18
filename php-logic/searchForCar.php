<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './searchForCar.php');
session_start();
include_once('config.php');

if (isset($_POST['submit'])) {
    $searchForCar = isset($_POST['searchForCar']) ? $_POST['searchForCar'] : '';
    $priceRadio = isset($_POST['priceCheckbox']) ? $_POST['priceCheckbox'] : '';
    $yearRadio = isset($_POST['yearCheckbox']) ? $_POST['yearCheckbox'] : '';
    
    $sql = "SELECT *
            FROM cars
            WHERE (LOWER(car_name) LIKE LOWER(?)
                   OR LOWER(car_model) LIKE LOWER(?)
                   OR LOWER(car_year) LIKE LOWER(?))
                  AND (costPerDay <= ? OR ? = '')
                  AND (car_year = ? OR ? = '');";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    $searchForCarLower = "%{$searchForCar}%";
    mysqli_stmt_bind_param($stmt, "sssssss", $searchForCarLower, $searchForCarLower, $searchForCarLower, $priceRadio, $priceRadio, $yearRadio, $yearRadio);
    

    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        unset($_SESSION['car_rental_car_search']);
        echo "Error while executing query: " . mysqli_error($conn);
        header("Location: ../website/allCars.php");
        exit();
    }

    $searchResult = mysqli_stmt_get_result($stmt);

    if (!(mysqli_num_rows($searchResult) > 0)) {
        $_SESSION['car_rental_car_search_result'] = "No cars were found based on your search!";
        unset($_SESSION['car_rental_car_search']);
        header("Location: ../website/allCars.php");
        exit();
    }

    $data = [];
    while ($row = mysqli_fetch_array($searchResult)) {
        $data[] = $row;
    }
    $_SESSION['car_rental_car_search'] = $data;
    $_SESSION['car_rental_car_search_result'] = "Cars Found";
    header("Location: ../website/allCars.php");

    mysqli_stmt_close($stmt);
} else {
    unset($_SESSION['car_rental_car_search']);
    header("Location: ../website/allCars.php");
}