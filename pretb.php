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


    <div class="container-lg">	

        <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Presumptive TB Register</li>
    </ol>
</nav>

      <?php
if (isset($_SESSION['userType']) && $_SESSION['userType'] == 1) { // if the usertype is 1--> shows all records

    echo "<div class='row' id='selectDistrict'>
            <form action='' method='GET'>
                <div class='col-md-12'>
                    <div class='dropdown'>
                        <select name='district' class='form-select' aria-label='Select District' onchange='this.form.submit()'>";
    include 'includes/district_options.php';                                
    echo "          </select>
                    </div>
                </div>
            </form>
        </div>";
}
?>

        
      

      <table class="table table-striped" id="patientTable">

        <thead>
            <tr>
              <th scope="col">Date Registered</th>
              <th scope="col">No</th>
              <th scope="col">Name</th>
              <th scope="col">Sex</th>
              <th scope="col">Age</th>
              <th scope="col">Address</th>
              <th scope="col">District</th>
              <th scope="col">Contact #</th>
              <th scope="col">Date Results</th>
              <th scope="col">Result 1</th>
              <th scope="col">Result 2</th>
              <th scope="col">Result 3</th>
              <th scope="col">X-Ray</th>
              <th scope="col">GeneXpert</th>
              <th scope="col">Diagnosis</th>
              <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>  

        <?php 
        include 'phpfiles/db.php';

        // Dropdown record show

        if ($_SESSION['userType'] == 1){     

            if (isset($_GET['district'])) { // Check whether $_GET['district'] available
                //echo $_GET['district'];
                if($_GET['district'] == 'allRecords'){  //get the district
                    $sql = "SELECT * FROM patient;";
                    $result_set = mysqli_query($conn, $sql);
                    echo mysqli_num_rows($result_set). " records found. <br/>";
                }
                if($_GET['district'] != 'allRecords'){
                    $sql = "SELECT  `createdTime`,`patientId`, `fName`, `lName`, `gender`,  `dob`, `adrs`, `distric`, `mobileNumber`, `homeNumber` FROM `patient` WHERE `distric`= '{$_GET['district']}'";
                    $result_set = mysqli_query($conn, $sql);
                    echo mysqli_num_rows($result_set). " records found. <br/>";    
                }
                
            }
            
            else{
                $sql = "SELECT  `createdTime`,`patientId`, `fName`, `lName`, `gender`,  `dob`, `adrs`, `distric`, `mobileNumber`, `homeNumber` FROM `patient` ";
               
            }

        }
        if ($_SESSION['userType'] != 1){ // if user is not usertype 1

                    $sql = "SELECT  `createdTime`,`patientId`, `fName`, `lName`, `gender`,  `dob`, `adrs`, `distric`, `mobileNumber`, `homeNumber` FROM `patient` WHERE `distric`= '{$_SESSION['userOrg']['district']}'";
                    $result_set = mysqli_query($conn, $sql);
                    echo mysqli_num_rows($result_set). " records found. <br/>";   

        }
        

        


        $result = mysqli_query($conn, $sql);

        
        
while ($row = mysqli_fetch_assoc($result)) {
    $row['rsltdte'] = "NA";
    if(!isset($row['rslt1'])){$row['rslt1']='N/A';}
    if(!isset($row['rslt2'])){$row['rslt2']='N/A';}
    if(!isset($row['rslt3'])){$row['rslt3']='N/A';}
    if(!isset($row['xRay'])){$row['xRay']='N/A';}
    if(!isset($row['geneXreport'])){$row['geneXreport']='N/A';}
    if(!isset($row['dianosis'])){$row['dianosis']='N/A';}
    if(!isset($row['action'])){$row['action']='N/A';}
            echo "<tr>";
                echo "<td>".convertToShortDate($row['createdTime'])."</td>";           
                echo "<td>".$row['patientId']."</td>";
                echo "<td>".$row['fName']." ".$row['lName']."</td>";
                echo "<td>".$row['gender']."</td>";           
                echo "<td>".calculateAge($row['dob'])."</td>";
                echo "<td>".$row['adrs']."</td>";           
                echo "<td>".$row['distric']."</td>";
                echo "<td><p>".$row['mobileNumber'].'</p><p>'.$row['homeNumber']."</p></td>";           
                echo "<td>".$row['rsltdte']."</td>";
                echo "<td> ". $row['rslt1']." </td>";
                echo "<td>". $row['rslt2']." </td>";
                echo "<td>". $row['rslt3']." </td>";
                echo "<td>". $row['xRay']." </td>";
                echo "<td>". $row['geneXreport']." </td>";
                echo "<td>". $row['dianosis']." </td>";
                echo "<td>". $row['action']." </td>";
                
            echo "</tr>";
        }
$conn->close();



function calculateAge($dateOfBirth) {
    // Convert date of birth to a DateTime object
    $dob = new DateTime($dateOfBirth);
    // Get today's date
    $today = new DateTime();
    // Calculate the interval between the dates
    $interval = $today->diff($dob);
    // Get the difference in years
    $age = $interval->y;
    return $age;
}
         
function convertToShortDate($datetimeString) {
    // Convert datetime string to Unix timestamp
    $timestamp = strtotime($datetimeString);
    
    // Format the Unix timestamp to desired date format
    $shortDate = date('Y-m-d', $timestamp);
    
    return $shortDate;
}



?>

<button id="downloadCsv">Download</button>

      </tbody>
  </table>
</div>


<style type="text/css">
    #patientTable{
      font-size: 10px;
  }
</style>



<script type="text/javascript"src="jscodes/functions.js" ></script>


<?php include 'includes/footer.php'; ?> <!-- Footer -->

<style type="text/css">

</style>

<script>
    function downloadCsv() {
        // Get the table element by its id
        var table = document.getElementById('patientTable');
        var rows = table.rows;
        
        // Initialize an empty array to store the CSV data
        var csvData = [];

        // Iterate through the table rows and cells to get the data
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var rowData = [];

            for (var j = 0; j < row.cells.length; j++) {
                rowData.push(row.cells[j].innerText);
            }

            // Combine the row data into a tab-separated CSV line
            csvData.push(rowData.join('\t'));
        }

        // Combine all CSV lines into a single CSV string
        var csvContent = csvData.join('\n');

        // Create a Blob and a link element to trigger the download
        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8' });
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = 'patient_data.tsv'; // Use .tsv file extension for tab-separated values

        // Trigger the download
        link.click();
    }

    // Assuming you have a button with the id 'downloadCsv'
    var downloadButton = document.getElementById('downloadCsv');
    downloadButton.addEventListener('click', downloadCsv);
</script>





</body>
</html>

