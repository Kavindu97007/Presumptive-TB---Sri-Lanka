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
  <script src="jscodes/qrcode.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>

<body style="background-color: #FFFAFA;">

    <?php include 'includes/topNav.php'; ?>

<?php 
include 'phpfiles/db.php';
    $sql = "SELECT * FROM `analytics` WHERE `ptId`=".$_GET['ptId'];
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
            <h5 class="card-title">Patient Registered Completed</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                              <td scope="col">Name : </td>
                              <td scope="col"><?php echo $row['nameGiven'].' ' .$row['nameFamily']; ?></td>
                            </tr>
                            <tr>
                              <td scope="col">Registration No : </td>
                              <td scope="col"><?php echo $row['ptId']; ?></td>
                            </tr>
                        </tbody>
                    </table>       
                </div>
            </div>

            <div class="d-flex justify-content-center pt-3">
                <div id="qrcode"></div>
            </div>
        </div>


<div class="card-footer bg-transparent border-gray py-2">
    <div class="d-flex justify-content-center">
        <div class="px-3">
            <button type="button" class="btn btn-light wtd">Download</button>
            <!-- <img src="imgs/download_457628.png" class="btn-fixed-width" alt="Download" onclick="generatePDF()"> -->
        </div>
        <div class="px-3">
            <button type="button" class="btn btn-light wtd">Appointment</button>
            <!-- <img src="imgs/appointment_2.png" class="btn-fixed-width" alt="Edit" onclick="redirectToPage('appointment.php')"> -->
        </div>
<!--     </div>
    <div class="d-flex justify-content-center pt-3"> -->
        <div class="px-3">
            <button type="button" class="btn btn-light wtd">View</button>
            <!-- <img src="imgs/edit_5972923.png" class="btn-fixed-width" alt="Edit" onclick="redirectToPage('viewpatient.php')"> -->
        </div>
        <div class="px-3">
            <button type="button" class="btn btn-light wtd">Edit</button>
            <!-- <img src="imgs/more_4367332.png" class="btn-fixed-width" alt="Edit" onclick="redirectToPage('patient.php')"> -->
        </div>
    </div>
</div>




</div>
</div>

</div>


<?php $fixbot = 1; include 'includes/footer.php'; ?> <!-- Footer -->

<script>

  // Function to generate QR code
  function generateQRCode(text) {
    // Create a new QRCode instance
    var qrcode = new QRCode(document.getElementById("qrcode"), {
      text: text,
      width: 300,
      height: 300
    });

    // Display the QR code
    qrcode.makeCode(text);
  }

  // Example: Generate QR code with text "Hello, World!"
  generateQRCode("<?php echo "https://pretb.trainable.lk/pretb/successApp.php?ptId=".$row['ptId'] ;?>");

  function generatePDF() {
    // Get the HTML element to be converted to PDF
    var element = document.getElementById('pdfContent');

    // Options for html2pdf
    var options = {
      margin: 10,
      filename: 'downloaded-pdf.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 1 },
      jsPDF: { unit: 'mm', format: 'a5', orientation: 'portrait' }
    };

    // Use html2pdf to generate the PDF
    html2pdf(element, options);
  }

    // Function to handle button click and redirect
    function redirectToPage(pgname) {
        // Get the PHP variable value and pass it to the JavaScript function
        var ptId = <?php echo json_encode($row['ptId']); ?>;

        // Redirect to a certain page with ptId in the query string
        window.location.href = "https://pretb.trainable.lk/pretb/" + pgname + "?ptId=" + ptId;
    }

</script>

<style type="text/css">
    .table td, .table th {
        text-align: left;
        }
    .btn-fixed-width {
    width: 60px; /* Adjust the width as needed */

    .wtd{
        width: 100px;
    }
}

</style>



</body>
</html>
