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

<body style="background-color: #FFFAFA;">

   <?php include 'includes/topNav.php'; 
  $ptId = $_GET['ptId'];
  ?> 



  <div class="container-md pt-2">  

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item"><a href="patient.php?ptId= <?php echo $_GET['ptId']; ?>">Patient</a></li>
        <li class="breadcrumb-item active" aria-current="page">Diagnosis</li>
      </ol>
    </nav>
    <?php 
    include 'phpfiles/db.php';
    $sql = "SELECT `diagnosis_date`, `diagnosis_term` FROM `analytics` WHERE `ptId`=".$_GET['ptId'];
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    $conn->close();
    if ($result) {
      $row = mysqli_fetch_assoc($result);
    }
    ?>
    <form method="POST" action ="phpfiles/diagnosis.php">

      <div class="mb-3 row">
        <label for="staticEmail" class="col-md-3 col-form-label">Patient ID </label>
        <div class="col-md-4">
          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="PTB<?php echo $_GET['ptId']; ?>" name="ptId">
        </div>
      </div>


      <div class="row g-3 py-3">
        <div class="col-sm-3">
          <label for="inputPassword" class="col-md-3 col-form-label">Result</label>
        </div>
        <div class="col-sm">
          <input type="text" class="form-control"  value = "<?php echo array_values($row)[1]; ?>" readonly>
        </div>
        <div class="col-sm">                  
         <select class="form-select" aria-label="Default select example" name="rslt">
          <option selected value="">Select from the list</option>
          <option value="A15-Respiratory tuberculosis, bacteriologically and histologically confirmed">Respiratory tuberculosis, bacteriologically and histologically confirmed</option>
          <option value="A16-Respiratory tuberculosis, not confirmed bacteriologically or histologically">Respiratory tuberculosis, not confirmed bacteriologically or histologically</option>
          <option value="A17-Tuberculosis of nervous system">Tuberculosis of nervous system</option>
          <option value="A18-Tuberculosis of other organs">Tuberculosis of other organs</option>
          <option value="A19-Miliary tuberculosis">Miliary tuberculosis</option>
        </select>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-sm-3">
        <label for="inputPassword" class="col-md-3 col-form-label">Date</label>
      </div>
      <div class="col-sm">
        <input type="text" class="form-control"  value = "<?php echo array_values($row)[0]; ?>" readonly>
      </div>
      <div class="col-sm">
        <input type="date" class="form-control" id="inputDate"   name=rsltDate >
      </div>
    </div>


    <div class="row pt-3">
      <div class="col-sm-1 mx-auto">

      </div>
      <div class="col-sm-3 mx-auto">
        <div class="d-grid gap-2">
         <button class="btn btn-info" type="button" id="backButton">Back</button>
        </div>
      </div>
      <div class="col-sm-3 mx-auto">
        <div class="d-grid gap-2">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>

    </div>
  </form>

  <?php 
  include 'phpfiles/db.php';

  $conn->close();

  ?>

</div>
<?php include 'includes/footer.php'; ?> <!-- Footer -->

<script>
  var today = new Date();

  var maxDate = today.toISOString().split('T')[0];
  document.getElementById('inputDate').setAttribute('max', maxDate);

  var oneYearAgo = new Date(today);
  oneYearAgo.setFullYear(today.getFullYear() - 1);
  var minDate = oneYearAgo.toISOString().split('T')[0];
  document.getElementById('inputDate').setAttribute('min', minDate);

    document.getElementById("backButton").addEventListener("click", function() {
        window.location.href = "patient.php?ptId=<?php echo $ptId; ?>";
    });
</script>




</body>
</html>



