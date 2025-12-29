<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Train</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            min-height: 100vh;
        }
        .card {
            border-radius: 18px;
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.2);
            padding: 25px;
            color: white;
        }
        label {
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="card shadow-lg">
        <h3 class="text-center mb-4">
            <i class="bi bi-train-front-fill"></i> Add Train
        </h3>

        <form method="POST">

            <!-- Train Name -->
            <div class="mb-3">
                <label>Train Name</label>
                <input type="text" class="form-control" name="train_name" placeholder="Enter Train Name" required>
            </div>

            <!-- Train Type -->
            <div class="mb-3">
                <label>Train Type</label>
                <select class="form-control" name="train_type" required>
                    <option value="">Select Type</option>
                    <option>Express</option>
                    <option>Superfast</option>
                    <option>Rajdhani</option>
                    <option>Shatabdi</option>
                    <option>Duronto</option>
                    <option>Local</option>
                    <option>Vande Bharat</option>
                </select>
            </div>

            <!-- Total Coaches -->
            <div class="mb-3">
                <label>Total Coaches</label>
                <input type="number" class="form-control" name="total_coaches" placeholder="e.g. 20" required>
            </div>

            <!-- Total Seats -->
            <div class="mb-3">
                <label>Total Seats</label>
                <input type="number" class="form-control" name="total_seats" placeholder="e.g. 1200" required>
            </div>

            <!-- Submit Button -->
            <button class="btn btn-success w-100 btn-lg" name="submit">
                <i class="bi bi-check2-circle"></i> Add Train
            </button>

        </form>

    </div>
</div>

</body>
</html>

<?php
// -------- INSERT LOGIC ---------
if(isset($_POST['submit'])){
    $name    = $_POST['train_name'];
    $type    = $_POST['train_type'];
    $coaches = $_POST['total_coaches'];
    $seats   = $_POST['total_seats'];

    $sql = "INSERT INTO Train(Train_Name, Train_Type, Total_Coaches, Total_Seats)
            VALUES('$name', '$type', '$coaches', '$seats')";

    if($conn->query($sql)){
        echo "<script>alert('Train Added Successfully!'); window.location='add_train.php';</script>";
    }
    else{
        echo "<script>alert('Error adding train');</script>";
    }
}
?>


