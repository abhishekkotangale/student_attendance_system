<?php
session_start();
include '../config/connection.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $currentDateTime = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM admin_login WHERE reset_token = '$token' AND reset_token_expiry > '$currentDateTime'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['new_password'];
            $user = mysqli_fetch_assoc($result);
            $adminId = $user['id'];
            $sql = "UPDATE admin_login SET password = '$newPassword', reset_token = NULL, reset_token_expiry = NULL WHERE id = $adminId";
            mysqli_query($conn, $sql);

            echo "<center style='margin-top:120px;'><h2>Password reset successfully. You can now <a href='../index.html'>login</a> with your new password.</h2>";
            exit();
        }
    } else {
        echo "Invalid or expired token.";
        exit();
    }
} else {
    echo "Token not provided.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand mx-auto font-weight-bold" href="../index.html"><h2>Student Attendance Management</h2></a>
        </div>
    </nav>
    <center>
    <h2 class="p-5">Reset Password</h2>
    <form method="post" action="">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
    </center>
</body>
</html>
