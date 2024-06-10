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

<?php 
session_start();
session_destroy();
//$_SESSION['userId'] = 1;

?>






<body style="background-color:#FFFAFA;">

	  <div class="d-flex flex-column min-vh-100">
    <header>
     <?php include 'includes/topNav.php'; ?> <!-- Top Navigation -->
    </header>
    
    <main class="flex-grow-1">
      	<div class="container-sm">

		<div class="row pt-3">
			<div class="col-sm-6 mx-auto">
				<hr>
				<h4 style="text-align: center;">National Programme for Tuberculosis Control & Chest Diseases</h4>
				<hr>
				<h5 style="text-align: center;">Staff Login</h5>
				<?php if(isset($_GET['err'])) {
					echo "<p id='errmsg'>Incorrect username or password'</p>";
				} ?>
			</div>
		</div>

		<form action="phpfiles/checkLogin.php" method="POST">
			<div class="row pt-5">
				<div class="col-sm-4 mx-auto">
					<div class="mb-3">
						<label for="username" class="form-label">User Name</label>
						<input type="text" class="form-control" id="username" placeholder="" name="username" value="0776088141">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4 mx-auto">
					<div class="mb-3">
						<label for="Password" class="form-label">Password</label>
						<input type="Password" class="form-control" id="Password" placeholder="" name="pw" value="1234">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4 mx-auto">
					<div class="d-grid gap-2">
						<button class="btn btn-primary" type="submit">Login</button>
					</div>
				</div>

			</div>

		</div>
	</form>

    </main>
    
    <footer class="mt-auto">
      <?php include 'includes/footer.php'; ?> <!-- Footer -->
    </footer>
  </div>
</body>
</html>


<style type="text/css">
	#errmsg{
		color: red;
		text-align: center;
	}

</style>