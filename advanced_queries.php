<?php
include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Advanced SQL - RailNexus</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f7f9fc; font-family: Arial; }
.card { margin-bottom: 25px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
</style>

</head>
<body class="p-4">

<h2 class="text-center mb-4">🚆 RailNexus — Advanced SQL Queries</h2>

<div class="container">

<!-- QUERY 1 -->
<div class="card p-3">
<h4>1️⃣ Most Expensive Train (Maximum Seats)</h4>
<?php
$q1 = $conn->query("
SELECT Train.Train_Name, COUNT(Seat.Seat_ID) AS total_seats
FROM Train
JOIN Coach ON Train.Train_ID = Coach.Train_ID
JOIN Seat ON Coach.Coach_ID = Seat.Coach_ID
GROUP BY Train.Train_ID
ORDER BY total_seats DESC
LIMIT 1;
");
echo "<table class='table table-bordered mt-3'>";
echo "<tr><th>Train Name</th><th>Total Seats</th></tr>";
while($r = $q1->fetch_assoc()){
    echo "<tr><td>{$r['Train_Name']}</td><td>{$r['total_seats']}</td></tr>";
}
echo "</table>";
?>
</div>

<!-- QUERY 2 -->
<div class="card p-3">
<h4>2️⃣ Daily Booking Count</h4>
<?php
$q2 = $conn->query("
SELECT Journey_Date, COUNT(*) AS total_bookings
FROM Booking
GROUP BY Journey_Date
ORDER BY Journey_Date;
");
echo "<table class='table table-bordered mt-3'>";
echo "<tr><th>Date</th><th>Total Bookings</th></tr>";
while($r = $q2->fetch_assoc()){
    echo "<tr><td>{$r['Journey_Date']}</td><td>{$r['total_bookings']}</td></tr>";
}
echo "</table>";
?>
</div>

<!-- QUERY 3 -->
<div class="card p-3">
<h4>3️⃣ Fully Booked Trains</h4>
<?php
$q3 = $conn->query("
SELECT t.Train_Name
FROM Train t
JOIN Coach c ON t.Train_ID = c.Train_ID
JOIN Seat s ON c.Coach_ID = s.Coach_ID
GROUP BY t.Train_ID
HAVING SUM(CASE WHEN s.Availability_Status = 'Available' THEN 1 ELSE 0 END) = 0;
");

echo "<table class='table table-bordered mt-3'>";
echo "<tr><th>Train Name</th></tr>";
while($r = $q3->fetch_assoc()){
    echo "<tr><td>{$r['Train_Name']}</td></tr>";
}
echo "</table>";
?>
</div>

<!-- QUERY 4 -->
<div class="card p-3">
<h4>4️⃣ Route of a Train (ID = 2)</h4>
<?php
$q4 = $conn->query("
SELECT t.Train_Name, s.Station_Name, r.Arrival_Time, r.Departure_Time, r.Stop_Number
FROM Route r
JOIN Train t ON t.Train_ID = r.Train_ID
JOIN Station s ON s.Station_ID = r.Station_ID
WHERE t.Train_ID = 2
ORDER BY r.Stop_Number ASC;
");

echo "<table class='table table-bordered mt-3'>";
echo "<tr><th>Train</th><th>Station</th><th>Arrival</th><th>Departure</th><th>Stop No.</th></tr>";
while($r = $q4->fetch_assoc()){
    echo "<tr>
        <td>{$r['Train_Name']}</td>
        <td>{$r['Station_Name']}</td>
        <td>{$r['Arrival_Time']}</td>
        <td>{$r['Departure_Time']}</td>
        <td>{$r['Stop_Number']}</td>
    </tr>";
}
echo "</table>";
?>
</div>

<!-- QUERY 5 -->
<div class="card p-3">
<h4>5️⃣ Train-Wise Revenue Summary</h4>
<?php
$q5 = $conn->query("
SELECT t.Train_Name, SUM(p.Payment_Amount) AS total_revenue
FROM Payment p
JOIN Booking b ON p.Booking_ID = b.Booking_ID
JOIN Train t ON b.Train_ID = t.Train_ID
WHERE p.Payment_Status = 'Paid'
GROUP BY t.Train_Name;
");

echo "<table class='table table-bordered mt-3'>";
echo "<tr><th>Train Name</th><th>Total Revenue (₹)</th></tr>";
while($r = $q5->fetch_assoc()){
    echo "<tr><td>{$r['Train_Name']}</td><td>{$r['total_revenue']}</td></tr>";
}
echo "</table>";
?>
</div>


</div>

</body>
</html>
