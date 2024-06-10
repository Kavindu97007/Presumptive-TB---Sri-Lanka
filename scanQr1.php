<?php 
include 'phpfiles/header.php';
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NPTCCD </title>
    <link rel="apple-touch-icon" sizes="180x180" href="imgs/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: #FFFAFA;">

    <?php include 'includes/topNav.php'; ?>

<?php 
include 'phpfiles/db.php';
    $sql = "SELECT `ptId`, `nameGiven`, `nameFamily`, `mobileNo`,`encounter_id`, `status`, `plannedStartDate`, `actualPeriod`, `location` FROM `analytics`,`encounter` WHERE analytics.ptId=encounter.subject AND analytics.ptId=" .$_GET['ptId'] ." ORDER BY encounter.dateCreated DESC LIMIT 1";

    //echo $sql;
    $result = mysqli_query($conn, $sql);
    $conn->close();
    if ($result) {
    // Loop through each row in the result set
        $row = mysqli_fetch_assoc($result);}


 ?>
    <div class="container-md">
        <div class="container">
            <h1>Scan QR Codes</h1>
            <div class="section">
                <div id="my-qr-reader"> </div>
            </div>
        </div>
    </div>

    <script
        src="https://unpkg.com/html5-qrcode">
    </script>


<?php include 'includes/footer.php'; ?> <!-- Footer -->

<style type="text/css">
    /* style.css file*/
body {
    display: flex;
    justify-content: center;
    margin: 0;
    padding: 0;
    height: 100vh;
    box-sizing: border-box;
    text-align: center;
    background: rgb(128 0 0 / 66%);
}
.container {
    width: 100%;
    max-width: 500px;
    margin: 5px;
}

.container h1 {
    color: #ffffff;
}

.section {
    background-color: #ffffff;
    padding: 50px 30px;
    border: 1.5px solid #b2b2b2;
    border-radius: 0.25em;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
}

#my-qr-reader {
    padding: 20px !important;
    border: 1.5px solid #b2b2b2 !important;
    border-radius: 8px;
}

#my-qr-reader img[alt="Info icon"] {
    display: none;
}

#my-qr-reader img[alt="Camera based scan"] {
    width: 100px !important;
    height: 100px !important;
}

button {
    padding: 10px 20px;
    border: 1px solid #b2b2b2;
    outline: none;
    border-radius: 0.25em;
    color: white;
    font-size: 15px;
    cursor: pointer;
    margin-top: 15px;
    margin-bottom: 10px;
    background-color: #008000ad;
    transition: 0.3s background-color;
}

button:hover {
    background-color: #008000;
}

#html5-qrcode-anchor-scan-type-change {
    text-decoration: none !important;
    color: #1d9bf0;
}

video {
    width: 100% !important;
    border: 1px solid #b2b2b2 !important;
    border-radius: 0.25em;
}

</style>

</body>
</html>
