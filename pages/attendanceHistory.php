<?php

session_start();
include '../config/connection.php';

if (isset($_SESSION['student_id'])) {
    $studentId = $_SESSION['student_id'];

    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

    $whereClause = "";
    if ($startDate && $endDate) {
        $whereClause = " AND DATE(timestamp) BETWEEN '$startDate' AND '$endDate'";
    }

    $selectQuery = "SELECT * FROM attendance WHERE student_id = $studentId" . $whereClause;
    $query = mysqli_query($conn, $selectQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php include('navbar.php'); ?>

    <div class="container">
        <h2 class="mb-5 mt-5">Attendance History</h2>

        <form action="" method="get">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="<?php echo $startDate; ?>">

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="<?php echo $endDate; ?>">

            <button type="submit">Filter</button>
        </form>

        <div class="container">
            <center>
            <table class="table mt-5">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    while ($result = mysqli_fetch_assoc($query)) {
                        echo '<tr>';
                        echo '<td>' . $count++ . '</td>';
                        echo '<td>' . $result['timestamp'] . '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
            </center>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
<?php
} else {

    header('location: ../index.html');
    exit();
}
?>
