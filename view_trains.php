<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Trains</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Train List</h2>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Train Name</th>
            <th>Type</th>
            <th>Coaches</th>
            <th>Seats</th>
            <th>Action</th>
        </tr>

        <?php
        $sql = "SELECT * FROM Train";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            echo "
            <tr>
                <td>{$row['Train_ID']}</td>
                <td>{$row['Train_Name']}</td>
                <td>{$row['Train_Type']}</td>
                <td>{$row['Total_Coaches']}</td>
                <td>{$row['Total_Seats']}</td>
                <td>
                    <a href='delete_train.php?id={$row['Train_ID']}' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
