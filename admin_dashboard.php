<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand">Admin Dashboard</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</nav>

<div class="container mt-5">

<div class="row g-4">

    <div class="col-md-4">
        <a href="add_train.php" class="btn btn-primary w-100 p-3">Add Train</a>
    </div>

    <div class="col-md-4">
        <a href="view_trains.php" class="btn btn-success w-100 p-3">View / Delete Train</a>
    </div>

    <div class="col-md-4">
        <a href="add_coach.php" class="btn btn-warning w-100 p-3">Add Coach</a>
    </div>

    <div class="col-md-4">
        <a href="add_seat.php" class="btn btn-info w-100 p-3">Add Seat</a>
    </div>

    <div class="col-md-4">
        <a href="add_route.php" class="btn btn-secondary w-100 p-3">Add Route</a>
    </div>

</div>

</div>

</body>
</html>
