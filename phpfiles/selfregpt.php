<?php 

include 'functions_1.php';


$_POST['district'] = 'Colombo';

$smokingCode = '64234-8'; $smokingLCN = 'Current smoker'; $smokingSystem ='http://loinc.org';
$alcoholCode = '11331-6'; $alcoholLCN = 'History of Alcohol use';$alcoholSystem ='http://loinc.org';
$substanceCode = '42831-8'; $substanceLCN = 'CDrug abuse'; $substanceSystem ='http://loinc.org';

$diabetesCode = '73211009'; $diabetesLCN = 'Diabetes mellitus';$diabetesSystem ='http://hl7.org/fhir/sid/icd-10';
$baCode = 'J45'; $baLCN = 'Asthma';$baSystem ='http://hl7.org/fhir/sid/icd-10';
$cldCode = '328383001'; $cldLCN = 'Chronic liver disease';$cldSystem ='http://snomed.info/sct';

$ihdCode = '414545008'; $ihdLCN = 'Ischemic heart disease';$ihdSystem ='http://snomed.info/sct';
$crdCode = 'N18'; $crdLCN = 'Chronic kidney disease';$crdSystem ='http://hl7.org/fhir/sid/icd-10';
$copdCode = '13645005'; $copdLCN = 'Chronic obstructive pulmonary diseasee';$copdSystem ='http://snomed.info/sct';
$calungCode = '448993007'; $calungLCN = 'Malignant epithelial neoplasm of lung';$calungSystem ='http://snomed.info/sct';
$otherCode = '74964007'; $otherLCN = 'Other'; $otherSystem ='http://snomed.info/sct';


//print_r($_POST);


$_POST['district'] = 'Colombo';

// Create JSON structure
$jsonData = [
    "resourceType" => "Patient",
    "id" => "cfsb1703833460284",
    "active" => true,
    "name" => [
        [
            "text" => "{$_POST['otherName']} {$_POST['lastName']}",
            "given" => [$_POST['otherName']],
            "family" => $_POST['lastName'],
        ]
    ],
    "gender" => $_POST['sex'],
    "birthDate" => $_POST['birthData'],
    "address" => [
        [
            "text" => "{$_POST['adrs']}, {$_POST['district']}",
            "city" => $_POST['district'],
        ]
    ],

    "telecom" => [
        [
            "system"=> 'phone',
            "value"=> $_POST['mobile_1'], // Corrected syntax
            "use"=> 'mobile',
        ],
        [
            "system"=> 'phone',
            "value"=> $_POST['mobile_2'], // Corrected syntax
            "use"=> 'home',
        ]
    ]
];


// Convert to JSON format
$jsonOutput = json_encode($jsonData, JSON_PRETTY_PRINT);
$apiUrl = 'localhost/pretb/api/api.php';
$ptId = sendtoapi($apiUrl,$jsonOutput);
// Output JSON
//echo '<br>';

$reference = 'ptid';

$variablesToCheck = ['smoking', 'alcohol', 'substance', 'diabetes', 'ba', 'cld', 'ihd', 'crd', 'copd', 'calung', 'other'];

foreach ($variablesToCheck as $variable) {
    if (isset($_POST[$variable]) && $_POST[$variable] == 1) {
        //echo "${$variable.'Code'}:  ";
        //echo "${$variable.'LCN'} <br>";
        $rslt = createConditionJSON($reference, ${$variable.'Code'}, ${$variable.'System'}, ${$variable.'LCN'});
        echo "$rslt";
        echo "<br>"; 
        
    }
}


$urlf = 'http://localhost/pretb/findPt.php?ptid='.$ptId;

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NPTCCD </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title></title>
</head>
<body>


    <div class="container-sm">
            <?php include '../includes/topNav.php'; ?> <!-- Top Navigation -->


        <div class="row text-center">
            <div class="col-sm-12 pb-4">
                <h3>Your Registration ID is <?php echo $ptId; ?></h3>  
                <h4>Please Present at *** on ****</h4>              
            </div>
        </div>   

        <div class="row text-center">
            <div class="col-sm-12">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?php echo $urlf; ?>">                         
            </div>
        </div>

    </div>

    
    
  <?php include '../includes/footer.php'; ?> <!-- Footer -->

</body>
</html>