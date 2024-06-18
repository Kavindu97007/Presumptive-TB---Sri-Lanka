<?php 
include '../phpfiles/header.php';
?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NPTCCD </title>
    <link rel="apple-touch-icon" sizes="180x180" href="../imgs/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../imgs/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../imgs/favicon/favicon-16x16.png">
<link rel="manifest" href="../imgs/favicon/site.webmanifest">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body style="background-color: #FFFAFA;">

    <?php include '../includes/topNav.php'; ?>

<?php 

if (!isset($_GET['patientId'])) {
    header("Location:findPatient.php?fn=2");
    exit();
}

include '../phpfiles/db.php';
    $sql = "SELECT * FROM `patient` WHERE `patientId`=".$_GET['patientId'];
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    $conn->close();
    
    if ($result) {
    // Loop through each row in the result set
        $row = mysqli_fetch_assoc($result);}


// Function to filter dates starting from tomorrow
function filterDates($dates) {
    $filteredDates = [];
    $tomorrow = strtotime('tomorrow');

    foreach ($dates as $date) {
        $dateTimestamp = strtotime($date);
        if ($dateTimestamp >= $tomorrow) {
            $filteredDates[] = $date;
        }
    }

    return $filteredDates;
}

// Read dates from clinicDates.csv
$csvFile = 'clinicDates.csv';
$dates = [];

if (($handle = fopen($csvFile, 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        $dates[] = $data[0]; // Assuming the date is in the first column
    }
    fclose($handle);
}

// Filter dates starting from tomorrow
$filteredDates = filterDates($dates);

 ?>
    <div class="container-md">

        <div class="card text-center">
          <div class="card-header">
            <h5 class="card-title">District chest clinic appointment</h5>
        </div>
        <div class="card-body">
            <h6 class="card-title">Patient Name : <?php echo $row['fName'].' ' .$row['lName']; ?></h6>
            <h6 class="card-title">Registration Number : PTB<?php echo $row['patientId']; ?></h6>
            <h6>Mobile Number : <?php echo $row['mobileNumber']; ?></h6>

            <form class="row g-3" method="POST" action="../phpfiles/getAppointment.php" id="regForm">


            <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label"></label>
                  <select id="inputDistrict" class="form-select"name='dcc'>
                      <option selected>Choose a Chest Clinic.</option>
                      <?php include '../includes/districtCC_options.php' ?>
                  </select>
              </div>

                <div class="mb-3">
    <select class="form-control" id="clinicDates" name="clinicDates">

        <?php foreach ($filteredDates as $date): ?>
            <option value="<?php echo $date; ?>"><?php echo $date; ?></option>
        <?php endforeach; ?>
    </select>
    
    </select>
</div>


              <div class="mb-3">
               <select id="timeSlot" class="form-select" name="timeSlot">
                <option value="">Select a time</option>

                <?php
                $startTime = strtotime("09:00");
                $endTime = strtotime("15:00");

                while ($startTime <= $endTime) {
                    $formattedTime = date("h:i A", $startTime);

            // Skip the interval from 11:45 am to 1:00 pm
                    if ($formattedTime && $formattedTime !== "12:00 PM" && $formattedTime !== "12:15 PM" && $formattedTime !== "12:30 PM" && $formattedTime !== "12:45 PM") {
                        echo "<option value=\"$formattedTime\">$formattedTime</option>";
                    }

                    $startTime = strtotime('+15 minutes', $startTime);
                }
                ?>
            </select>
        </div>

              <div class="row pt-3">
             
                <div class="col-sm-3 mx-auto pt-2">
                  <div class="d-grid gap-2">
                  <button class="btn btn-primary" type="submit">Confirm</button>
                  </div>
                </div>
                <div class="col-sm-3 mx-auto pt-2">
                  <div class="d-grid gap-2">
                    <button class="btn btn-info" type="button" id="backButton" onclick="redirectToPage('findPatientApp.php')">Back</button>
                  </div>
                </div>

              </div>
<input type="text" name="ptId" value="<?php echo $_GET['patientId']; ?>" hidden> 

    </form>

</div>
</div>

</div>


<?php include '../includes/footer.php'; ?> <!-- Footer -->

<script>
function validateClinicDates() {
    // Get the entered date from the input field
    var enteredDate = document.getElementById("clincDate").value;

    // Fetch the valid dates from the CSV file
    fetch('../clinicDates.csv')
        .then(response => response.text())
        .then(data => {
            // Parse CSV data into an array of valid dates
            var validDates = data.trim().split('\n');

            // Check if the entered date is in the array of valid dates
            if (!validDates.includes(enteredDate)) {
                alert('Invalid birth date. Please choose a valid date.');
                document.getElementById("clincDate").value = "";  // Clear the input field
            }
        })
        .catch(error => console.error('Error fetching clinicDates.csv:', error));
}

    // Function to handle button click and redirect
    function redirectToPage(pgname) {
        // Get the PHP variable value and pass it to the JavaScript function
        var patientId = <?php echo json_encode($row['patientId']); ?>;

        // Redirect to a certain page with ptId in the query string
        window.location.href = "https://pretb.trainable.lk/pretb/" + pgname + "?patientId=" + patientId;
    }
</script>





</body>
</html>
