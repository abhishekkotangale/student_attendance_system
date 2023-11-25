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
    <title>Students</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php include('navbar.php'); ?>
    <center>
       <div class="container mt-5">
       <form id="addStudentForm">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Student Name" name="student_name" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Student Email" name="student_email" required>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" placeholder="Student Number" name="student_number" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Enter student password" name="student_password" required>
            </div>
            <center><button type="button" class="btn btn-primary mb-4" onclick="addStudent()">Add Student</button></center>
        </form>
       </div>
    </center>

    <div class="completed">
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                
                <center>
                <div class="table" id="studentsList">
                    
                </div>
                </center>

                
                <div id="pagination" class="pagination-container">

                </div>
                

            </div>
        </div>
    </div>
    <script src="js/addRemoveStudent.js"></script>
    <script>
        function loadStudents(page) {
            $.ajax({
                url: 'loadStudents.php',
                type: 'GET',
                data: { page: page },
                success: function(response) {
                    $('#studentsList').html(response);
                },
                error: function(error) {
                    console.log(error);
                    alert('Failed to load students');
                }
            });
        }

        // Function to handle pagination clicks
        $(document).on('click', '.pagination-link', function() {
            var page = $(this).data('page');
            loadStudents(page);
        });

        // Initial load on page load
        $(document).ready(function() {
            loadStudents(1); // Load the first page
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>