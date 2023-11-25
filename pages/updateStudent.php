<?php
    session_start();
    if ((!isset($_SESSION['admin_username']))) {
        header('location:../index.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include('navbar.php'); ?>
<div id="content-container container">
    <?php
    include '../config/connection.php';

    $sid = $_GET['student_id'];
    $showquery = "SELECT * FROM students WHERE sid='$sid'";
    $showData = mysqli_query($conn, $showquery);

    if (!$showData) {
        die("Error: " . mysqli_error($conn));
    }

    $result = mysqli_fetch_array($showData);
    ?>

    <div class="container-fluid form">
        <div class="container update-form">
            <div class="upload-form">
                <center class="mt-5">
                    <h4>Update Student Details</h4>
                </center>

                <center class="mt-5">
                    <form id="updateForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $result['name'];?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $result['email'];?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Mobile Number" name="mobile_number" value="<?php echo $result['mobile_number'];?>" required>
                        </div>
                </center>
                <center>
                    <button type="button" class="btn btn-primary mb-4" onclick="updateStudent()">Update</button>
                </center>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/updateStudent.js"></script>
</body>
</html>



