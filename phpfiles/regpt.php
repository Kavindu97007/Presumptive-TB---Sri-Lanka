<?php

include "functions.php";
session_start();
clean_post_variables();
checkEmptyFieldsAndRedirect();

// Patient registration
include "sections/patientregsection.php"; 
echo $patientId ."<br>"; 
echo $encounterId ."<br>";
include "sections/conditionRecordSection.php"; 
?>