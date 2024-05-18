<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include_once('../php-logic/config.php');
include_once('../php-logic/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sass-output/login.css">
    <title>Document</title>
</head>

<body class="flex justify-center items-center">
    <div class="bg-gray-950/80  grid p-10 w-4/12">
        <form action="../php-logic/loginLogic.php" method="post" class="grid w-full text-white text-center">
            <h1 class="text-3xl mb-5 font-semibold ">Log in to rent a car</h1>

            <?php
            if (isset($_SESSION['login_error_message'])) {
                echo '<p class="text-red-500">' . $_SESSION['login_error_message'] . '</p>';
                unset($_SESSION['login_error_message']);
            }
            ?>

            <input class="border bg-transparent p-2 my-3 w-full" type="text" name="username" placeholder="Username">

            <div class="flex relative">
                <input class="passwordInput border border-e-0 bg-transparent p-2 my-3 w-11/12 outline-none" type="password" name="password" placeholder="Password">
                <i class="changePasswordVisibility fa-solid fa-eye absolute top-3 right-0 border border-s-0 px-4 py-3"></i>
            </div>

            <div class="">
                <button type="submit" name="submit" class="bg-green-700 w-fit mt-5 px-5 py-1 rounded-sm text-xl me-16">Log in</button>
                <span class="mt-5 ms-auto">Don't have an account? <a href="signUp.php" class="text-green-600">Sign Up</a> </span>
            </div>
        </form>
    </div>
</body>
<script>
    let changePasswordVisibilityBtn = document.querySelector('.changePasswordVisibility')

    changePasswordVisibilityBtn.addEventListener('click', function() {
        let password = document.querySelector('.passwordInput');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye')
        this.classList.toggle('fa-eye-slash');
    })
</script>

</html>
