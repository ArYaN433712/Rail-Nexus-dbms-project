<?php include "connect.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Register Passenger</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 shadow">

<h3 class="text-center mb-4">Passenger Registration</h3>

<form method="POST">

    <input type="text" name="name" class="form-control mb-3" placeholder="Name">
    <input type="number" name="age" class="form-control mb-3" placeholder="Age">
    <input type="text" name="gender" class="form-control mb-3" placeholder="Gender">
    <input type="text" name="contact" class="form-control mb-3" placeholder="Contact Number">
    <input type="email" name="email" class="form-control mb-3" placeholder="Email">
    <input type="text" name="address" class="form-control mb-3" placeholder="Address">

    <button class="btn btn-success w-100" name="submit">Register</button>
</form>

</div>
</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // SQL INSERT
    $sql = "INSERT INTO Passenger (Name, Age, Gender, Contact_Number, Email_ID, Address)
            VALUES ('$name', '$age', '$gender', '$contact', '$email', '$address')";

    if($conn->query($sql)){
        echo "<script>alert('Passenger Registered');</script>";
    }
}
?>
