<?php 
//include 'phpfiles/header.php';
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

<body style="background-color: #FFFAFA;">

	<?php include 'includes/topNavPatient.php'; ?> <!-- Top Navigation -->


	<div class="container-md">

    <div class="row p-2">
      <div class="col-sm-12">
        <p>Welcome to the National Programme for Tuberculosis Control & Chest Diseases, a vital initiative under the Ministry of Health in Sri Lanka. </p>        
      </div>
    </div>

    <div class="row p-2">
      <div class="col-sm-12">
        <p>Upon completion of the registration process, you will receive a designated time and location for your clinic visit. At the clinic, you'll be attended to by a doctor specially qualified in tuberculosis care, who will conduct thorough examinations and tests to determine the presence of tuberculosis.</p>        
      </div>
    </div>

    <div class="row p-2">
      <div class="col-sm-12">
        <p>If diagnosed with tuberculosis, rest assured that our program is committed to providing comprehensive treatment and necessary assistance for your journey to recovery. Your privacy is of utmost importance to us, and all information shared will be handled with the strictest confidentiality.</p>        
      </div>
    </div>


<!--     <div class="row p-2">
      <div class="col-sm-12">
        <p>Take the first step towards a healthier future by utilizing our online platform to schedule your tuberculosis screening appointment. Your well-being is our priority, and we are dedicated to supporting you throughout your health journey.</p>
      </div>
    </div> -->

    <div class="row p-2">
      <div class="col-sm-2">
        <div class="d-grid gap-2">
            <button class="btn btn-primary" id="cont" type="button">Continue</button>
        </div>
      </div>
    </div>

    </div>

  <style type="text/css">
    .form-label, h5{
      color: #001233;
      font-weight: bold;
    }
  </style>

  <script>
    // Assuming you have a button with id "cont"
    var contButton = document.getElementById('cont');

    // Add a click event listener to the button
    contButton.addEventListener('click', function() {
        // Redirect to ptPersonalInfo.php
        window.location.href = 'ptPersonalInfo.php';
    });
</script>
</body>
</html>