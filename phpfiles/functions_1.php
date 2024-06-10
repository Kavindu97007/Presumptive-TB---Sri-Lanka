<?php 
function sendtoapi($apiUrl,$jsonOutput){
    $curl = curl_init($apiUrl);

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonOutput);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        return 'cURL error: ' . curl_error($curl);
    } else {
        return $response;
    }
    curl_close($curl);
}


function createConditionJSON($reference, $clinicalStatus, $code, $system, $display) {
    // Generate a unique ID for the condition (you can modify this based on your requirements)
    $id = 'cfsb' . substr(str_shuffle('0123456789'), 0, 12);

    // Get the current date in the required format
    $recordedDate = date('Y-m-d');

    // Construct the JSON structure
    $json = [
        "resourceType" => "Condition",
        "id" => $id,
        "clinicalStatus" => [
            "coding" => [[
              "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
              "code" => $clinicalStatus
          ]]
      ],
      "subject" => [
        "reference" => $reference
    ],
    "code" => [
        "coding" => [
            [
                "code" => $code,
                "system" => $system,
                "display" => $display
            ]
        ]
    ],
    "recordedDate" => $recordedDate
];

    // Encode the array to JSON
return json_encode($json, JSON_PRETTY_PRINT);
}

function calage($bdate){
   $birthDateObj = new DateTime($bdate);
    $currentDateObj = new DateTime();
    $ageInterval = $currentDateObj->diff($birthDateObj);

    $years = $ageInterval->y;
    $months = $ageInterval->m;

    if ($years > 0) {
        if ($months > 0) {
            return "{$years} years and {$months} months";
        } else {
            return "{$years} years";
        }
    } else {
        return "{$months} months";
    }
}

?>