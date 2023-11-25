<?php
session_start();
include '../config/connection.php';

if (isset($_SESSION['admin_username'])) {
    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
    $studentName = isset($_GET['student_name']) ? $_GET['student_name'] : '';

    $whereClause = " WHERE 1=1";
    if ($startDate) {
        $whereClause .= " AND DATE(attendance.timestamp) >= '$startDate'";
    }
    if ($endDate) {
        $whereClause .= " AND DATE(attendance.timestamp) <= '$endDate'";
    }
    if ($studentName) {
        $whereClause .= " AND students.name LIKE '%$studentName%'";
    }

    $selectQuery = "SELECT attendance.*, students.name as student_name FROM attendance
    JOIN students ON attendance.student_id = students.sid" . $whereClause;

    $query = mysqli_query($conn, $selectQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h2 class="mb-4">Students Attendance</h2>
        <form action="" method="get">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="<?php echo $startDate; ?>">

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="<?php echo $endDate; ?>">

            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" id="student_name" value="<?php echo $studentName; ?>">

            <button type="submit">Filter</button>
        </form>

        <table class="table mt-5">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Student Name</th>
                <th scope="col">Qr</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    while ($result = mysqli_fetch_assoc($query)) {
                        echo '<tr>';
                        echo '<td>' . $count++ . '</td>';
                        echo '<td>' . $result['timestamp'] . '</td>';
                        echo '<td>' . $result['student_name'] . '</td>';
                        echo '<td>' . $result['qr_code_data'] . '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
<?php
} else {
    header('location: ../index.html');
    exit();
}
?>
