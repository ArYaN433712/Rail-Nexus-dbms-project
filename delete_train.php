<?php
include "connect.php";

$id = $_GET['id'];

$sql = "DELETE FROM Train WHERE Train_ID=$id";

$conn->query($sql);

header("Location: view_trains.php");
?>
