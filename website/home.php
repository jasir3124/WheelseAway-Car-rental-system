<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once ('../php-logic/config.php');
include_once ('../php-logic/header.php');
session_start();

$loggedIn = false;

if (isset ($_SESSION['car_rental_system_userId'])) {
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
    <link rel="stylesheet" href="../sass-output/home.css">
    <title>Document</title>
</head>

<body>

    <div class="heroSection relative">
        <div class="navbar flex bg-gray-950/80 p-2 px-5">
            <div class="text-white">
                <h1 class="text-xl">WheelsAway</h1>
                <p class="">Car Rentals</p>
            </div>

            <div class="linksCont ms-auto pt-3 text-white flex gap-5">
                <a href="#" class="text-lg text-green-600">Home</a>
                <a href="allCars.php" class="text-lg">All Cars</a>
                <a href="about.php" class="text-lg">About</a>
                <a href="profile.php" class="text-lg">Profile</a>
                <?php
                if ($loggedIn === false) {
                    echo "<a href='signUp.php' class='text-green-700 text-lg h-fit'>Sign Up</a>";
                }
                ?>
            </div>
        </div>

        <div class="inputHeroSection text-white">
            <h1 class="text-8xl font-bold ">Car Rentals</h1>
            <form action="../php-logic/searchForCar.php" method="post" class="flex searchCont mt-8 w-full">
                <input type="text" name="searchForCar"
                    class="searchInput w-full text-black p-4 rounded-full placeholder:text-black outline-none text-xl"
                    placeholder="Travel The Way You Want To">
                <div class="searchBtnCont bg-white flex items-center p-3">
                    <button type="submit" name="submit" class="bg-green-700 me-2 p-3 rounded-full px-5">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="infoSection p-10 h-fit">
        <h1 class="text-4xl mt-10 mb-14">Why Rent from Us</h1>
        <div class="imagesCont mt-10 grid grid-cols-3 gap-20">
            <div class="bg-green-700 w-full p-10">
                <h1 class="text-5xl mt-20 me-28 text-white">Roadside <br> Assistance</h1>
            </div>
            <div class=" w-full mt-20 relative">
                <img src="../images/home-page/about us car 1.webp" alt="" class="h-full">
                <h1 class="text-5xl me-16 text-white absolute top-10 left-3">Unlimited <br> Miles</h1>
            </div>
            <div class="mt-20 w-full grid grid-rows-2">
                <div class="bg-orange-600 me-20 mb-5 relative">
                    <img src="../images/home-page/about us car 2.jpeg" alt="" class="h-full w-full">
                    <h1 class="text-white text-5xl absolute top-10 left-2">Top-Quality <br> Vehicles</h1>
                </div>
                <div class="bg-orange-600 me-20 mt-5 p-5">
                    <h1 class="text-white text-5xl">No <br> Renting <br> Fees</h1>
                </div>
            </div>
        </div>

        <div class="flex mt-20 justify-center mb-10 items-center">
            <div class="orangeCircle bg-orange-600 rounded-full size-12 me-5"></div>
            <h1 class="text-5xl">Get to Know Us</h1>
            <a href="about.php" class="bg-green-700 rounded-full text-2xl p-2  text-white mt-1.5 ms-5">Learn More</a>
        </div>
    </div>

    <div class="pt-10" style="background-color: #F8F7F1;">
        <h1 class="text-5xl capitalize text-center pt-10">Rent your car in 2 easy steps</h1>
        <div class="grid grid-cols-2 justify-center mt-20 p-20">
            <div class="grid justify-around p-10">
                <div class="">
                    <p class="pb-4">01</p>
                    <h1 class="text-4xl pb-5 font-semibold">Reserv your ride</h1>
                    <p class="font-medium">Secure your vehicle by browsing our diverse fleet, selecting the perfect car,
                        and customizing your reservation details.
                    </p>
                </div>

                <div>
                    <p class="pb-4">02</p>
                    <h1 class="text-4xl pb-5 font-semibold">Hit the road</h1>
                    <p class="font-medium">Embark on your adventure by arriving at our convenient location, completing a
                        simple check-in process, and collecting your keys to hit the road!
                    </p>
                </div>
            </div>
            <div class=" justify-center flex">
                <img src="../images/home-page/rent_car_section_image_1.jpg" alt="" style="width: 80%;">
            </div>
        </div>

        <div class="flex mt-5 pb-10 justify-center items-center">
            <div class="orangeCircle bg-orange-600 rounded-full size-12 me-5"></div>
            <h1 class="text-5xl">Find The perfect car for you</h1>
            <a href="allCars.php" class="bg-green-700 rounded-full text-2xl p-2  text-white mt-1.5 ms-5">Learn More</a>
        </div>
    </div>

    <div class="stickyImage"></div>

    <div class="grid grid-cols-2 p-20 pb-16" style="background-color: #F8F7F1;">
        <div class="grid">
            <h1 class="capitalize text-5xl self-center">What people say <br> about us</h1>
        </div>
        <div>
            <!-- Slideshow container -->
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                    <div class="w-full">
                        <p class="font-semibold">-John D.</p>
                        <p>Fantastic Experience! <br>
                            "Renting a car from this platform was a breeze. The user-friendly interface made it easy to
                            navigate through available vehicles. The best part was the variety of cars offered, and the
                            pricing was reasonable. The pick-up and drop-off process was smooth, and the customer
                            service team was responsive. I'll definitely be using this service again!"</p>
                    </div>
                </div>

                <div class="mySlides fade">
                    <div class="w-full">
                        <p class="font-semibold">-Sarah M.</p>
                        <p>Great Selection, Easy Process
                            "I rented a car for a weekend trip, and I was impressed with the diverse selection of
                            vehicles. The booking process was straightforward, and I appreciated the transparent
                            pricing. The car was clean and well-maintained. The only reason I'm not giving it five stars
                            is that the website could use a bit more polish. Nevertheless, I had a positive experience
                            and would recommend it to others."</p>
                    </div>
                </div>

                <div class="mySlides fade">
                    <div class="w-full">
                        <p class="font-semibold">-Alex R.</p>
                        <p>Efficient and Cost-Effective
                            "Used this car rental system for a business trip, and it exceeded my expectations. The
                            reservation system is efficient, and the prices are competitive. The car was ready on time,
                            and the return process was quick. The only improvement I'd suggest is enhancing the mobile
                            responsiveness of the site. Overall, I had a pleasant experience and would use it again."
                        </p>
                    </div>
                </div>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>

            <!-- The dots/circles -->
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    </div>



    <div class="footer">
        <div class="flex mt-20 justify-center items-center">
            <div class="orangeCircle bg-orange-600 rounded-full size-12 me-5"></div>
            <h1 class="text-5xl">Follow Us @WheelsAway</h1>
        </div>
        <div class="grid grid-cols-4 w-full gap-10 px-10 pt-16">
            <div class="w-full">
                <img src="../images/home-page/footer image 1.png" alt="">
            </div>
            <div class="w-full">
                <img src="../images/home-page/footer image 2.png" alt="">
            </div>
            <div class="w-full">
                <img src="../images/home-page/footer image 3.png" alt="">
            </div>
            <div class="w-full">
                <img src="../images/home-page/footer image 4.png" alt="">
            </div>
        </div>

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

    <button onclick="backToTop()" style="display: none;" class="backToTop bg-green-600 p-3 px-5 fixed right-10 bottom-10 z-50 text-white rounded-3xl text-xl">Back To
        Top</button>
</body>

</html>
<script src="../anime-master/lib/anime.js"></script>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

    let mybutton = document.querySelector(".backToTop");

    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 250 ||
            document.documentElement.scrollTop > 250
        ) {
            mybutton.style.display = "block";
            anime({
                targets: ".backToTop",
                translateX : -10,
                  easing: 'easeInOutQuad'
            })
        } else {
            anime({
                targets: ".backToTop",
                translateX : 300,
                easing: 'easeInOutQuad' 
            })
        }
    }
    function backToTop() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>