<?php
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Make Payment</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background-color: #f5f7fa;
        font-family: 'Segoe UI', sans-serif;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }
</style>

</head>

<body>

<div class="container mt-5">
    <div class="card p-4 col-md-6 mx-auto">
        <h3 class="text-center mb-4"><i class="bi bi-credit-card-fill me-2"></i>Make Payment</h3>

        <!-- ⭐ Payment Form -->
        <form method="POST">

            <!-- Booking ID -->
            <label class="form-label">Booking ID</label>
            <select name="booking_id" class="form-select" required>
                <?php
                // If redirected from booking page
                if (isset($_GET['booking_id'])) {
                    echo "<option value='".$_GET['booking_id']."' selected>Booking ".$_GET['booking_id']."</option>";
                }

                // Load all unpaid bookings
                $b = $conn->query("SELECT Booking_ID FROM Booking WHERE Booking_Status='Confirmed'");
                while ($row = $b->fetch_assoc()) {
                    echo "<option value='".$row['Booking_ID']."'>Booking ".$row['Booking_ID']."</option>";
                }
                ?>
            </select>

            <!-- Payment Method -->
            <label class="form-label mt-3">Payment Method</label>
            <select name="method" class="form-select" required>
                <option value="UPI">UPI</option>
                <option value="Debit Card">Debit Card</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Net Banking">Net Banking</option>
            </select>

            <!-- Amount -->
            <label class="form-label mt-3">Amount (₹)</label>
            <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required>

            <button name="pay" class="btn btn-primary w-100 mt-4 py-2 fs-5">
                <i class="bi bi-cash-stack me-2"></i>Pay Now
            </button>

        </form>

        <?php
        if (isset($_POST['pay'])) {
            $booking = $_POST['booking_id'];
            $method = $_POST['method'];
            $amount = $_POST['amount'];

            // Insert payment
            $insert = $conn->query("
                INSERT INTO Payment(Booking_ID, Payment_Method, Payment_Amount, Payment_Status, Transaction_Date)
                VALUES ('$booking', '$method', '$amount', 'Paid', NOW())
            ");

            // Update booking status
            $conn->query("UPDATE Booking SET Booking_Status='Paid' WHERE Booking_ID='$booking'");

            echo "<script>
                    alert('Payment Successful!');
                    window.location='index.html';
                  </script>";
        }
        ?>

    </div>
</div>

</body>
</html>

