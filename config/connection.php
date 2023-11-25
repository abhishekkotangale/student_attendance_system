<?php

 $server = "localhost";
 $user = "root";
 $password = "";
 $db = "student_attendance_system";

    $conn = mysqli_connect($server,$user,$password,$db);

    if($conn){
    }else{
        ?>
            <script>
                alert("connection not Successful");
            </script>
        <?php
    }

?>