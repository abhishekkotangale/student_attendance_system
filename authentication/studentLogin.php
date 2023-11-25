<?php
session_start();
include '../config/connection.php';

if(isset($_POST['studentEmail']) && isset($_POST['pass'])){
    $email = mysqli_real_escape_string($conn, $_POST['studentEmail']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    $query = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['student_id'] = $row['sid'];
                $_SESSION['student_email'] = $row['email'];
                $_SESSION['student_name'] = $row['name'];
                echo 'success';
            } else {
                echo 'Incorrect username/password';
            }
        } else {
            echo 'Incorrect username/password';
        }
    } else {
        echo 'Error executing query';
    }
} else {
    echo 'Invalid request';
}
?>
