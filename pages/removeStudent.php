<?php
session_start();
if ((!isset($_SESSION['admin_username']))) {
    header('location:../index.html');
}
include '../config/connection.php';

if (isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];

    $deleteQuery = "DELETE FROM students WHERE sid = ?";
    
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $studentId);
    $deleteResult = mysqli_stmt_execute($stmt);
    
    if ($deleteResult) {
        echo 'removed';
    } else {
        echo 'Failed to remove student';
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
