<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../php-logic/config.php');
include_once('../php-logic/header.php');
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


$carData = [];

if (isset($_SESSION['car_rental_car_search'])) {
    $carData = $_SESSION['car_rental_car_search'];
} else {

    $sql = 'SELECT * FROM cars';
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $carData[] = $row;
    }
}


$totalCars = count($carData);

$perPage = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

$paginatedCarData = array_slice($carData, $offset, $perPage);

$totalPages = ceil(count($carData) / $perPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sass-output/allCars.css">
    <title>Document</title>
</head>

<body>
    <div class="navbar flex bg-gray-950/80 p-2 px-5">
        <div class="text-white">
            <h1 class="text-xl">WheelsAway</h1>
            <p class="">Car Rentals</p>
        </div>

        <div class="linksCont ms-auto pt-3 text-white flex gap-5">
            <a href="home.php" class="text-lg">Home</a>
            <a href="#" class="text-lg text-green-600">All Cars</a>
            <a href="about.php" class="text-lg">About</a>
            <a href="profile.php" class="text-lg">Profile</a>
            <?php
            if ($loggedIn === false) {
                echo "<a href='signUp.php' class='text-green-700 text-lg h-fit'>Sign Up</a>";
            }
            ?>
        </div>
    </div>



    <?php
    if ($loggedIn == false) {
        echo "<div class='loginCard'>";
        echo "<h1 class='text-xl'>Your aren't Logged In </h1>";
        echo "<div class='flex justify-around mt-2'><a class='text-green-600' href='signup.php' class=''>Sign Up</a> <a class='text-green-600' href='login.php' class=''>Log In</a></div>";
        echo "</div>";
    }
    ?>

    <div style="<?php echo ($loggedIn ? 'display: block;' : 'display: none;'); ?>">
        <form action="../php-logic/searchForCar.php" method="post" class="flex justify-between searchCont mt-8 ps-12 relative w-full">
            <div class="flex">
                <input name="searchForCar" type="text" class="searchInput  text-black p-4 rounded-full placeholder:text-black outline-none text-xl" placeholder="Search for a car">
                <div class="searchBtnCont bg-white flex items-center p-3">
                    <button type="submit" name="submit" class="bg-green-700 text-white me-2 p-3 rounded-full px-5">Search</button>
                    <button type="submit" name="cancel" class="text-nowrap border-2 border-green-600 me-2 p-2.5 rounded-full px-5">Show All Cars</button>
                </div>
            </div>
            <div class="filterContainer mt-4 pe-14">
                <button type="button" class="dropdownBtn border-2 px-4 py-1 text-lg text-green-600 hover:text-white hover:bg-green-600 hover:border-green-600 transition-colors self-center"><i class="fa-solid fa-filter"></i> Filter</button>
                <div class="checkBoxDropdown absolute hidden grid-cols-2 bg-slate-500 z-50 right-14 gap-14 text-black pt-3 px-4 rounded-md">
                    <div class="grid p-3">
                        <p class="text-2xl mb-2 text-white">Price</p>
                        <div>
                            <label class="priceCheckbox text-white" for="priceCheckbox1">
                                <span class="label me-2 text-lg my-4">Under 100$</span>
                                <input name="priceCheckbox" value="100$" id="priceCheckbox1" type="radio" class="size-4">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="priceCheckbox text-white" for="priceCheckbox2">
                                <span class="label me-2 text-lg my-4">Under 150$</span>
                                <input name="priceCheckbox" value="150$" id="priceCheckbox2" type="radio" class="size-4">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="priceCheckbox text-white" for="priceCheckbox3">
                                <span class="label me-2 text-lg my-4">Under 200$</span>
                                <input name="priceCheckbox" value="200$" id="priceCheckbox3" type="radio" class="size-4">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="grid p-3">
                        <p class="text-2xl mb-2 text-white">Year</p>
                        <div>
                            <label class="yearCheckbox text-white" for="yearCheckbox1">
                                <span class="label me-2 text-lg my-4">2021</span>
                                <input name="yearCheckbox" value="2021" id="yearCheckbox1" type="radio" class="size-4">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="yearCheckbox text-white" for="yearCheckbox2">
                                <span class="label me-2 text-lg my-4">2022</span>
                                <input name="yearCheckbox" value="2022" id="yearCheckbox2" type="radio" class="size-4">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="yearCheckbox text-white" for="yearCheckbox3">
                                <span class="label me-2 text-lg my-4">2023</span>
                                <input name="yearCheckbox" value="2023" id="yearCheckbox3" type="radio" class="size-4">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
        if (isset($_SESSION['car_rental_car_search_result'])) {
            echo '<h1 class="text-xl ms-12 mt-5"> ' . $_SESSION['car_rental_car_search_result'] . '</h1>';
            unset($_SESSION['car_rental_car_search_result']);
        }
        ?>
        <div class="grid grid-cols-3 w-full mt-10">
            <?php
            $userID = $_SESSION['car_rental_system_userId'];
            $sql = "SELECT * FROM users WHERE userID = $userID";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);
            $lastRentedCar = $data['rented_car_id'];

            foreach ($paginatedCarData as $row) {
                // Check if the car status is available or rented
                $buttonText = ($row['status'] == 'available') ? 'Rent' : 'Unavailable';
                $buttonClass = ($row['status'] == 'available') ? 'bg-green-700' : 'bg-red-700';
                $buttonLink = ($row['status'] == 'available') ? 'carForRent.php?carId=' . $row['id'] : '#';

                // Check if the car is rented by the logged-in user
                if ($lastRentedCar != null && $lastRentedCar == $row['id']) {
                    $buttonText = 'Rented';
                    $buttonClass = 'bg-gray-500'; // You can customize this to fit your design
                    $buttonLink = '#'; // No need for a link if the car is already rented
                }

                echo '
        <div class="w-full grid justify-center mb-10">           
            <div class="carCard pb-3">
                <img src="' . "../" . $row['image_path'] . '" alt="car image">
                <h1 class="text-2xl mt-5 ms-5">' . $row['car_name'] . " " . $row['car_year'] . ' </h1> 
                <p class="text-lg ms-5 mt-4 mb-2">' . $row['car_model'] . '</p>
                <p class="text-lg ms-5 mt-2 mb-2">' . $row['costPerDay'] . ' per Week </p>
                <a href="' . $buttonLink . '" class="ms-5 text-lg">
                    <button class="' . $buttonClass . ' text-white px-5 mt-5">' . $buttonText . '</button>
                </a>
            </div>           
        </div>
    ';
            }

            unset($_SESSION['car_rental_car_search']);
            ?>


        </div>

        <div class="flex justify-center mt-5">
            <?php
            if ($page > 1) {
                echo '<a class="bg-green-600 px-5 mb-5 text-xl py-2 text-white rounded-lg" href="?page=' . ($page - 1) . '" class="text-lg">Previous Page</a>';
            }
            if ($page < $totalPages) {
                echo '<a class="bg-green-600 px-5 mb-5 text-xl py-2 text-white rounded-lg" href="?page=' . ($page + 1) . '" class="text-lg">Next Page</a>';
            }
            ?>
        </div>
    </div>
</body>
<script>
    let DropdownBtn = document.querySelector('.dropdownBtn')
    let dropdown = document.querySelector('.checkBoxDropdown')

    DropdownBtn.addEventListener('click', function() {
        dropdown.classList.toggle('grid')
        dropdown.classList.toggle('hidden')
    })

    dropdown.addEventListener('mouseleave', function() {
        this.classList.toggle('grid')
        this.classList.toggle('hidden')
    })



    // const priceCheckboxes = document.querySelectorAll('.priceCheckbox input[type="checkbox"]');

    // priceCheckboxes.forEach(checkbox => {
    //     checkbox.addEventListener('change', function() {
    //         if (this.checked) {
    //             priceCheckboxes.forEach(otherCheckbox => {
    //                 if (otherCheckbox !== checkbox) {
    //                     otherCheckbox.checked = false;
    //                 }
    //             });
    //         }
    //     });
    // });

    // const yearCheckboxes = document.querySelectorAll('.yearCheckbox input[type="checkbox"]');

    // yearCheckboxes.forEach(checkbox => {
    //     checkbox.addEventListener('change', function() {
    //         if (this.checked) {
    //             yearCheckboxes.forEach(otherCheckbox => {
    //                 if (otherCheckbox !== checkbox) {
    //                     otherCheckbox.checked = false;
    //                 }
    //             });
    //         }
    //     });
    // });
</script>

</html>