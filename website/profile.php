<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../php-logic/config.php');
include_once('../php-logic/header.php');
session_start();

$loggedIn = false;
$userData = [];

if (isset($_SESSION['car_rental_system_userId'])) {
    $id = $_SESSION['car_rental_system_userId'];

    $sql = "SELECT * FROM users WHERE userID = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if ($stmt && mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $userData = mysqli_fetch_assoc($result);

            if (is_array($userData) && count($userData) > 0) {
                $loggedIn = true;
            } else {
                $loggedIn = false;
                $userData = [];
            }
        } else {
            $loggedIn = false;
        }
    } else {
        $loggedIn = false;
    }
} else {
    $loggedIn = false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sass-output/profile.css">
    <title>Document</title>
    <script src="../anime-master/lib/anime.js"></script>
    <script src="profileScript.js"></script>
</head>

<body style="background-color: #F4F6FF;">
    <?php
    if ($loggedIn == false) {
        echo "<div class='loginCard'>";
        echo "<h1 class='text-xl'>Your aren't Logged In </h1>";
        echo "<div class='flex justify-around mt-2'><a class='text-green-600' href='signup.php' class=''>Sign Up</a> <a class='text-green-600' href='login.php' class=''>Log In</a></div>";
        echo "</div>";
    }
    ?>

    <div class="navbar w-full flex bg-gray-950 p-2 px-5">
        <div class="text-white">
            <h1 class="text-xl">WheelsAway</h1>
            <p class="">Car Rentals</p>
        </div>

        <div class="linksCont ms-auto pt-3 text-white flex gap-5">
            <a href="home.php" class="text-lg">Home</a>
            <a href="allCars.php" class="text-lg">All Cars</a>
            <a href="about.php" class="text-lg">About</a>
            <a href="" class="text-lg text-green-600">Profile</a>
        </div>
    </div>


    <div style="<?php echo ($loggedIn ? 'display: block;' : 'display: none;'); ?>">
        <div class="header bg-green-700 w-full flex items-end pb-5 ps-10">
            <?php
            echo "<div>";
            echo "<h1 class='headerInfo text-white text-3xl font-semibold'> Hello " . ($loggedIn ? $userData['username'] : 'Unknown User') . "</h1>";
            echo "<h1 class='headerInfo text-white'>" . ($loggedIn ? $userData['email'] : 'Unknown User') . "</h1>";
            echo "</div>";
            ?>
        </div>


        <div class="flex m-20">
            <div class="sidebar ps-3 pt-5 pb-5 rounded-xl grid" style="background-color: #fff;">
                <div>
                    <button type="button" class="profileSettingsBtn active mb-5 text-lg h-fit w-fit" onclick="showAccountInfo()" id="profileSettingsBtn">Profile Settings</button> <br>
                    <button type="button" class="rentedCarBtn mb-5 text-lg h-fit w-fit" onclick="showRentedCar()" id="rentedCarBtn">Rented Car</button> <br>
                    <?php
                    $isAdmin = $userData['admin'];
                    if ($isAdmin == 1) {
                        echo "<a class='mb-5 text-lg h-fit w-fit' href='adminDashboard.php'>Dashboard</a>";
                    }
                    ?>
                </div>
                <div class="self-end">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a class="" href="../php-logic/logout.php">Sign Out</a>
                </div>
            </div>


            <!-- account info -->
            <div class="accountInfo ms-10 w-full">
                <h1 class="text-3xl mb-10">Profile Settings</h1>
                <div class="grid grid-cols-2">
                    <div class="p-10 rounded-xl" style="background-color: #fff;">
                        <h1 class="text-3xl">My account info</h1>
                        <?php
                        if (isset($_SESSION['update_user_error_message'])) {
                            echo '<p class="text-red-500">' . $_SESSION['update_user_error_message'] . '</p>';
                            unset($_SESSION['update_user_error_message']);
                        }
                        if (isset($_SESSION['update_user_success_message'])) {
                            echo "
                            <div class='rentedPopUp border-1 shadow-lg w-fit p-5 absolute bg-white grid justify-center' style='left: 50%; top: 50%; transform:translate(-50%, -50%)'>
                            <div class='relative'>
                                <i onClick='closePopUp()' class='fa-solid fa-xmark absolute -right-2 -top-5 text-xl'></i>
                                <p class='mt-1'>" . $_SESSION['update_user_success_message'] . "</p>
                            </div>
                        </div>
                        ";
                            unset($_SESSION['update_user_success_message']);
                        }
                        ?>
                        <form action="/projekte/rental car system/php-logic/updateUserData.php" method="post" class="grid" id="updateForm">

                            <label class="mt-5 font-semibold text-lg" for="username">Username</label>
                            <input class="bg-white border-2 p-1 px-2 rounded-md mt-2" name="username" type="text" value="<?php echo $userData['username'] ?>">

                            <label class="mt-5 font-semibold text-lg" for="first_name">First Name</label>
                            <input class="bg-white border-2 p-1 px-2 rounded-md mt-2" name="first_name" type="text" value="<?php echo $userData['first_name'] ?>">

                            <label class="mt-5 font-semibold text-lg" for="last_name">Last Name</label>
                            <input class="bg-white border-2 p-1 px-2 rounded-md mt-2" name="last_name" type="text" value="<?php echo $userData['last_name'] ?>">

                            <label class="mt-5 font-semibold text-lg" for="email">Email</label>
                            <input class="bg-white border-2 p-1 px-2 rounded-md mt-2" name="email" type="text" value="<?php echo $userData['email'] ?>">

                            <div class="mt-6 flex justify-between">
                                <button type="submit" name="submit" class=" bg-green-700 w-fit text-center px-4 py-2 rounded-md text-white">Save
                                    Changes</button>
                                <button type="button" class="w-fit text-green-600 border border-green-600 px-4 py-2 rounded-md" onclick="resetForm()">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white ms-10 p-10 h-fit rounded-xl">
                        <h1 class="text-3xl">Update Password</h1>
                        <p class="mt-2 text-gray-400">Enter your current password to update the password </p>
                        <?php
                        if (isset($_SESSION['change_password_error_message'])) {
                            echo '<p class="text-red-500">' . $_SESSION['change_password_error_message'] . '</p>';
                            unset($_SESSION['change_password_error_message']);
                        }
                        if (isset($_SESSION['change_password_success_message'])) {
                            echo "
                            <div class='rentedPopUp border-1 shadow-lg w-fit p-5 absolute bg-white grid justify-center' style='left: 50%; top: 50%; transform:translate(-50%, -50%)'>
                            <div class='relative'>
                                <i onClick='closePopUp()' class='fa-solid fa-xmark absolute -right-2 -top-5 text-xl'></i>
                                <p class='mt-1'>" . $_SESSION['change_password_success_message'] . "</p>
                            </div>
                        </div>
                        ";
                            unset($_SESSION['change_password_success_message']);
                        }
                        ?>
                        <form action="../php-logic/changePassword.php" method="post" class="mt-5 grid">

                            <label class="font-semibold text-lg" for="currentPassword">Current Passwrod</label>
                            <div class="relative">
                                <input name="currentPassword" class="passwordInput outline-none bg-white border-2 border-e-0 p-1 px-2 pe-4 rounded-md rounded-e-none mt-2 " type="password" placeholder="Enter current password">
                                <i class="changePasswordVisibility fa-solid fa-eye text-black absolute top-2 right-0 px-3 py-2 ps-5 border-2 border-s-0"></i>
                            </div>

                            <label class="font-semibold text-lg mt-10" for="newPassword">New Passwrod</label>
                            <div class="relative">
                                <input name="newPassword" class="passwordInput outline-none bg-white border-2 border-e-0 p-1 px-2 pe-4 rounded-md rounded-e-none mt-2 " type="password" placeholder="Enter New password">
                                <i class="changePasswordVisibility fa-solid fa-eye text-black absolute top-2 right-0 px-3 py-2 ps-5 border-2 border-s-0"></i>
                            </div>

                            <button type="submit" name="submit" class=" bg-green-700 w-fit text-center px-4 py-2 rounded-md text-white mt-6">Update
                                password</button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Rented car -->
            <div class="rentedCar w-full">
                <div class="ms-10">
                    <?php
                    $rented = $userData['has_rented'];
                    if ($rented == 0) {
                        echo "
                                <div>
                                    <h1 class='text-3xl mb-5'>You haven't rented a car</h1>
                                    <a class='border border-green-600 text-green-600 bg-white px-5 py-2 rounded-md hover:bg-green-600 hover:text-white  duration-200' href='allCars.php'>Rent a Car</a>
                                </div>
                            ";
                        exit();
                    }

                    $rentedCarId = $userData['rented_car_id'];
                    $sql = "SELECT * FROM cars WHERE id = $rentedCarId";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);


                    echo '
                        <h1 class="text-3xl mb-5">Your rented car</h1>
                        <div class="cardCont w-full bg-white p-10 rounded-lg">                        
                            <div class="w-full grid justify-center">           
                                <div class="flex">
                                    <div>
                                        <img class="rentedCarImage rounded-lg overflow-hidden" src="' . "../" . $row['image_path'] . '" alt="car image">
                                    </div>

                                    <div class="ms-5 grid grid-rows-4 items-center">
                                        <h1 class="text-2xl ms-5">' . $row['car_name'] . " " . $row['car_year'] . ' </h1> 
                                        <p class="text-xl ms-5">' . $row['car_model'] . '</p>
                                        <p class="text-xl ms-5">' . $row['costPerDay'] . ' per Week </p>
                                        <a class="text-xl ms-5 bg-green-700 text-white px-4 py-2 rounded-md text-center" href="../php-logic/unrentCar.php?carID=' . $row['id'] . '">Return car</a>
                                    </div>
                                </div>       
                            </div>
                        </div>
                        ';

                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        let popup = document.querySelector('.rentedPopUp')

        function closePopUp() {
            popup.style.display = 'none';
        }


        (function() {
            let changePasswordVisibilityBtns = document.querySelectorAll('.changePasswordVisibility');

            changePasswordVisibilityBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    let password = this.previousElementSibling; // Find the previous sibling which is the input
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            });
        })();
    </script>
</body>



</html>