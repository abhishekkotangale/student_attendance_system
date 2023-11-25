<?php
session_start();
if ((!isset($_SESSION['admin_username']))) {
    header('location:../index.html');
}
include '../config/connection.php';

if (isset($_POST['submit'])) {
    $sid = $_GET['student_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = $_POST['email'];
    $mobile = $_POST['mobile_number'];

    $updatequery = "UPDATE students SET name='$name', email='$email', mobile_number='$mobile' WHERE sid='$sid'";
    $query = mysqli_query($conn, $updatequery);

    if ($query) {
        echo "success";
    } else {
        echo "Failed to update student: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}
?>
