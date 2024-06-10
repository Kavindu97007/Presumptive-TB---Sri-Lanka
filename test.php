
<?php
session_start();
// Sample data array
$data =$_SESSION['savedData'];
print_r($data);

// Generate formatted string
$formattedText = "User Information:\n\n";
$formattedText .= "User ID: " . $data['userId'] . "\n";
$formattedText .= "Username: " . $data['username'] . "\n";
$formattedText .= "Name: " . $data['name'] . "\n";
$formattedText .= "Mobile: " . $data['mobile'] . "\n";
$formattedText .= "Password: " . $data['pw'] . "\n";
$formattedText .= "Institution: " . $data['instituition'] . "\n";
$formattedText .= "Active: " . $data['isActive'] . "\n";
$formattedText .= "Created Date: " . $data['dteCreated'] . "\n";
$formattedText .= "User Type: " . $data['userType'] . "\n";
$formattedText .= "SLMC: " . $data['slmc'] . "\n";
$formattedText .= "Language: " . $data['lan'] . "\n";
$formattedText .= "Specialty: " . $data['specialty'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Information</title>
</head>
<body>

<h1>User Information</h1>

<textarea rows="15" cols="50"><?php echo $formattedText; ?></textarea>
<button onclick="myFunction()">Copy text</button>

</body>

<script type="text/javascript">
    function myFunction() {
  // Get the text field
  var copyText = document.getElementById("myInput");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Copied the text: " + copyText.value);
}
</script>
</html>
