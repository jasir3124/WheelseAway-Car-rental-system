<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../php-logic/config.php');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database
$sql = "SELECT * FROM cars WHERE status = 'rented'";
$result = mysqli_query($conn, $sql);

// Convert data to JSON format
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Output JSON
echo json_encode($data);