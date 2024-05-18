<?php
include_once('../php-logic/config.php');
include_once('../php-logic/header.php');
session_start();

$lastURL = $_GET['lastURL'];
if (isset($lastURL)) {
    $_SESSION['lastURL'] = $lastURL;
} else {
    $_SESSION['lastURL'] = '/projekte/rental car system/website/home.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sass-output/signUp.css">
    <title>Document</title>
</head>

<body class="flex justify-center items-center">
    <div class="bg-gray-950/80  grid p-10 w-4/12">
        <form action="../php-logic/addUser.php" method="post" class="grid w-full text-white text-center">
            <h1 class="text-3xl mb-5 font-semibold ">Sign Up To Rent a Car</h1>
            <?php
            if (isset($_SESSION['signup_error_message'])) {
                echo "<span class='text-red-600'>" . $_SESSION['signup_error_message'] . "</span>";
                unset($_SESSION['signup_error_message']);
            }
            ?>
<input class="border bg-transparent p-2 my-3 w-full" type="text" name="first_name" placeholder="Name" value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>">

<input class="border bg-transparent p-2 my-3 w-full" type="text" name="last_name" placeholder="Last Name" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>">

<input class="border bg-transparent p-2 my-3 w-full" type="text" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

<input class="border bg-transparent p-2 my-3 w-full" type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">


            <div class="flex relative">
                <input class="passwordInput border border-e-0 bg-transparent p-2 my-3 w-11/12 outline-none" type="password" name="password" placeholder="Password">
                <i class="changePasswordVisibility fa-solid fa-eye absolute top-3 right-0 border border-s-0 px-4 py-3"></i>
            </div>

            <input class="border bg-transparent p-2 my-3 w-full" type="password" name="confirm_password" placeholder="Confirm Password">


            <div class="">
                <button type="submit" name="submit" class="bg-green-700 w-fit mt-5 px-5 py-1 rounded-sm text-xl me-16">Sign Up</button>
                <span>Already have an account? <a href="login.php" class="text-green-600">Log In</a> </span>
            </div>
            </form\>
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