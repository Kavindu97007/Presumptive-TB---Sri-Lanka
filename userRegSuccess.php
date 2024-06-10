<?php
session_start();
// Sample data array
$data =$_SESSION['savedData'];

// Generate formatted string
$formattedText = "User Information:\n";
$formattedText .= "--------------------------------------\n\n";
$formattedText .= "Username: " . $data['username'] . "\n";
$formattedText .= "Name: " . $data['name'] . "\n";
$formattedText .= "Mobile: " . $data['mobile'] . "\n";
$formattedText .= "Password: " . $data['pw'] . "\n";
$formattedText .= "Institution: " . $data['instituition'] . "\n";
$formattedText .= "Created Date: " . $data['dteCreated'] . "\n";
$formattedText .= "SLMC: " . $data['slmc'] . "\n";
$formattedText .= "Language: " . $data['lan'] . "\n";
$formattedText .= "Specialty: " . $data['specialty']. "\n\n";
$formattedText .= "-------------------------------------\n";
$formattedText .= "Please change the password during your first loggin.";

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

  <style>.error {border: 2px solid red;}</style>

</head>
<body style="background-color: #FFFAFA;" onload="updateInputFieldValue()"> 

  <?php include 'includes/topNav.php'; ?> <!-- Top Navigation -->


  <div class="container-md pt-2">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active" aria-current="page">New User Registered</li>
      </ol>
    </nav>


    <div class="card">
      <div class="card-body">
        <div class="col-sm-12 p-2 text-center">
          <h5 class="card-title"> User Registration Completed</h5>
        </div>
        <hr>

        <div class="col-sm-12 p-2 text-center">

          <div class="form-floating">
            <textarea class="form-control" id="floatingTextarea2" style="height: 350px"><?php echo $formattedText; ?></textarea>
          </div>

          <button onclick="myFunction()">Copy text</button>

        </div>

      </div> <!-- card body ends -->

    </div><!-- card ends -->

  </div>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
  <style type="text/css">
  </style>

<script type="text/javascript">
    function myFunction() {
  // Get the text field
  var copyText = document.getElementById("floatingTextarea2");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); 
  navigator.clipboard.writeText(copyText.value)
}
</script>


</body>
</html>
