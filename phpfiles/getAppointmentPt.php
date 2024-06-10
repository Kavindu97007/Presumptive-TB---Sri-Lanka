<?php 
print_r($_POST);
session_start();


include 'db.php';


$sql = "INSERT INTO `encounter`(`status`, `class`, `subject`,  `plannedStartDate`, `actualPeriod`, `location`) VALUES ('active','outpatient','{$_POST['ptId']}','{$_POST['clinicDates']}','{$_POST['timeSlot']}','{$_POST['dcc']}')";



    if ($conn->query($sql) === TRUE) {
        $_SESSION['ptId']=$_POST['ptId'];
         header("Location: ../successAppPt");

    } else {
       header("Location: ../ptPortal.php?ptId=");
   }

   $conn->close();

 ?>