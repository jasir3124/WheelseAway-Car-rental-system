<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './changePassword.php');
session_start();
include_once('config.php');

if (isset($_POST['submit'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $userId = $_SESSION['car_rental_system_userId'];

    $error = '';

    $sql = "SELECT * FROM users WHERE userID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row !== NULL) {
            $oldPassword = $row['password'];
            if ($currentPassword == $oldPassword) {
                $sql = "UPDATE users
                    SET password = ?
                    WHERE userID = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ss',$newPassword, $userId);
                mysqli_stmt_execute($stmt);
                $_SESSION['change_password_success_message'] = 'Password changed successfully';
                unset($_SESSION['change_password_error_message']);
                header("Location: /projekte/rental car system/website/profile.php");
                exit();
            } else {
                $error .= "The passwords do not match";
                $_SESSION['change_password_error_message'] = $error;
                header("Location: /projekte/rental car system/website/profile.php");
            }
        }
    } else {
        $error .= "Error executing the query";
        $_SESSION['change_password_error_message'] = $error;
        header("Location: /projekte/rental car system/website/profile.php");
    }
}