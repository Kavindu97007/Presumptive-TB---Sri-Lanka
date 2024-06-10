<?php 
include 'phpfiles/header.php';
$_SESSION['ptId'] = 2;
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

	<?php include 'includes/topNav.php'; ?>
    <?php include 'phpfiles/functions_1.php'; ?> <!-- Top Navigation -->

    <?php
// Check if ptId is provided in the GET request
    if (isset($_SESSION['ptId'])) {
        $ptId = $_SESSION['ptId'];

        $apiUrl = "http://localhost/pretb/api/getPtInfor?ptId=" . urlencode($ptId);

        $jsonData = file_get_contents($apiUrl);

        if ($jsonData === FALSE) {
            die('Error fetching data from API');
        }

        $data = json_decode($jsonData, true);

        if ($data === NULL) {
            die('Error decoding JSON data');
        }



    } else {
        echo 'ptId parameter is missing in the GET request';
    }
    ?>

    <div class="container-lg">	

        <div class="row">
            <div class="col-sm-12 p-2 text-center">
              <h5 class="card-title"> <?php echo $data[0]['name'][0]['text']; ?>  </h5>
              <p> <?php
              echo calage($data[0]['birthDate']);            
              ?> old <?php echo $data[0]['gender']; 
          ?>  from 
          <?php
          echo $data[0]['address'][0]['district'];            
          ?> 
      </p>
  </div>
</div>
<div class="row">
    <div class="col-sm-12"> <p id="subTopic">Sputum Microscopy</p></div>

</div>
<div class="row">
    <div class="col-sm-4">
              <div class="card text-center">
          <div class="card-header">
            Sample One
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">            
                    <input type="date" class="form-control" name="sample1Cdate">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="microSample1">
                      <option selected></option>
                      <option value="1">+ + +</option>
                      <option value="2">+ +</option>
                      <option value="3">+</option>
                      <option value="Scanty">Scanty</option>
                  </select></div>
              </div>
              
          </div>
          <div class="card-footer text-muted">
              <div class="d-grid gap-2">
                  <button class="btn btn-outline-primary" type="button">Save Result</button>
              </div>
          </div>
      </div>
  </div>
  <div class="col-sm-4">
          <div class="card text-center">
          <div class="card-header">
            Sample Two
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">            
                    <input type="date" class="form-control" name="sample1Cdate">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="microSample2">
                      <option selected></option>
                      <option value="1">+ + +</option>
                      <option value="2">+ +</option>
                      <option value="3">+</option>
                      <option value="Scanty">Scanty</option>
                  </select></div>
              </div>
              
          </div>
          <div class="card-footer text-muted">
              <div class="d-grid gap-2">
                  <button class="btn btn-outline-primary" type="button">Save Result</button>
              </div>
          </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card text-center">
          <div class="card-header">
            Sample Three
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">            
                    <input type="date" class="form-control" name="sample1Cdate">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="microSample3">
                      <option selected></option>
                      <option value="1">+ + +</option>
                      <option value="2">+ +</option>
                      <option value="3">+</option>
                      <option value="Scanty">Scanty</option>
                  </select></div>
              </div>

          </div>
          <div class="card-footer text-muted">
              <div class="d-grid gap-2">
                  <button class="btn btn-outline-primary" type="button">Save Result</button>
              </div>
          </div>
      </div>
  </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-6">
                 <div class="card text-center">
          <div class="card-header">
            GeneXpert
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">            
                    <input type="date" class="form-control" name="sample1Cdate">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="microSample2">
                      <option selected></option>
                      <option value="1">+ + +</option>
                      <option value="2">+ +</option>
                      <option value="3">+</option>
                      <option value="Scanty">Scanty</option>
                  </select></div>
              </div>
              
          </div>
          <div class="card-footer text-muted">
              <div class="d-grid gap-2">
                  <button class="btn btn-outline-success" type="button">Save Result</button>
              </div>
          </div>
      </div>
   </div>
       <div class="col-sm-6">
                 <div class="card text-center">
          <div class="card-header">
            X Ray
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">            
                    <input type="date" class="form-control" name="sample1Cdate">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="microSample2">
                      <option selected></option>
                      <option value="1">+ + +</option>
                      <option value="2">+ +</option>
                      <option value="3">+</option>
                      <option value="Scanty">Scanty</option>
                  </select></div>
              </div>
              
          </div>
          <div class="card-footer text-muted">
              <div class="d-grid gap-2">
                  <button class="btn btn-outline-warning" type="button">Save Result</button>
              </div>
          </div>
      </div>
   </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-12">
                        <div class="card text-center">
          <div class="card-header">
            Diagnosis
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">            
                    <input type="date" class="form-control" name="sample1Cdate">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="microSample2">
                      <option selected></option>
                      <option value="1">+ + +</option>
                      <option value="2">+ +</option>
                      <option value="3">+</option>
                      <option value="Scanty">Scanty</option>
                  </select></div>
              </div>
              
          </div>
          <div class="card-footer text-muted">
              <div class="d-grid gap-2">
                  <button class="btn btn-outline-info" type="button">Save Result</button>
              </div>
          </div>
      </div>
   </div>
</div>


</div>




<style type="text/css">
    #patientTable{
      font-size: 10px;
  }
  hr {
  display: block;
  margin-top: 0.5em;
  margin-bottom: 1em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 5px;
}
</style>





<script type="text/javascript"src="jscodes/functions.js" ></script>

<?php include 'includes/footer.php'; ?> <!-- Footer -->

<style type="text/css">

</style>



</body>
</html>
