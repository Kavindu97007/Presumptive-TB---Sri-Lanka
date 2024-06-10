<?php 
session_start();

function clean_post_variables() {
    $cleaned_data = [];
    foreach ($_POST as $key => $value) {
        // Sanitize each POST variable as a string
        $cleaned_data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }

    return $cleaned_data;
}

function checkEmptyFieldsAndRedirect() {
    $requiredFields = array('otherName', 'lastName', 'birthDate', 'adrs', 'district', 'mobile_1');
    $missingFields = [];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        // Redirect to register.php with GET query
        $missingFieldsQuery = implode(',', $missingFields);
        header("Location: ../register.php?missing_values=$missingFieldsQuery");
        exit();
    }
}

//checkEmptyFieldsAndRedirect();
include 'db.php';

$ptId = '';
$_SESSION['ptId'] ='';

//print_r(clean_post_variables($_POST));

$givenId = $_POST['givenId'];
$nameGiven = $_POST['otherName'];
$nameFamily= $_POST['lastName'];
$birthdate= $_POST['birthDate'];
$gender= $_POST['sex'];
$addressText = $_POST['adrs'];
$addressCity = $_POST['district'];
$mobileNo= $_POST['mobile_1'];
$homePhone= $_POST['mobile_2'];
$mthd = $_POST['mthd'];
$rfrd = $_POST['rfrd'];
$Smoking = $_POST['smoking'];
$Alcohol = $_POST['alcohol'];
$Substance = $_POST['substance'];
$Diabetes = $_POST['diabetes'];
$BA = $_POST['ba'];
$CLD= $_POST['cld'];
$IHD = $_POST['ihd'];
$CRD = $_POST['crd'];
$COPD = $_POST['copd'];
$CA = $_POST['calung'];
$Other = $_POST['other'];



   $sql = "INSERT INTO analytics (`givenId`, `nameGiven`, `nameFamily`, `gender`, `birthdate`, `addressText`, `addressCity`, `mobileNo`, `homePhone`, `Smoking`, `Alcohol`, `Substance`, `Diabetes`, `BA`, `CLD`, `IHD`, `CRD`, `COPD`, `CA`, `Other`)
    VALUES ('$givenId','$nameGiven','$nameFamily','$gender','$birthdate','$addressText','$addressCity','$mobileNo','$homePhone','$Smoking','$Alcohol','$Substance','$Diabetes','$BA','$CLD','$IHD','$CRD','$COPD','$CA','$Other')";

// Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
         $_SESSION['ptId']= $conn->insert_id;
         $_SESSION['nameGiven']= $nameGiven;
         $_SESSION['nameFamily']= $nameFamily;
         $_SESSION['mobileNo']= $mobileNo;

         if (isset($_POST['regType'])) {
            header("Location: ../successPt.php?ptId=".$_SESSION['ptId']);
        }
        else {
            header("Location: ../success.php?ptId=".$_SESSION['ptId']);
        }

    } else {
       header("Location: ../ptPortal.php?err");
   }

// Close the database connection
        $conn->close();
echo $sql;
?>
