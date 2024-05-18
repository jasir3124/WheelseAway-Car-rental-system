<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
include_once('../php-logic/config.php');
session_start();

$response = [];

if (isset($_POST['users'])) {
    error_log("Received users: " . $_POST['users']);
    $userDataFromJS = json_decode($_POST['users'], true);
    error_log("Decoded users: " . print_r($userDataFromJS, true));

    if (!empty($userDataFromJS)) {
        foreach ($userDataFromJS as $user) {
            if($user['has_rented']){
                $userSql = "SELECT * FROM users WHERE userID = {$user['userId']}";
                $result = mysqli_query($conn, $userSql);
                $userData = mysqli_fetch_assoc($result);
                $carSql = "UPDATE cars SET status = 'available' WHERE id = {$userData['rented_car_id']}";
                mysqli_query($conn, $carSql);
            }
            $sql = "DELETE FROM users WHERE userID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user['userId']);
            mysqli_stmt_execute($stmt);
        }

        $response['success'] = true;
        $response['message'] = 'Users processed successfully.';
    } else {
        $response['success'] = false;
        $response['message'] = 'No data to process.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No users data sent.';
}

echo json_encode($response);