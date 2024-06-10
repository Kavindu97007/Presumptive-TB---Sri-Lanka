<?php 
session_start();
//print_r($_POST);

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

$sql = "UPDATE `analytics` SET ".$_POST['dateName']." = '{$_POST['rsltDate']}' , ".$_POST['rsltName']." = '{$_POST['rslt']}' WHERE `ptId`=".substr($_POST['ptId'], 3);
    if ($conn->query($sql) === TRUE) {
         header("Location: ../patient.php?ptId=".substr($_POST['ptId'], 3));

    } else {
       header("Location: ../patient.php?ptId=".substr($_POST['ptId'], 3));
   }

   $conn->close();

?>
