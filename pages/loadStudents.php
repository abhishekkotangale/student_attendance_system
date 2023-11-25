<?php
if ((!isset($_SESSION['admin_username']))) {
    header('location:../index.html');
}
include '../config/connection.php';

$itemsPerPage = 9;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $itemsPerPage;

$selectQuery = "SELECT * FROM students LIMIT $offset, $itemsPerPage";
$query = mysqli_query($conn, $selectQuery);

if (mysqli_num_rows($query) === 0) {
    echo '<p>No Student Added yet.</p>';
} else {
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Name</th>';
    echo '<th scope="col">Email</th>';
    echo '<th scope="col">Mobile No</th>';
    echo '<th scope="col">Roll No</th>';
    echo '<th scope="col">Update</th>';
    echo '<th scope="col">Remove</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($result = mysqli_fetch_array($query)) {
        echo '<tr>';
        echo '<td>' . $result['name'] . '</td>';
        echo '<td>' . $result['email'] . '</td>';
        echo '<td>' . $result['mobile_number'] . '</td>';
        echo '<td>' . $result['roll_no'] . '</td>';
        echo '<td><a href="updateStudent.php?student_id=' . $result['sid'] . '">update</a></td>';
        echo '<td><a href="#" onclick="removeStudent(' . $result['sid'] . ')">Remove</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}

$paginationQuery = "SELECT COUNT(*) AS total FROM students";
$paginationResult = mysqli_query($conn, $paginationQuery);
$paginationData = mysqli_fetch_assoc($paginationResult);
$totalItems = $paginationData['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

echo '<nav aria-label="Page navigation example">';
echo '<ul class="pagination">';

if ($page > 1) {
    echo '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
} else {
    echo '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
}

$endPage = min($page + 2, $totalPages);
$startPage = max(1, $endPage - 2);
for ($i = $startPage; $i <= $endPage; $i++) {
    echo '<li class="page-item';
    if ($page === $i) {
        echo ' active';
    }
    echo '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
}

if ($page < $totalPages) {
    echo '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
} else {
    echo '<li class="page-item disabled"><span class="page-link">Next</span></li>';
}

echo '</ul>';
echo '</nav>';
?>
