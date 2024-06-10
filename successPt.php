<?php session_start(); ?>
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

  <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>

<body style="background-color: #FFFAFA;">

    <?php include 'includes/topNavPatient.php'; ?>

    <?php 
    include 'phpfiles/db.php';
    $sql = "SELECT * FROM `analytics` WHERE `ptId`=".$_SESSION['ptId'];

    $result = mysqli_query($conn, $sql);
    $conn->close();
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);}

        if ($row['mobileNo']!=$_SESSION['mobileNo']) {
            header("Location: ptPortal.php?err");
        }

        ?>
        <div class="container-md">

            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Registration Completed</h5>
                </div>

                <div class="card-body" id="pdfContent">
                    <h6 class="card-title">Patient Name : <?php echo $row['nameGiven'].' ' .$row['nameFamily']; ?></h6>
                    <h6 class="card-title">Registration Number : PTB<?php echo $row['ptId']; ?></h6>

                    <input type="url" id="website" name="website" value="https://pretb.trainable.lk/pretb/patient.php?ptId= <?php echo $_GET['ptId']; ?>" hidden/>

                    <div class="row">
                        <div class="col">
                            <div id="qrcode-container" >
                                <div id="qrcode" class="qrcode"></div>
                            </div>        
                        </div>
                    </div>


<h1 id="tt"></h1>

            </div>

            <div class="card-footer bg-transparent border-gray py-2">
    <div class="d-flex justify-content-center">
        <div class="px-3">
            <button type="button" class="btn btn-light wtd" onclick="generatePDF()">Download</button>
          </div>
          <form method="POST" action="appointmentpatient.php">
            <input type="text" name="ptId" value=<?php echo $_SESSION['ptId']; ?> hidden>
        <div class="px-3">
            <button type="submit" class="btn btn-light wtd">Get Appointment</button>
        </div>
        </form>
    </div>
</div>
        </div>

    </div>


    <?php include 'includes/footer.php'; ?> <!-- Footer -->

    <script type="text/javascript">
        function generateQRCode() {
          let website = document.getElementById("website").value;
          if (website) {
            let qrcodeContainer = document.getElementById("qrcode");
            qrcodeContainer.innerHTML = "";
            new QRCode(qrcodeContainer, website);
            document.getElementById("qrcode-container").style.display = "block";
        } 
    }
    generateQRCode()

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
function redirectToPagewithSession1(pgname) {
    console.log("Button clicked. Redirecting...");
    // Rest of the code
}

</script>

<style type="text/css">
    .form {
      font-family: Helvetica, sans-serif;
      max-width: 400px;
      margin: 0 auto;
      padding: 16px;
      background: #f7f7f7;
  }
  .form h1 {
      background: #5868bf;
      padding: 20px 0;
      font-weight: 300;
      text-align: center;
      color: #fff;
      margin: -16px -16px 16px -16px;
      font-size:  25px;
  }
  .form input[type="text"],
  .form input[type="url"] {
      box-sizing: border-box;
      width: 100%;
      background: #fff;
      margin-bottom: 4%;
      border: 1px solid #ccc;
      padding: 3%;
      color: #555;
  }
  .form input[type="text"]:focus,
  .form input[type="url"]:focus {
      box-shadow: 0 0 5px #5868bf;
      padding: 3%;
      border: 1px solid #5868bf;
  }

  .form button {
      box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      width: 150px;
      margin: 0 auto;
      padding: 3%;
      background: #5868bf;
      border-bottom: 2px solid #5868bf;
      border-top-style: none;
      border-right-style: none;
      border-left-style: none;
      color: #fff;
      cursor: pointer;
  }
  .form button:hover {
      background: rgba(88,104,191, 0.5);
  }
  #qrcode-container{
    display:none;
}

.qrcode{
  padding: 16px;
}
.qrcode img{
  margin: 0 auto;
}
</style>

</body>
</html>
