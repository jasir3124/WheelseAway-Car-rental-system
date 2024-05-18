<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './addUser.php');
session_start();
include_once('config.php');


function getUsernames($conn, $username) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        return false;
    } else {
        return true;
    }
}

function getEmail($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        return false;
    } else {
        return true;
    }
}

function generateUserId() {
    $characters = '0123456789';
    $userId = '';

    for ($i = 0; $i < 12; $i++) {
        $userId .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $userId;
}

if (isset($_POST['submit'])) {
    $name = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $userId = generateUserId();

    $error = '';

    if (empty($name) || empty($lastName) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error .= "All fields are required <br>";
    }

    if (is_numeric($name)) {
        $error .= 'Firstname must not be a number <br>';
    }

    if (is_numeric($lastName)) {
        $error .= 'Lastname must not be a number <br>';
    }

    if ($password != $confirm_password) {
        $error .= 'The passwords you entered do not match <br>';
    }

    if (!(getUsernames($conn, $username))) {
        $error .= 'Username is already taken <br>';
    }

    if (!(getEmail($conn, $email))) {
        $error .= 'This email address is already associated with an existing account. Please use a different email address. <br>';
    }

    if ($error == '') {
        $sql = "INSERT INTO users (userID, username, first_name, last_name, email, password) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $userId, $username, $name, $lastName, $email, $password);
        
        if (mysqli_stmt_execute($stmt)) {
            unset($_SESSION['signup_error_message']);
            $_SESSION['car_rental_system_userId'] = $userId;
            header("Location: /projekte/rental car system/website/home.php");
            exit();
        } else {
            $error .= 'Error executing the query: ' . mysqli_error($conn);
        }
    }

    $_SESSION['signup_error_message'] = $error;
    header("Location: /projekte/rental%20car%20system/website/signUp.php");
    exit();
}