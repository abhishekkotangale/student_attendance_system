<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code for Attendance</title>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php include('navbar.php'); ?>

    <div class="container">
        <center class="mt-5">
            <h4>Scan QR Code to Mark Attendance</h4>
            <video id="qrScanner"></video>
        </center>
    </div>

    <script>
        var scanner = new Instascan.Scanner({ video: document.getElementById('qrScanner') });

        scanner.addListener('scan', function (content) {
            markAttendance(content);
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });

        function markAttendance(qrCodeData) {
            $.ajax({
                type: "POST",
                url: "markAttendance.php",
                data: { qrCodeData: qrCodeData },
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        alert('QR code successfully scanned. Attendance marked!');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert("Error marking attendance. Please try again later.");
                }
            });
        }
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
