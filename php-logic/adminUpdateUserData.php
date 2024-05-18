<?php
include_once('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './updateUsers.txt');
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $name = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = '';

    if (preg_match('~[0-9]+~', $name)) {
        $error .= "The name can't contain a number <br>";
    }
    
    if (preg_match('~[0-9]+~', $lastName)) {
        $error .= "The last name can't contain a number <br>";
    }

    if(strlen($password) < 8){
        $error .= "The password must be at least 8 characters long <br>";
    }    

    
    if ($error === '') {
        $sql = "UPDATE users
                SET username = ?, first_name = ?, last_name = ?, email = ?, password = ?
                WHERE username = ?";
    
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssss', $username, $name, $lastName, $email, $password, $username);
    
        if (mysqli_stmt_execute($stmt)) {
            unset($_SESSION['update_user_error_message']);
            $_SESSION['update_user_success_message'] = 'Success';
            header("Location: /projekte/rental car system/website/usersAdminDashboard.php");
            exit();
        } else {
            $error .= 'Error executing the query: ' . mysqli_error($conn);
        }
    }
    
    $_SESSION['update_user_error_message'] = $error;
    header('Location: ../website/updateUserDataDashboard.php');
    exit();
}