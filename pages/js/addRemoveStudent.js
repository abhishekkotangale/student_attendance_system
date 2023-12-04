function addStudent() {
    var formData = $('#addStudentForm').serialize();

    $.ajax({
        url: 'addStudentsData.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response === 'success') {
                loadStudents(1);
                Toastify({
                    text: 'Student added successfully.',
                    duration: 3000,
                    close: true,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#4CAF50',
                    stopOnFocus: true
                }).showToast();
            } else if (response === 'email already present') {
                Toastify({
                    text: 'Email already exists.',
                    duration: 3000,
                    close: true,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#ff6347',
                    stopOnFocus: true
                }).showToast();
            } else {
                Toastify({
                    text: 'Failed: ' + response,
                    duration: 3000,
                    close: true,
                    gravity: 'top', 
                    position: 'right',
                    backgroundColor: '#ff6347',
                    stopOnFocus: true
                }).showToast();
            }
        },
        error: function(error) {
            console.log(error);
            Toastify({
                text: 'Error adding student.',
                duration: 3000,
                close: true,
                gravity: 'top', 
                position: 'right',
                backgroundColor: '#ff6347',
                stopOnFocus: true
            }).showToast();
        }
    });
}

function removeStudent(studentId) {
    if (confirm('Are you sure you want to remove this student?')) {
        $.ajax({
            url: 'removeStudent.php',
            type: 'POST',
            data: { student_id: studentId },
            success: function(response) {
                if (response === 'removed') {
                    Toastify({
                        text: 'Student removed successfully.',
                        duration: 3000,
                        close: true,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: '#4CAF50',
                        stopOnFocus: true
                    }).showToast();
                    loadStudents();
                    setTimeout(function() {
                        window.location.href = 'students.php';
                    }, 1000); // Adjust the delay as needed
                } else {
                    Toastify({
                        text: 'Failed to remove student.',
                        duration: 3000,
                        close: true,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: '#ff6347',
                        stopOnFocus: true
                    }).showToast();
                }
            },
            error: function(error) {
                console.log(error);
                Toastify({
                    text: 'Error removing student.',
                    duration: 3000,
                    close: true,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#ff6347',
                    stopOnFocus: true
                }).showToast();
            }
        });
    }
}
