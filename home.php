<?php 
include 'phpfiles/header.php';
$fixbot = 1; 
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>



<body style="background-color:#FFFAFA;">

	<?php include 'includes/topNav.php'; ?> <!-- Top Navigation -->

  <div class="container-lg pt-2">  

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
      </ol>
    </nav>


    <div class="row">
      <div class="col pt-2">
       <a href="register.php"> <img src="imgs/newpt.png" class="rounded mx-auto d-block" alt="..." width="200px"></a>
      </div>
      <div class="col pt-2">       
        <a href="findPatient.php"> <img src="imgs/viewpt.png" class="rounded mx-auto d-block" alt="..."width="200px"> </a>
      </div>
      <div class="col pt-2">       
        <a href="pretb.php"> <img src="imgs/viewreport.png" class="rounded mx-auto d-block" alt="..."width="200px"> </a>
      </div>
      <div class="col pt-2">       
        <a href="scanQr.php"> <img src="imgs/qr-code_12622277.png" class="rounded mx-auto d-block" alt="..."width="200px"> </a>
      </div>
    </div>

  </div>



  <?php include 'includes/footer.php'; ?> <!-- Footer -->


</body>
</html>