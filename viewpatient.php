<?php 
//include 'phpfiles/header.php';
session_start();
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
            <li class="breadcrumb-item"><a href="findpatient.php">Find Patient</a></li>
            <li class="breadcrumb-item active" aria-current="page">Patient</li>
        </ol>
    </nav>


    <?php 

    if (!isset($_GET['ptId'])) {
        header("Location: findPatient.php");
        exit();
    }

    include 'phpfiles/db.php';

    $sql = "SELECT * FROM `analytics` WHERE `ptId`=".$_GET['ptId'];
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
    // Loop through each row in the result set
        $row = mysqli_fetch_assoc($result);
        echo "<h6>Patient history : <a href=''  data-bs-toggle='modal' data-bs-target='#patientDemoData' title='Edit Record'><img src='imgs/edit.png'></a> </h6>";

        echo "
        <table class='table'>
            <tr>
                <td>Identification Numbers : PTB".$row['ptId'].checkEmpty($row['givenId'])." </td>
            </tr>

            <tr>
                <td>".$row['nameGiven']." ". $row['nameFamily']."
                 | ".$row['gender']." | ".$row['birthdate']." (Age ".calculateAge($row['birthdate']).") </td>
            </tr>

            <tr>
                <td>".$row['addressText'].", ". $row['addressCity']."
                 | ".$row['mobileNo']." | ".$row['homePhone']." </td>
            </tr>
            ";


        echo "
            <tr>
                <td><p id='subhead1'>Risk Factors : <a href='' data-bs-toggle='modal' data-bs-target='#patientDemoData' title='Edit Record'><img src='imgs/edit.png'></a></p>"
                .echoVariableName($row,'Smoking')
                .echoVariableName($row,'Alcohol')
                .echoVariableName($row,'Substance')
                ."</td>
            </tr>

            ";

        echo "
            <tr>
                <td><p id='subhead1'> Comorbidities : <a href='' data-bs-toggle='modal' data-bs-target='#patientDemoData' title='Edit Record'><img src='imgs/edit.png'></a></p>"
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

     echo "<h6>Laboratory Results : <a href='patient.php?ptId=".$row['ptId']."' title='Edit Record'><img src='imgs/edit.png'></a></h6>";   
     echo "
        <table class='table'>";

    echo "  <tr>
                <th colspan='3'> Sputum Smear Microscopy</th>
            </tr>
            <tr>
            <td> ". $row['sp_1_date']." : ".$row['sp_1_result']." </td>
            <td> ". $row['sp_2_date']." : ".$row['sp_2_result']." </td>
            <td> ". $row['sp_3_date']." : ".$row['sp_3_result']." </td>
            </tr>
        ";


        echo "
            <tr>
                <th> GeneXpert</th>
            </tr>

            <tr> 
                <td colspan=3> ". $row['GeneXpert_date']." : ".$row['GeneXpert_result']." </td>

            </tr>
            ";

        echo "
            <tr>
                <th> Chest X-Ray</th>
            </tr>

            <tr> 
                <td colspan=3> ". $row['xray_date']." : ".$row['xray_result']." </td>

            </tr>
            ";

        echo "

            <tr>
                <th> Diagnosis</th>
            </tr>

    <tr>  
        <td colspan=3>". $row['diagnosis_date']." : ".$row['diagnosis_term']." - ". $row['diagnosis_icd']."</td>
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

function generateLink($invsDate, $ptId, $typ, $nmbr) {
    $lnk ='';
    if ($typ =='sp') {
        $lnk = "SputumResult.php?ptId=";
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
        return "<a href=new".$lnk.$ptId."&n=".$nmbr."><img src='imgs/add.png'></a>";
    } else {
        return "<a href=edit".$lnk.$ptId."&n=".$nmbr."><img src='imgs/edit.png'></a>";
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

<?php echo $row['Smoking']; ?>



<?php include 'includes/footer.php'; ?> <!-- Footer -->

<style type="text/css">
    #subhead1{
        font-weight: bold;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="patientDemoData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Patient</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="card">


            <div class="card-body">

        <form class="row g-3" method="POST" action="phpfiles/editpt.php" id="regForm"> 

            <input type="text" name="ptId" value="<?php echo $row['ptId']; ?>" hidden>

          <div class="col-sm-12">
            <label for="inputEmail4" class="form-label">OPD / Clinic / DTB / Standard Card Number</label>
            <input type="text" class="form-control select-on-click"  name="givenId" value="<?php echo $row['givenId']; ?>">
          </div> 


          <div class="col-sm-6">
            <label for="inputEmail4" class="form-label">First Name</label>
            <input type="text" class="form-control select-on-click"  id="otherName" name="otherName" value="<?php echo $row['nameGiven']; ?>">
          </div>
          <div class="col-sm-6">
            <label for="inputPassword4" class="form-label">Last Name</label>
            <input type="text" class="form-control select-on-click" id="lastName" name="lastName" value="<?php echo $row['nameFamily']; ?>" >
          </div>


          <div class="col-sm-6">
            <label for="inputbdate" class="form-label">Birth Date</label>
            <input type="date" class="form-control" id="inputbdate" onchange="calculateAge()"   name="birthDate" value="<?php echo $row['birthdate']; ?>">
          </div>
          <div class="col-sm-6">
            <label for="inputState" class="form-label">Sex</label>
            <select id="inputState" class="form-select"name='sex'>
              <option selected><?php echo $row['gender']; ?></option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>

          <div class="col-sm-6">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" class="form-control select-on-click" id="adrs" placeholder="1234 Main St" name="adrs" value="<?php echo $row['addressText']; ?>">
          </div>

          <div class="col-sm-6">
            <label for="inputDistrict" class="form-label">District</label>
            <select id="inputDistrict" class="form-select"name='district'>
              <option selected><?php echo $row['addressCity']; ?></option>
              <?php include 'includes/district_options.php' ?>

            </select>
          </div>

          <div class="col-sm-6">
            <label for="inputMobile" class="form-label">Mobile</label>
            <input type="text" class="form-control select-on-click" id="inputMobile" name="mobile_1" placeholder="Mobile Number 1" value="<?php echo $row['mobileNo']; ?>" onkeyup="validateMobileNumber('inputMobile', 'inputHome')">
          </div>

          <div class="col-sm-6">
            <label for="inputHome" class="form-label">Home Phone</label>
            <input type="text" class="form-control select-on-click" id="inputHome" name="mobile_2" placeholder="Home Phone" value="<?php echo $row['homePhone']; ?>" onkeyup="validateMobileNumber('inputHome', 'inputmethod')">
          </div>


          <div class="col-sm-6">
            <label for="inputmethod" class="form-label">Method</label>
            <select id="inputmethod" class="form-select" name="mthd">
              <option value = 'passive' selected><?php echo $row['mthd']; ?></option>
              <option value = 'active'>Active</option>
              <option value = 'passive'>Passive</option>
            </select>  
          </div>

          <div class="col-sm-6">
            <label for="inputReffer" class="form-label">Referred By</label>
            <select id="inputReffer" class="form-select" name="rfrd">
              <option  value="self" selected><?php echo $row['rfrd']; ?></option>
              <option value="self" >Self</option>
              <option value="gp" >GP</option>
              <option value="pvt_hospital" >PVT Hospital</option>
              <option value="government" >Government Hospital</option>
            </select> 
          </div>

        <div class="col-sm-12">
            <p><b> Risk Factors </b></p>
            <div class="form-check form-check-inline">
              <input type="hidden" name="smoking" value="0">
            <input type="checkbox" class="form-check-input" id="smoking" name="smoking" value="1" <?php if ($row['Smoking'] == 1) echo 'checked'; ?>>
            <label class="form-check-label" for="smoking">Smoking</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="hidden" name="alcohol" value="0">
              <input type="checkbox" class="form-check-input" id="alcohol" name="alcohol" value="1" <?php if ($row['Alcohol'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="alcohol">Alcohol Use</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="hidden" name="substance" value="0">
              <input type="checkbox" class="form-check-input" id="substance" name="substance" value="1" <?php if ($row['Substance'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="substance">Substance Abuse</label>
            </div>
          </div>


          <div class="col-sm-12">
            <p><b> Comorbidities </b></p>
            <div class="form-check form-check-inline">
              <input type="hidden" name="diabetes" value="0">
              <input type="checkbox" class="form-check-input" id="diabetes" name="diabetes" value="1" <?php if ($row['Diabetes'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="diabetes">Diabetes</label>
            </div>

            <div class="form-check form-check-inline">
              <input type="hidden" name="ba" value="0">
              <input type="checkbox" class="form-check-input" id="ba" name="ba" value="1" <?php if ($row['BA'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="ba">BA</label>
            </div>

            <div class="form-check form-check-inline">
              <input type="hidden" name="cld" value="0">
              <input type="checkbox" class="form-check-input" id="cld" name="cld" value="1" <?php if ($row['CLD'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="cld">CLD</label>
            </div>

            <div class="form-check form-check-inline">
              <input type="hidden" name="ihd" value="0">
              <input type="checkbox" class="form-check-input" id="ihd" name="ihd" value="1" <?php if ($row['IHD'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="ihd">IHD</label>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-check form-check-inline">
              <input type="hidden" name="crd" value="0">
              <input type="checkbox" class="form-check-input" id="crd" name="crd" value="1" <?php if ($row['CRD'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="crd">CRD</label>
            </div>

            <div class="form-check form-check-inline">
              <input type="hidden" name="copd" value="0">
              <input type="checkbox" class="form-check-input" id="copd" name="copd" value="1" <?php if ($row['COPD'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="copd">COPD</label>
            </div>
        
            <div class="form-check form-check-inline">
              <input type="hidden" name="calung" value="0">
              <input type="checkbox" class="form-check-input" id="calung" name="calung" value="1" <?php if ($row['CA'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="calung">CA Lung</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="hidden" name="other" value="0">
              <input type="checkbox" class="form-check-input" id="other" name="other" value="1" <?php if ($row['Other'] == 1) echo 'checked'; ?>>
              <label class="form-check-label" for="other">Other</label>
            </div>

          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="save" >Save Changes</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>


<script type="text/javascript">
    function capitalizeEachWord(fieldId) {
    var inputField = document.getElementById(fieldId);
    var inputValue = inputField.value;

    // Check if the input value is not empty
    if (inputValue.trim() !== '') {
        // Split the input value into an array of words
        var words = inputValue.split(' ');

        // Capitalize the first letter of each word
        var capitalizedWords = words.map(function (word) {
            return word.charAt(0).toUpperCase() + word.slice(1);
        });

        // Join the words back together into a single string
        var capitalizedValue = capitalizedWords.join(' ');

        // Update the input field with the capitalized value
        inputField.value = capitalizedValue;
    }
}

// Add event listeners to call the function when input is finished
document.getElementById('otherName').addEventListener('blur', function () {
    capitalizeEachWord('otherName');
});

document.getElementById('lastName').addEventListener('blur', function () {
    capitalizeEachWord('lastName');
});

document.getElementById('adrs').addEventListener('blur', function () {
    capitalizeEachWord('adrs');
});

function validateMobileNumber(inputMobile, nextId) {
    // Get the mobile number field and its value
    var mobileNumberField = document.getElementById(inputMobile);
    var mobileNumberValue = mobileNumberField.value.trim();

    // Check if the mobile number starts with '+' or '0' and has a maximum length of 12
    if (/^[0]\d{1,9}$/.test(mobileNumberValue)) {
        // Mobile number is valid, reset border color
        mobileNumberField.style.border = '1px solid #ccc';
        // Check if 10 digits are entered, then focus on the next input field
        if (mobileNumberValue.length === 10) {
            var nextField = document.getElementById(nextId);
            if (nextField) {
                nextField.focus();
            }
        }
        return true;
    } else {
        // Mobile number is invalid, set border color to red
        mobileNumberField.style.border = '1px solid red';
        return false;
    }
}

window.onload = function() {
    // Get all input fields with the class name "select-on-click"
    var inputFields = document.querySelectorAll('.select-on-click');

    // Add event listener for click to each input field
    inputFields.forEach(function(inputField) {
        inputField.addEventListener('click', function() {
            // Select the text in the clicked input field
            inputField.select();
        });
    });
};


function validateAndSubmit() {
    // Array of field IDs to be checked
    var fieldIds = ["otherName", "lastName", "inputAddress", "inputMobile", "inputbdate"];

    var formIsValid = true;

    // Loop through the field IDs
    for (var i = 0; i < fieldIds.length; i++) {
        var fieldId = fieldIds[i];
        var fieldValue = document.getElementById(fieldId).value;

        // Check if the field is empty
        if (fieldValue === "") {
            formIsValid = false;
            // Highlight the empty field in red
            document.getElementById(fieldId).style.borderColor = "red";
        } else {
            // Reset the border color if the field is not empty
            document.getElementById(fieldId).style.borderColor = "";
        }
    }

    if (!formIsValid) {
        alert("Please fill in all required fields.");
        return false;
    }

    return true;
}

// Add event listener to the button with ID "save"
document.getElementById("save").addEventListener("click", function() {
    var formIsValid = validateAndSubmit();
    if (formIsValid) {
        // Submit the form within the modal
        document.getElementById("modalForm").submit();
    }
});



</script>



