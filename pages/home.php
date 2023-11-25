<?php
session_start();
if (!isset($_SESSION['admin_username']) && !isset($_SESSION['student_email'])) {
    header('location: ../index.html');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Home</title>
  </head>
  <body>
    <?php include('navbar.php');?>
    <div class="container mt-5">
        
        <h2>Welcome, <?php if(isset($_SESSION['admin_username'])){ echo $_SESSION['admin_username']; }else{echo $_SESSION['student_name'];}?>!</h2>
    </div>
    <?php
    if(isset($_SESSION['admin_username'])){
        ?>
            <div class="container mt-5">
       <center>
       <div class="row">
            <div class="col-md-4 col-sm-12 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Add students</h5>
                        <a href="students.php" class="btn btn-primary">Open</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Qr Page</h5>
                        <a href="qrpage.php" class="btn btn-primary">Open</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Students Attendance</h5>
                        <a href="adminAttendance.php" class="btn btn-primary">Open</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Reset Password</h5>
                        <a href="updatePassword.php" class="btn btn-primary">Open</a>
                    </div>
                </div>
            </div>
        </div>
       </center>
    </div>
        <?php
    }

    if(isset($_SESSION['student_email'])){
        ?>
            <div class="container mt-5">
       <center>
       <div class="row">
            <div class="col-md-4 col-sm-12 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Mark Attendance</h5>
                        <a href="student_scan_attendance.php" class="btn btn-primary">Open</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Attendance History</h5>
                        <a href="attendanceHistory.php" class="btn btn-primary">Open</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Reset Password</h5>
                        <a href="updatePassword.php" class="btn btn-primary">Open</a>
                    </div>
                </div>
            </div>
        </div>
       </center>
    </div>
        <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>