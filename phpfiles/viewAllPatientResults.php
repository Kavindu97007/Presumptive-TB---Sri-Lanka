<?php 
   require_once ('db.php'); //database connection
   //include('../includes/topNav.php');
   //require_once('includes/footer.php');
 ?>

 <?php 
    $query = "SELECT * FROM patient"; //select all records
    $result_set = mysqli_query($conn, $query); //store records in to the $result_set ;reguarding to the  sql query

    if ($result_set){
        echo mysqli_num_rows($result_set) . " records found..<hr>"; //cheking how many records are in db.

        //show data in a table

        $table = '<table>';
        $table .= '<tr> 
        <th>Patient ID</th>
        <th>Given ID</th>
        <th>Active</th>
        <th>Diseased</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Mobile Number</th>
        <th>Home Number</th>
        <th>Distrct</th>
        <th>Communication</th>
        <th>Record Created Time</th>
        <th>Contact Person ID</th>
        <th>Patient Country</th>
        </tr>';

       while($records = mysqli_fetch_assoc($result_set)){ //add each records one by one as a assocoative array to the variable $records

        $table .= '<tr>';

        $table .= '<td>' . $records['patientId'] . '</td>';
        $table .= '<td>' . $records['givenId'] . '</td>';
        $table .= '<td>' . $records['active'] . '</td>';
        $table .= '<td>' . $records['diseased'] . '</td>';
        $table .= '<td>' . $records['fName'] . '</td>';
        $table .= '<td>' . $records['lName'] . '</td>';
        $table .= '<td>' . $records['dob'] . '</td>';
        $table .= '<td>' . $records['gender'] . '</td>';
        $table .= '<td>' . $records['adrs'] . '</td>';
        $table .= '<td>' . $records['mobileNumber'] . '</td>';
        $table .= '<td>' . $records['homeNumber'] . '</td>';
        $table .= '<td>' . $records['distric'] . '</td>';
        $table .= '<td>' . $records['communication'] . '</td>';
        $table .= '<td>' . $records['createdTime'] . '</td>';
        $table .= '<td>' . $records['contactPersonId'] . '</td>';
        $table .= '<td>' . $records['country'] . '</td>';
        
        $table .= '</tr>';
        
       }

       $table .= '</table>'; //Close the table tag

    }


 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Patient Details</title>
    <style>
        table {border-collapse;}
        td, th { border: 1px solid black; padding: 10px;}
    </style>
 </head>
 <body>
    <?php echo $table  // Display records in $table 
    ?>; 
 </body>
 </html>

 <?php mysqli_close($conn); 
    include('../includes/footer.php');
 ?>
 