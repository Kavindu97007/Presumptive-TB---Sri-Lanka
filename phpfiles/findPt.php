<?php 

function clean_post_variables() {
    $cleaned_data = [];
    foreach ($_POST as $key => $value) {
        // Sanitize each POST variable as a string
        $cleaned_data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }

    return $cleaned_data;
}

include 'db.php';

//print_r($_POST);
$sql = "SELECT `ptId`, `givenId`, `regDate`, `nameGiven`, `nameFamily`, `gender`, `birthdate`, `addressText`, `addressCity`, `mobileNo`, `homePhone` FROM `analytics` WHERE ". $_POST['searchType']. " LIKE ". $_POST['searchFld'];
$conn->close();

echo $sql;

?>
