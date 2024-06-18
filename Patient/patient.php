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
<link rel="manifest" href="/site.webmanifest">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body style="background-color: #FFFAFA;">

  <?php include '../includes/topNav.php'; ?> <!-- Top Navigation -->



  <div class="container-lg pt-2">  

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="findpatient.php">Find Patient</a></li>
            <li class="breadcrumb-item active" aria-current="page">Patient</li>
        </ol>
    </nav>

    <?php 
    include '../phpfiles/db.php';

    $sql = "SELECT * FROM `patient` WHERE `patientId`=".$_GET['patientId'];
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
    // Loop through each row in the result set
        $row = mysqli_fetch_assoc($result);
        echo "<h6>Patient history : </h6>";

        echo "
        <table class='table'>
            <tr>
                <td>Identification Numbers : PTB".$row['patientId'].checkEmpty($row['fName'])." </td>
            </tr>

            <tr>
                <td>".$row['fName']." ". $row['lName']."
                 | ".$row['gender']." | ".$row['dob']." (Age ".calculateAge($row['dob']).") </td>
            </tr>

            <tr>
                <td>".$row['adrs'].", ". $row['distric']."
                 | ".$row['mobileNumber']." | ".$row['homeNumber']." </td>
            </tr>
            ";


        echo "
            <tr>
                <td><p id='subhead1'>Risk Factors : </p>"
                .echoVariableName($row,'Smoking')
                .echoVariableName($row,'Alcohol')
                .echoVariableName($row,'Substance')
                ."</td>
            </tr>

            ";

        echo "
            <tr>
                <td><p id='subhead1'> Comorbidities : </p>"
                .echoVariableName($row,'Diabetes')
                .echoVariableName($row,'BA')
                .echoVariableName($row,'CLD')
                .echoVariableName($row,'IHD')
                .echoVariableName($row,'CRD')
                .echoVariableName($row,'COPD')
                .echoVariableName($row,'CA')
                .echoVariableName($row,'Other')
                ."</td>
            </tr>

            ";
        echo "</table>";

     echo "<h6>Laboratory Results : </h6>";   
     echo "
        <table class='table'>";

    echo "
            <tr>
                <th colspan='4'> Sputum Smear Microscopy</th>
            </tr>
            <tr> <td> # </td> <td> Date </td> <td> Result </td> <td>  </td></tr>

            <tr> 
                <td> 1 </td> <td> ". $row['sp_1_date']." </td> <td> ".$row['sp_1_result']." </td>
                <td> 
                  ". generateLink($row['sp_1_date'],$row['patientId'],'sp','1'). "
                </td>
            </tr>

            <tr> 
                <td> 2 </td> <td> ". $row['sp_2_date']." </td> <td> ".$row['sp_2_result']." </td>
                <td> 
                    ". generateLink($row['sp_2_date'],$row['patientId'],'sp','2'). "
                </td>
            </tr>

            <tr> 
                <td> 3 </td> <td> ". $row['sp_3_date']." </td> <td> ".$row['sp_3_result']." </td>
                <td> 
                    ". generateLink($row['sp_3_date'],$row['patientId'],'sp','3'). "
                </td>
            </tr>
            
            ";

        echo "
            <tr>
                <th colspan='4'> GeneXpert</th>
            </tr>

            <tr> 
                <td>  </td> <td> ". $row['GeneXpert_date']." </td> <td> ".$row['GeneXpert_result']." </td>
                <td> 
                    ". generateLink($row['GeneXpert_date'],$row['patientId'],'gene','1'). "
                </td>
            </tr>
            ";

        echo "
            <tr>
                <th colspan='4'> Chest X-Ray</th>
            </tr>

            <tr> 
                <td>  </td> <td> ". $row['xray_date']." </td> <td> ".$row['xray_result']." </td>
                <td> 
                    ". generateLink($row['xray_date'],$row['patientId'],'xray','1'). "
                </td>
            </tr>
            ";

        echo "

            <tr>
                <th colspan='4'> Diagnosis</th>
            </tr>

    <tr> 
        <td>  </td> 
        <td>". $row['diagnosis_date']." </td> 
        <td>".$row['diagnosis_term']." - ". $row['diagnosis_icd']."</td>
        <td> 
            ". generateLink($row['diagnosis_date'],$row['patientId'],'diag','1') . "
        </td>
    </tr>
            ";

           echo "</table>";
        mysqli_free_result($result);
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }

$conn->close();

function echoVariableName($row,$nme) {
        if ($row[$nme] == 1) {
            return $nme ." | ";
        }
    }

function checkEmpty($nme) {
        if (!empty($nme)) {
        return " | " . $nme;
    }
    }

function generateLink($invsDate, $patientId, $typ, $nmbr) {
    $lnk ='';
    if ($typ =='sp') {
        $lnk = "../phpfiles/SputumResult.php?ptId=";
    }
    elseif ($typ =='gene') {
        $lnk = "GeneXpertResult.php?ptId=";
    }     
   elseif ($typ =='xray') {
        $lnk = "XrayResult.php?ptId=";
    }  
    else {
        $lnk = "Diagnosis.php?ptId=";
    }      

    if ($invsDate == '0000-00-00') {
        return "<a href=new".$lnk.$patientId."&n=".$nmbr."><img src='../imgs/add.png'></a>";
    } else {
        return "<a href=edit".$lnk.$patientId."&n=".$nmbr."><img src='../imgs/edit.png'></a>";
    }
}

function calculateAge($dateOfBirth) {
    // Convert date of birth to a DateTime object
    $dob = new DateTime($dateOfBirth);
    // Get today's date
    $today = new DateTime();
    // Calculate the interval between the dates
    $interval = $today->diff($dob);

    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;

    return "$years years, $months months, $days days";
}
    ?>

</div>



<?php include '../includes/footer.php'; ?> <!-- Footer -->

<style type="text/css">
    #subhead1{
        font-weight: bold;
    }
</style>



</body>
</html>



