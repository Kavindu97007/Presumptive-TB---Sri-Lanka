<?php 
print_r($_POST);

include 'db.php';


$sql = "INSERT INTO `encounter`(`status`, `class`, `subject`,  `plannedStartDate`, `actualPeriod`, `location`) VALUES ('active','outpatient','{$_POST['ptId']}','{$_POST['clinicDates']}','{$_POST['timeSlot']}','{$_POST['dcc']}')";



    if ($conn->query($sql) === TRUE) {
         header("Location: ../successApp.php?ptId=".$_POST['ptId']);

    } else {
       header("Location: ../success.php?ptId=".$_POST['ptId']);
   }

   $conn->close();

 ?>