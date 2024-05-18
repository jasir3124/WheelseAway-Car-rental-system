<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './loginLogic.php');
session_start();

include_once('header.php');
include_once('config.php');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $error = '';

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row !== NULL) {
            $_SESSION['car_rental_system_userId'] = $row['userID'];
            header("Location: /projekte/rental car system/website/home.php");
            exit();
        } else {
            $error .= "Invalid username or password";
            $_SESSION['login_error_message'] = $error;
        }
    } else {
        $error .= "Error executing the query";
        $_SESSION['login_error_message'] = $error;
    }

    mysqli_stmt_close($stmt);
}

if (isset($_SESSION['login_error_message'])) {
    header("Location: /projekte/rental car system/website/login.php");
}
exit();
?>