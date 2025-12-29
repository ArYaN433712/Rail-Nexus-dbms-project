<?php
// START SESSION ONLY IF NOT ALREADY STARTED
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("connect.php");

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query admin table
    $query = $conn->query("
        SELECT * FROM admin 
        WHERE username='$username' 
        AND password='$password'
    ");

    if ($query->num_rows == 1) {

        $_SESSION['admin'] = $username;

        echo "<script>
                alert('Login Successful!');
                window.location='admin_dashboard.php';
              </script>";
        exit;

    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>

<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css' rel='stylesheet'>

<style>
    body {
        background: #0f172a;
        font-family: 'Segoe UI';
    }
    .card {
        margin-top: 100px;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 0 25px rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
    }
    label { color: white; }
</style>

</head>
<body>
<div class="container col-md-4">
    <div class="card">

        <h3 class="text-center text-white mb-4">
            <i class="bi bi-shield-lock-fill me-2"></i>Admin Login
        </h3>

        <form method="POST">

            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control mb-3" required>

            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control mb-3" required>

            <button class="btn btn-primary w-100" name="login">Login</button>

        </form>

    </div>
</div>

</body>
</html>

