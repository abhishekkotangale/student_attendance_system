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
                Toastify({
                    text: 'Student updated successfully.',
                    duration: 3000,
                    close: true,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#4CAF50',
                    stopOnFocus: true
                }).showToast();

                setTimeout(function() {
                    window.location.href = 'students.php';
                }, 1000);
            } else {
                Toastify({
                    text: 'Failed to update student.',
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
                text: 'Failed to update student.',
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
