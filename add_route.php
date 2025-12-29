<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Route</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Add Train Route</h3>

        <form method="POST">

            <div class="mb-3">
                <label>Select Train</label>
                <select class="form-control" name="train_id" required>
                    <option>Select Train</option>
                    <?php
                    $result = $conn->query("SELECT Train_ID, Train_Name FROM Train");
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['Train_ID']."'>".$row['Train_Name']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Select Station</label>
                <select class="form-control" name="station_id" required>
                    <option>Select Station</option>
                    <?php
                    $result = $conn->query("SELECT Station_ID, Station_Name FROM Station");
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['Station_ID']."'>".$row['Station_Name']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Arrival Time</label>
                <input type="time" class="form-control" name="arrival" required>
            </div>

            <div class="mb-3">
                <label>Departure Time</label>
                <input type="time" class="form-control" name="departure" required>
            </div>

            <div class="mb-3">
                <label>Stop Number</label>
                <input type="number" class="form-control" name="stop" required>
            </div>

            <button class="btn btn-primary w-100" name="submit">Add Route</button>

        </form>
    </div>
</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
    $train = $_POST['train_id'];
    $station = $_POST['station_id'];
    $arr = $_POST['arrival'];
    $dep = $_POST['departure'];
    $stop = $_POST['stop'];

    $sql = "INSERT INTO Route(Train_ID, Station_ID, Arrival_Time, Departure_Time, Stop_Number)
            VALUES('$train', '$station', '$arr', '$dep', '$stop')";

    if($conn->query($sql)){
        echo "<script>alert('Route Added Successfully');</script>";
    }
}
?>

