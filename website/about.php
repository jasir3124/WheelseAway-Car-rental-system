<?php
include_once('../php-logic/config.php');
include_once('../php-logic/header.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$loggedIn = false;

if (isset($_SESSION['car_rental_system_userId'])) {
    $id = $_SESSION['car_rental_system_userId'];

    $sql = "SELECT * FROM users WHERE userID = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if ($stmt && mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $loggedIn = true;
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
    <link rel="stylesheet" href="../sass-output/about.css">
    <title>Document</title>
</head>

<body>
    <div class="navbar flex bg-gray-950/80 p-2 px-5 relative" style="z-index: 9999;">
        <div class="text-white">
            <h1 class="text-xl">WheelsAway</h1>
            <p class="">Car Rentals</p>
        </div>

        <div class="linksCont ms-auto pt-3 text-white flex gap-5">
            <a href="home.php" class="text-lg">Home</a>
            <a href="allCars.php" class="text-lg">All Cars</a>
            <a href="about.php" class="text-lg text-green-600">About</a>
            <a href="profile.php" class="text-lg">Profile</a>
            <?php
            if ($loggedIn === false) {
                echo "<a href='signUp.php' class='text-green-700 text-lg h-fit'>Sign Up</a>";
            }
            ?>
        </div>
    </div>

    <div class="" style="height: 187px;">
        <img class="absolute" style="height: 350px; object-fit: cover; top: 0;" width="100%"
            src="../images/about-us-page/heroSection backgeound.jpg" alt="">
        <div class="relative w-full grid justify-center items-center mt-24 font-semibold">
            <h1 class="text-white text-6xl">Our Storie</h1>
        </div>
    </div>

    <div class="grid grid-cols-2 pt-36">
        <div class="grid justify-end">
            <div class="bg-green-800 size-60 justify-self-end mb-3">
                <h1 class="text-white text-3xl p-5 ">About Us</h1>
            </div>
            <img src="../images/about-us-page/about us image 1.jpg" width="80%" class="justify-self-end pt-16" alt="">
        </div>
        <div class="grid justify-start ms-5">
            <p class="me-64 font-semibold">At WheelsAway, we are passionate about providing an exceptional and seamless
                car
                rental experience. Our mission is to offer our customers a diverse fleet of well-maintained vehicles,
                ensuring they have the perfect ride for any occasion. Committed to convenience and customer
                satisfaction, we prioritize transparency, affordability, and reliability in every interaction.
            </p>
            <br>
            <p class="me-64 font-semibold">
                Whether
                you're planning a road trip, business travel, or simply need a temporary vehicle, WheelsAway is here to
                meet your needs. Explore our fleet, experience top-notch service, and embark
                on your journey with confidence. Your satisfaction is our priority, and we look forward to being your
                trusted partner in every mile you travel.
            </p>
            <img src="../images/about-us-page/about us image 2.jpg" width="50%" alt="" class="mt-16">
        </div>
    </div>

    <div class="footer" style="background-color: #F8F7F1;">
        <div class="grid grid-cols-2 w-full p-20 mt-10">
            <div class="w-full">
                <div>
                    <h1 class="text-3xl font-semibold">WheelsAway</h1>
                    <span class="text-lg">Car Rentals</span>
                </div>
                <div class="grid grid-cols-2 mt-10">
                    <div>
                        <p class="font-medium text-lg pb-3">Street Ilinden bb 1200</p>
                        <p class="font-medium text-lg pb-3">Tetovo 1220</p>
                        <p class="font-medium text-lg pb-3">info@mysite.com</p>
                        <p class="font-medium text-lg pb-3">123-456-789</p>
                    </div>
                    <div>
                        <p class="font-medium text-lg pb-3"><a href="#">All cars</a></p>
                        <p class="font-medium text-lg pb-3"><a href="about.php">About</a></p>
                        <p class="font-medium text-lg pb-3"><a href="profile.php">Profile</a></p>
                    </div>
                </div>
                <div>
                    <div class="flex mt-20 mb-5">
                        <i class="fa-brands fa-facebook fa-2x pe-5"></i>
                        <i class="fa-brands fa-instagram fa-2x"></i>
                    </div>
                    <p class="font-medium">&copy; 2035 by WheelsAway. Powerd and secured by Digital School</p>
                </div>
            </div>
            <div class="w-full">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5931.776834988816!2d21.057742859810357!3d41.98120541892958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1353f79c525c8d31%3A0x26dd11ba2ddf1d2b!2sZelino%2CNorth%20Macedonia!5e0!3m2!1sen!2smk!4v1709905818394!5m2!1sen!2smk"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</body>

</html>