<?php

session_start();
include '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $sql = "SELECT * FROM admin_login WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $resetToken = bin2hex(random_bytes(32));

        $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $sql = "UPDATE admin_login SET reset_token = '$resetToken', reset_token_expiry = '$expiryTime' WHERE email = '$email'";
        mysqli_query($conn, $sql);

        $resetLink = "localhost/student_attendance_system/authentication/admin_reset_password.php?token=$resetToken";
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: $resetLink";

        mail($email, $subject, $message);

        echo "<center style='margin-top:120px;'><h2>Password reset link sent via email. Check your inbox.</h2><center>";
        exit();
    } else {
        echo "Email not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand mx-auto font-weight-bold" href="../index.html"><h2>Student Attendance Management</h2></a>
        </div>
    </nav>
    <center>
    <h2 class="p-5">Forgot Password</h2>
    <form method="post" action="">
        <label for="email"><h5>Email:</h5></label>
        <input type="email" name="email" required>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </center>
</body>
</html>
