<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './deleteUser.txt');
include_once('../php-logic/config.php');
session_start();

function deleteCarsFromDatabase($conn, $carData){
    $deleteCarSql = "DELETE FROM cars WHERE id = " . $carData['carId'];
    $result = mysqli_query($conn, $deleteCarSql);
    return $result;
}

function clearUserRentedCar($conn, $carID){
    $userSql = "UPDATE users SET has_rented = 0, rented_car_id = NULL WHERE rented_car_id = " . $carID;
    $userResult = mysqli_query($conn, $userSql);
    return $userResult;
}

$response = ['success' => true, 'message' => ''];

if (isset($_POST['cars'])) {
    error_log("Received users: " . $_POST['cars']);
    $carDataFromJS = json_decode($_POST['cars'], true);
    error_log("Decoded users: " . print_r($carDataFromJS, true));

    foreach ($carDataFromJS as $car) {
        $isCarDeleted = deleteCarsFromDatabase($conn, $car);
        $isUserCarCleared = clearUserRentedCar($conn, $car['carId']);

        if (!$isCarDeleted) {
            $response['success'] = false;
            $response['message'] .= 'Could not delete car with ID ' . $car['carId'] . ' from database. ';
        }

        if (!$isUserCarCleared) {
            $response['success'] = false;
            $response['message'] .= 'Could not clear user car data for car ID ' . $car['carId'] . ' from database. ';
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No car data sent.';
}

echo json_encode($response);