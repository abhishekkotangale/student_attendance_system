<?php
    session_start();

    if (!isset($_SESSION['admin_username'])) {
        header('location: ../index.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qr code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>

    <?php include('navbar.php'); ?>
    <div class="container">
        <center class="mt-5">
            <div id="adminQRCode"></div>
            <h4 class="pt-5">Scan this QR to mark attendance</h4>
        </center>
    </div>


    <script>
        function generateAndDisplayQRCode() {
    var currentDate = new Date().toISOString().slice(0, 10);
    var randomValue = Math.random().toString(36).substring(7);
    var adminQRCode = "adminQRCode_" + currentDate + "_" + randomValue;

    var qrCode = new QRCode(document.getElementById("adminQRCode"), {
        text: adminQRCode,
        width: 128,
        height: 128
    });
    setInterval(function () {
        currentDate = new Date().toISOString().slice(0, 10);
        randomValue = Math.random().toString(36).substring(7);
        adminQRCode = "adminQRCode_" + currentDate + "_" + randomValue;
        qrCode.clear();
        qrCode.makeCode(adminQRCode);
    }, 60000);
}

window.onload = function() {
        generateAndDisplayQRCode();
    };
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>