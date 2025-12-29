<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Coach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Add Coach</h3>

        <form method="POST">

            <div class="mb-3">
                <label>Coach Type</label>
                <select class="form-control" name="coach_type">
                    <option>AC</option>
                    <option>Sleeper</option>
                    <option>General</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Capacity</label>
                <input type="number" class="form-control" name="capacity" required>
            </div>

            <div class="mb-3">
                <label>Select Train</label>
                <select class="form-control" name="train_id" required>
                    <option>Select Train</option>
                    <?php
                        $result = $conn->query("SELECT Train_ID, Train_Name FROM Train");
                        while($row=$result->fetch_assoc()){
                            echo "<option value='".$row['Train_ID']."'>".$row['Train_Name']."</option>";
                        }
                    ?>
                </select>
            </div>

            <button class="btn btn-primary w-100" name="submit">Add Coach</button>

        </form>
    </div>
</div>
</body>
</html>


<?php
if(isset($_POST['submit'])){
    $type = $_POST['coach_type'];
    $cap = $_POST['capacity'];
    $train = $_POST['train_id'];

    $sql = "INSERT INTO Coach(Coach_Type, Capacity, Train_ID)
            VALUES('$type', '$cap', '$train')";

    if($conn->query($sql)){
        echo "<script>alert('Coach Added Successfully');</script>";
    }
}
?>

