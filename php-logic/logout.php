<?php
session_start();
unset($_SESSION['car_rental_system_userId']);
header("Location: /projekte/rental car system/website/home.php");