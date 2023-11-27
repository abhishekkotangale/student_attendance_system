<?php
session_start();
if ((!isset($_SESSION['admin_username']))) {
    header('location:index.html');
}
include '../config/connection.php';

if(isset($_POST['student_name']) && isset($_POST['student_email']) && isset($_POST['student_number']) && isset($_POST['student_password'])){
    $name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $email = mysqli_real_escape_string($conn, $_POST['student_email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['student_number']);
    $password = mysqli_real_escape_string($conn, $_POST['student_password']);
    $roll_number = rand(10000000, 9999999999999);
    $pass = password_hash($password, PASSWORD_BCRYPT);

    $email_check_query = "SELECT email FROM students WHERE email='$email'";
    $email_db_query = mysqli_query($conn, $email_check_query);
    $emailcount = mysqli_num_rows($email_db_query);

    if($emailcount > 0){
        echo 'email already present';
    } else {
        $insertquery = "INSERT INTO students (name, email, mobile_number, roll_no, password) VALUES ('$name', '$email', '$mobile', '$roll_number', '$pass')";
        $query = mysqli_query($conn, $insertquery);

        if ($query) {
            $subject = 'Your Login Credentials';
            $message = "Hello $name,\n\nYour login credentials are:\nEmail: $email\nPassword: $password \n roll_number : $roll_number  ";

            if (mail($email, $subject, $message)) {
                echo 'success';
            } else {
                echo 'failed to send email';
            }
        } else {
            echo 'failed to add student';
        }
    }
}
?>
