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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body style="background-color:#FFFAFA;">

	<?php include 'includes/topNav.php'; ?> <!-- Top Navigation -->


	<div class="container-md">

		<div class="card">
			<div class="card-header">
			
			</div>

			<div class="card-body">

				<div class="col-md-12 p-4 ">
        			<h5 class="card-title"> Add Details </h5>
    			</div>

				<form class="row g-3">


					<div class="col-sm-12">
						<label for="inputAddress2" class="form-label">Method</label>
						<select id="inputState" class="form-select" name="mthd">
							<option selected>Select...</option>
							<option>Active</option>
							<option>Passive</option>
						</select>  
					</div>

					<div class="col-sm-12">
						<label for="inputAddress2" class="form-label">Referred By</label>
						<select id="inputState" class="form-select" name="rfrd">
							<option selected>Select...</option>
							<option>Self</option>
							<option>GP</option>
						</select> 
					</div>

					<div class="col-sm-12">
						<label for="inputAddress2" class="form-label">Risk Factors</label>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="smoker" id="defaultCheck1">
						<label class="form-check-label" for="defaultCheck1">
							Smoker
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="hiv" id="defaultCheck2" >
						<label class="form-check-label" for="defaultCheck2">
							HIV Positive
						</label>
					</div>

					</div>


					<div class="col-12">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>


			</div>
		</div>



	</div>
	<?php include 'includes/footer.php'; ?> <!-- Footer -->


</body>
</html>