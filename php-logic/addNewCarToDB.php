<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './addNewCarToDB.php');
include_once('../php-logic/config.php');
session_start();

function checkIfCarExist($conn, $carName)
{
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM cars WHERE car_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $carName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    if ($data) {
        return "Car already exists";
    }
    return null;
}

if (isset($_POST['submit'])) {
    // Debugging: Print received POST data
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // Check if all POST variables are set
    $carName = isset($_POST['carName']) ? $_POST['carName'] : '';
    $carModel = isset($_POST['carModel']) ? $_POST['carModel'] : '';
    $carYear = isset($_POST['carYear']) ? $_POST['carYear'] : '';
    $carCost = isset($_POST['costPerDay']) ? $_POST['costPerDay'] : '';
    $carImageName = isset($_POST['carImage']) ? $_POST['carImage'] : '';

    $error = '';

    if (empty($carName) || empty($carModel) || empty($carYear) || empty($carCost) || empty($carImageName)) {
        $error .= 'All fields are required! ';
    } else {
        // Check if the car already exists
        $carExistError = checkIfCarExist($conn, $carName);
        if ($carExistError) {
            $error .= $carExistError;
        }
    }

    // Debugging: Print error messages
    echo '<pre>';
    echo 'Error: ' . $error;
    echo '</pre>';

    if ($error == '') {
        $carImagePath = "images/car-images/" . $carImageName;

        // Use prepared statement for the insert query
        $sql = "INSERT INTO cars (car_name, car_model, car_year, costPerDay, image_path, status) 
                VALUES (?, ?, ?, ?, ?, 'available')";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssiss", $carName, $carModel, $carYear, $carCost, $carImagePath);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION['add_car_to_db_success'] = 'Car added to database successfully!';
    }

    // Set session error and redirect
    $_SESSION['add_car_to_db_error'] = $error;
    header('Location: /projekte/rental car system/website/carAdminDashboard.php');
    exit();
}
