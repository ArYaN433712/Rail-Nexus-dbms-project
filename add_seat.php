<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Seat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Add Seat</h3>

        <form method="POST">

            <div class="mb-3">
                <label>Seat Number</label>
                <input type="text" class="form-control" name="seat_number" required>
            </div>

            <div class="mb-3">
                <label>Select Coach</label>
                <select class="form-control" name="coach_id" required>
                    <option>Select Coach</option>
                    <?php
                        $result = $conn->query("SELECT Coach_ID, Coach_Type FROM Coach");
                        while($row=$result->fetch_assoc()){
                            echo "<option value='".$row['Coach_ID']."'>".$row['Coach_Type']." - ID: ".$row['Coach_ID']."</option>";
                        }
                    ?>
                </select>
            </div>

            <button class="btn btn-primary w-100" name="submit">Add Seat</button>

        </form>
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $seat = $_POST['seat_number'];
    $coach = $_POST['coach_id'];

    $sql = "INSERT INTO Seat(Seat_Number, Availability_Status, Coach_ID)
            VALUES('$seat', 'Available', '$coach')";

    if($conn->query($sql)){
        echo "<script>alert('Seat Added Successfully');</script>";
    }
}
?>

