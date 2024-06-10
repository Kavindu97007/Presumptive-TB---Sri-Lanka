<?php
$smokingCode = '64234-8'; $smokingLCN = 'Current smoker'; $smokingSystem ='http://loinc.org';
$alcoholCode = '11331-6'; $alcoholLCN = 'History of Alcohol use';$alcoholSystem ='http://loinc.org';
$substanceCode = '42831-8'; $substanceLCN = 'CDrug abuse'; $substanceSystem ='http://loinc.org';

$diabetesCode = '73211009'; $diabetesLCN = 'Diabetes mellitus';$diabetesSystem ='http://hl7.org/fhir/sid/icd-10';
$baCode = 'J45'; $baLCN = 'Asthma';$baSystem ='http://hl7.org/fhir/sid/icd-10';
$cldCode = '328383001'; $cldLCN = 'Chronic liver disease';$cldSystem ='http://snomed.info/sct';

$ihdCode = '414545008'; $ihdLCN = 'Ischemic heart disease';$ihdSystem ='http://snomed.info/sct';
$crdCode = 'N18'; $crdLCN = 'Chronic kidney disease';$crdSystem ='http://hl7.org/fhir/sid/icd-10';
$copdCode = '13645005'; $copdLCN = 'Chronic obstructive pulmonary disease';$copdSystem ='http://snomed.info/sct';
$calungCode = '448993007'; $calungLCN = 'Malignant epithelial neoplasm of lung';$calungSystem ='http://snomed.info/sct';
$otherCode = '74964007'; $otherLCN = 'Other'; $otherSystem ='http://snomed.info/sct';

$variablesToCheck = ['smoking', 'alcohol', 'substance', 'diabetes', 'ba', 'cld', 'ihd', 'crd', 'copd', 'calung', 'other'];

$conditionsIdentified=array();
foreach ($variablesToCheck as $variable) {
    if ($_POST[$variable] == 1) {
        $conditionsIdentified[] = $variable;
    }
}

if (count($conditionsIdentified)>0) {
    foreach ($conditionsIdentified as $x) {
        /*echo ${$x.'Code' }."<br>";
        echo ${$x.'LCN' }."<br>";
        echo ${$x.'System' }."<br>";*/

        // Constructing the JSON structure
        $encounterData = array(
            "resourceType" => "Condition",
            "id" => "cfsb1715605694342",
            "subject" => array(
                "reference" => $patientId
            ),
            "code" => array(
                "coding" => array(
                    array(
                        "code" => ${$x.'Code'},
                        "system" => ${$x.'System'},
                        "display" => ${$x.'LCN'}
                    )
                )
            ),
            "encounter" => array(
                "reference" => $encounterId
            ),
            "recordedDate" => "2024-01-01",
            "verificationStatus" => array(
                "coding" => array(
                    array(
                        "code" => "confirmed",
                        "system" => "http://terminology.hl7.org/CodeSystem/condition-ver-status",
                        "display" => "Confirmed"
                    )
                )
            )
        );

        // Encoding the array into JSON
        $encounterData = json_encode($encounterData, JSON_PRETTY_PRINT);

        // API endpoint URL
        $apiUrl = 'localhost/tb/api/saveCondition';

        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encounterData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($encounterData))
    );

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            echo 'cURL error: ' . curl_error($ch);
        } else {
            echo $response;
            echo "<br>";
            echo "---------------- <br>";
        }

        // Close cURL session
        curl_close($ch);

    }
}
?>