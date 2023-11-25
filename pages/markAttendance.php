<?php
session_start();
include '../config/connection.php';

if (isset($_POST['qrCodeData'])) {
    $qrCodeData = $_POST['qrCodeData'];
    $studentId =  $_SESSION['student_id'];

    $checkQuery = "SELECT * FROM attendance WHERE student_id = $studentId AND DATE(timestamp) = CURDATE()";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $response = array('status' => 'error', 'message' => 'You have already marked your attendance for today');
    } else {
        $insertQuery = "INSERT INTO attendance (student_id, qr_code_data) VALUES ($studentId, '$qrCodeData')";
        $result = mysqli_query($conn, $insertQuery);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Attendance marked successfully');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to mark attendance');
        }
    }
} else {
    $response = array('status' => 'error', 'message' => 'QR code data not provided');
}

header('Content-Type: application/json');
echo json_encode($response);
?>
