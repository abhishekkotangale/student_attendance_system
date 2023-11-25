<?php
session_start();

include('../config/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_login WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $adminData = $result->fetch_assoc();
        $_SESSION['admin_username'] = $email;
        $_SESSION['admin_id'] = $adminData['id'];
        echo "success";
    } else {
        echo "Invalid username or password";
    }

    $conn->close();
}
?>
