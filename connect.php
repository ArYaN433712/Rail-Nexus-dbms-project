<?php
// ONLY database connection should be here

$servername = "localhost";
$username = "root";
$password = "";
$database = "railway_reservation";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
