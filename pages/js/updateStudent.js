function updateStudent() {
    var formData = new FormData($('#updateForm')[0]);
    formData.append('submit', true);

    $.ajax({
        url: 'processUpdate.php?student_id=<?php echo $sid; ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response === 'success') {
                // Show Toastify notification
                Toastify({
                    text: 'Student updated successfully.',
                    duration: 3000,
                    close: true,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#4CAF50',
                    stopOnFocus: true
                }).showToast();

                // Redirect to students.php after a brief delay
                setTimeout(function() {
                    window.location.href = 'students.php';
                }, 1000);
            } else {
                // Show Toastify error notification
                Toastify({
                    text: 'Failed to update student.',
                    duration: 3000,
                    close: true,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#ff6347', // tomato color
                    stopOnFocus: true
                }).showToast();
            }
        },
        error: function(error) {
            console.log(error);
            // Show Toastify error notification
            Toastify({
                text: 'Failed to update student.',
                duration: 3000,
                close: true,
                gravity: 'top',
                position: 'right',
                backgroundColor: '#ff6347', // tomato color
                stopOnFocus: true
            }).showToast();
        }
    });
}