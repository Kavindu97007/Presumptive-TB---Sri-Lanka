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

<body style="background-color: #FFFAFA;">

  <?php include 'includes/topNav.php'; ?> <!-- Top Navigation -->



  <div class="container-lg pt-2">  

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Search</li>
    </ol>
</nav>


<form class="row g-3" method="POST" action="findPatient.php">

  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">Email</label>
    <select class="form-select" aria-label="Default select example" name="searchType" id="searchType">
      <option value="patientId">Pretb ID Number</option>
      <option value="mobileNumber">Mobile Number</option>
      <option value="fName">First Name</option>
      <option value="lName">Last Name</option>
      <option value="givenId">Clinic Number</option>
  </select>
</div>
<div class="col-auto">
    <label for="inputFld" class="visually-hidden">Password</label>
    <input type="text" class="form-control" id="searchFld" name="searchFld" placeholder="find all">
</div>
<div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Search </button>
</div>
</form>

<table class="table table-striped" id="patientTable">

    <thead>
        <tr>
          <th scope="col">PreTB ID</th>
          <th scope="col">Clinic ID</th>
          <th scope="col">Registered</th>
          <th scope="col">Name</th>
          <th scope="col">Gender</th>
          <th scope="col">Age</th>
          <!-- <th scope="col">Address</th> -->
          <th scope="col">District</th>
          <th scope="col">Contact #</th>
      </tr>
  </thead>
  <tbody>  
    <?php 

    function convertDatetimeToDate($datetimeString) {
        $datetime = new DateTime($datetimeString);
        $dateString = $datetime->format('Y-m-d');
        return $dateString;
    }

    function clean_post_variables() {
        $cleaned_data = [];
        foreach ($_POST as $key => $value) {
        // Sanitize each POST variable as a string
            $cleaned_data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
        }
        return $cleaned_data;
    }

function calculateAge($birthdate) {
    // Convert birthdate to DateTime object
    $birthDateObj = new DateTime($birthdate);
    
    // Get current date
    $currentDateObj = new DateTime();
    
    // Calculate the difference between birthdate and current date
    $ageInterval = $currentDateObj->diff($birthDateObj);
    
    // Get years, months, and days from the interval
    $years = $ageInterval->y;
    $months = $ageInterval->m;
    $days = $ageInterval->d;
    
    // Build the age string in the specified format
    $ageString = "";
    
    if ($years > 0) {
        $ageString .= $years . 'Y ';
    }
    
    if ($months > 0) {
        $ageString .= $months . 'M ';
    }
    
/*    if ($days > 0) {
        $ageString .= $days . 'D';
    }
    */
    return $ageString;
}


    if (isset($_POST['searchType'])) {
        include 'phpfiles/db.php';

$fld = '%'.$_POST['searchFld'].'%';

$sql = "SELECT  `createdTime`,`patientId`,`givenId`,`fName`, `lName`, `gender`,  `dob`, `adrs`, `distric`, `mobileNumber`, `homeNumber` FROM `patient` WHERE ". $_POST['searchType']. " LIKE  '{$fld}'";        $result = mysqli_query($conn, $sql);
        if ($result) {

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td scope='col'>".$row['patientId']."</td>";
                echo "<td scope='col'>".$row['givenId']."</td>";
                echo "<td scope='col'>".convertDatetimeToDate($row['createdTime'])."</td>";
                echo "<td scope='col'><a href='patient.php?patientId=".$row['patientId']."'>".$row['fName']." ".$row['lName']."</a></td>";
                echo "<td scope='col'>".$row['gender']."</td>";
                echo "<td scope='col'>".calculateAge($row['dob'])."</td>";
                /*echo "<td scope='col'>".$row['addressText']."</td>"*/;
                echo "<td scope='col'>".$row['distric']."</td>";
                echo "<td scope='col'>".$row['mobileNumber']."</td>";
                echo "</tr>";
            }//givenId = Clinic Number, patient nu = auto gen,

            mysqli_free_result($result);
        }
$_SESSION['searchType'] = $_POST['searchType'];
$_SESSION['searchValue'] =$_POST['searchFld'];

        $conn->close();


    }


    ?>


</tbody>
</table>
</div>


<style type="text/css">
    #patientTable{
      font-size: 12px;
  }
</style>

<script type="text/javascript">
    // Get references to the select and input elements
    const searchTypeSelect = document.getElementById('searchType');
    const searchFldInput = document.getElementById('searchFld');

    // Add event listener to the select element
    searchTypeSelect.addEventListener('change', function() {
      // Move focus to the text field when the select option changes
      searchFldInput.focus();
  });


        function updateFormFromSession() {
            // Retrieve SESSION variables
            var searchTypeValue = "<?php echo isset($_SESSION['searchType']) ? $_SESSION['searchType'] : ''; ?>";
            var searchValue = "<?php echo isset($_SESSION['searchValue']) ? $_SESSION['searchValue'] : ''; ?>";

            // Check if SESSION variables are set
            if (searchTypeValue !== '' && searchValue !== '') {
                // Update the select option
                document.getElementById('searchType').value = searchTypeValue;

                // Update the input field value
                document.getElementById('searchFld').value = searchValue;
            }
        }

        // Run the function on page load
        window.onload = updateFormFromSession;
   


</script>


<script type="text/javascript"src="jscodes/functions.js" ></script>

<?php include 'includes/footer.php'; ?> <!-- Footer -->

<style type="text/css">
    a {
        text-decoration: none; 
        color: inherit; 
    }
    a:visited {
    color: inherit; /* Use the inherited color (or set your own) */
}

/* Style links on hover */
a:hover {
    text-decoration: underline; /* Add underline on hover if desired */
}

</style>



</body>
</html>



