<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../php-logic/config.php');
include_once('../php-logic/header.php');
session_start();

$carId = $_GET['carId'];
if (isset($carId)) {
    $sql = "SELECT * FROM cars WHERE id = $carId";
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- rent a car result -->


    <a href="allCars.php"><i class="fa-solid fa-arrow-left fa-4x absolute top-5 left-5"></i></a>
    <?php
    if (isset($_SESSION['car_rental_system_rented_car_result'])) {
        $message = $_SESSION['car_rental_system_rented_car_result'];
        // Escape the message to prevent any issues with quotes or special characters
        $escapedMessage = htmlspecialchars($message);

        if (isset($escapedMessage)) {
            echo "
            <div class='rentedPopUp border-1 shadow-lg w-fit p-5 absolute bg-white grid justify-center' style='left: 50%; top: 50%; transform:translate(-50%, -50%)'>
                <div class='relative'>
                    <i onClick='closePopUp()' class='fa-solid fa-xmark absolute -right-2 -top-5 text-xl'></i>
                    <p class='mt-1'>". $escapedMessage . "</p>
                </div>
            </div>
        ";
        }
    }
    unset($_SESSION['car_rental_system_rented_car_result']);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="w-full flex justify-center">   
            <div class="w-fit grid justify-center mt-3 bg-zinc-300 p-5 rounded-3xl">   
                <div class="carCard pb-3">
                    <img src="' . "../" . $row['image_path'] . '" alt="car image" class="rounded-2xl overflow-hidden" style="height: 400px; width: 600px;">
                    <h1 class="text-4xl mt-5 ms-5">' . $row['car_name'] . " " . $row['car_year'] . ' </h1>
                    <h1 class="text-2xl mt-5 ms-5">' . $row['car_model'] . ' </h1>
                    <div class="flex mt-10 items-center ms-5">
                        <p class="text-3xl">' . $row['costPerDay'] . ' per Week </p>
                        <a href="../php-logic/rentCar.php?carId=' . $row['id'] . '" class="ms-5 text-xl bg-black px-5 py-2 text-white rounded-lg">Rent Now</a>  
                    </div>
                </div>           
            </div>
        </div>
                ';
    }
    ?>


<script>
    let popup = document.querySelector('.rentedPopUp')
    function  closePopUp() {
        popup.style.display = 'none';
    }
</script>
</body>

</html>