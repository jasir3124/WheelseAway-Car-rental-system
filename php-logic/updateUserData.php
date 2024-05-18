<?php
include_once('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
// ini_set('error_log', './updateUserData.php');
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $name = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $userId = $_SESSION['car_rental_system_userId'];

    $error = '';

    if (empty($username) || empty($name) || empty($lastName) || empty($email )) {
        $error .= "All fields are required! <br>";
    }

    if (preg_match('~[0-9]+~', $name)) {
        $error .= "The name can't contain a number <br>";
    }
    
    if (preg_match('~[0-9]+~', $lastName)) {
        $error .= "The last name can't contain a number <br>";
    }

    
    if ($error === '') {
        $sql = "UPDATE users
                SET username = ?, first_name = ?, last_name = ?, email = ?
                WHERE userID = ?";
    
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssss', $username, $name, $lastName, $email, $userId);
    
        if (mysqli_stmt_execute($stmt)) {
            unset($_SESSION['update_user_error_message']);
            $_SESSION['update_user_success_message'] = 'Account info updated successfully!';
            header("Location: /projekte/rental car system/website/profile.php");
            exit();
        } else {
            $error .= 'Error executing the query: ' . mysqli_error($conn);
        }
    }
    
    $_SESSION['update_user_error_message'] = $error;
    header('Location: /projekte/rental car system/website/profile.php');
    exit();
}