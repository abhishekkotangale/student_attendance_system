<?php

session_start();
if (!isset($_SESSION['admin_username']) && !isset($_SESSION['student_email'])) {
    header('location: ../index.html');
}

include '../config/connection.php';

if (isset($_POST['submit'])) {
    if (isset($_SESSION['student_id'])) {
        $studentId = $_SESSION['student_id'];
        $sql = "SELECT * FROM students WHERE sid = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $studentId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $newPassword = $_POST['new_password'];
                $cnewPassword = $_POST['cnew_password'];

                if ($newPassword == $cnewPassword) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateSql = "UPDATE students SET password = ? WHERE sid = ?";
                    $updateStmt = mysqli_prepare($conn, $updateSql);

                    if ($updateStmt) {
                        mysqli_stmt_bind_param($updateStmt, 'si', $hashedPassword, $studentId);
                        mysqli_stmt_execute($updateStmt);

                       ?>
                            <script>
                                 alert( "Password reset successfully.");
                            </script>
                       <?php
                    } else {
                        echo "Error updating password.";
                    }
                } else {
                    echo "Passwords do not match.";
                }
            } else {
                echo "No user found.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement.";
        }
    }

    if (isset($_SESSION['admin_id'])) {
        $adminId = $_SESSION['admin_id'];
        $sql = "SELECT * FROM admin_login WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $adminId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $newPassword = $_POST['new_password'];
                $cnewPassword = $_POST['cnew_password'];

                if ($newPassword == $cnewPassword) {
                    $updateSql = "UPDATE admin_login SET password = ? WHERE id = ?";
                    $updateStmt = mysqli_prepare($conn, $updateSql);

                    if ($updateStmt) {
                        mysqli_stmt_bind_param($updateStmt, 'si', $newPassword, $adminId);
                        mysqli_stmt_execute($updateStmt);

                        ?>
                            <script>
                                alert('Password reset successfully.')
                            </script>
                        <?php
                    } else {
                        echo "Error updating password.";
                    }
                } else {
                    echo "Passwords do not match.";
                }
            } else {
                echo "No user found.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement.";
        }
    }
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
    <?php include('navbar.php');?>
    <div class="container mt-5">
        <h2 class="mb-5">Reset Password</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control"name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="cnew_password">Confirm Password:</label>
                <input type="password" class="form-control" name="cnew_password" required>
            </div>
            
            <center><button type="submit" name="submit" class="btn btn-primary">Reset Password</button></center>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
