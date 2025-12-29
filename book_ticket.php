<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Book Ticket</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Search & Book Train</h3>

        <!-- STEP 1: SEARCH FORM -->
        <form method="POST">
            <div class="row g-3">

                <!-- Source -->
                <div class="col-md-6">
                    <label>Source Station</label>
                    <select class="form-control" name="source" required>
                        <option value="">Select Source</option>
                        <?php
                        $stations = $conn->query("SELECT Station_ID, Station_Name FROM Station");
                        while($row = $stations->fetch_assoc()){
                            echo "<option value='".$row['Station_ID']."'>".$row['Station_Name']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Destination -->
                <div class="col-md-6">
                    <label>Destination Station</label>
                    <select class="form-control" name="destination" required>
                        <option value="">Select Destination</option>
                        <?php
                        $stations2 = $conn->query("SELECT Station_ID, Station_Name FROM Station");
                        while($row = $stations2->fetch_assoc()){
                            echo "<option value='".$row['Station_ID']."'>".$row['Station_Name']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Journey Date -->
                <div class="col-md-12">
                    <label>Journey Date</label>
                    <input type="date" class="form-control" name="date" required>
                </div>

            </div>

            <button name="search" class="btn btn-primary mt-3 w-100">Search Trains</button>
        </form>
    </div>

    <!-- STEP 2: SHOW MATCHING TRAINS -->
    <?php
    if(isset($_POST['search'])){

        $src = $_POST['source'];
        $dst = $_POST['destination'];

        echo "<h4 class='mt-4'>Available Trains</h4>";

        $sql = "
            SELECT DISTINCT Train.Train_ID, Train.Train_Name
            FROM Train
            JOIN Route r1 ON Train.Train_ID = r1.Train_ID
            JOIN Route r2 ON Train.Train_ID = r2.Train_ID
            WHERE r1.Station_ID = '$src'
              AND r2.Station_ID = '$dst'
              AND r1.Stop_Number < r2.Stop_Number
        ";

        $result = $conn->query($sql);

        if($result->num_rows == 0){
            echo "<div class='alert alert-danger mt-3'>No trains found between these stations</div>";
        }

        while($row = $result->fetch_assoc()){
            echo "
            <div class='card mt-3 p-3'>
                <h5>".$row['Train_Name']."</h5>
                <a href='book_ticket.php?train_id=".$row['Train_ID']."&date=".$_POST['date']."' class='btn btn-success mt-2'>Book Now</a>
            </div>";
        }
    }
    ?>


    <!-- STEP 3: SHOW SEAT SELECTION -->
    <?php
    if(isset($_GET['train_id'])){
        $train = $_GET['train_id'];
        $date  = $_GET['date'];
    ?>

    <div class="card shadow p-4 mt-4">
        <h4>Select Seat</h4>

        <form method="POST">

            <input type="hidden" name="train_id" value="<?php echo $train; ?>">
            <input type="hidden" name="date" value="<?php echo $date; ?>">

            <!-- Passenger -->
            <label>Passenger:</label>
            <select class="form-control mb-3" name="passenger" required>
                <option>Select Passenger</option>
                <?php
                $p = $conn->query("SELECT Passenger_ID, Name FROM Passenger");
                while($row=$p->fetch_assoc()){
                    echo "<option value='".$row['Passenger_ID']."'>".$row['Name']."</option>";
                }
                ?>
            </select>

            <!-- Seat -->
            <label>Select Seat</label>
            <select class="form-control mb-3" name="seat_id" required>
                <?php
                $seats = $conn->query("SELECT Seat_ID, Seat_Number FROM Seat WHERE Availability_Status='Available'");
                while($row=$seats->fetch_assoc()){
                    echo "<option value='".$row['Seat_ID']."'>".$row['Seat_Number']."</option>";
                }
                ?>
            </select>

            <button name="final_book" class="btn btn-success w-100">Confirm Booking</button>
        </form>
    </div>

    <?php } ?>


    <!-- STEP 4: PROCESS FINAL BOOKING -->
    <?php
    if(isset($_POST['final_book'])){

        $passenger = $_POST['passenger'];
        $train = $_POST['train_id'];
        $seat  = $_POST['seat_id'];
        $date  = $_POST['date'];

        $conn->query("
            INSERT INTO Booking(Passenger_ID, Train_ID, Seat_ID, Journey_Date, Booking_Status)
            VALUES('$passenger', '$train', '$seat', '$date', 'Confirmed')
        ");
        $booking_id=$conn->insert_id;
        $conn->query("UPDATE Seat SET Availability_Status='Booked' WHERE Seat_ID='$seat'");
        echo "<script>alert('Ticket Booked Successfully'); window.location='payment.php?booking_id=$booking_id';</script>";
    }
    ?>

</div>

</body>
</html>

