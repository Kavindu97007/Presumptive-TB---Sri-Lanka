<?php 
//include 'phpfiles/header.php';
 ?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NPTCCD </title>
  <link rel="apple-touch-icon" sizes="180x180" href="imgs/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body style="background-color: #FFFAFA;">

	<?php include 'includes/topNavPatient.php'; ?> <!-- Top Navigation -->



  <div class="container-md">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Register</li>
      </ol>
    </nav>

    <div class="card">

      <div class="card-body">
        <div class="col-sm-12 p-2 text-center">
          <h5 class="card-title"> New Patient Register </h5>
        </div>
        <hr>

        <form class="row g-3" method="POST" action="phpfiles/regptpt.php" id="regForm"> 

        <div class="col-sm-6">
          <label for="inputEmail4" class="form-label">First Name</label>
          <input type="text" class="form-control"  id="otherName" name="otherName">
        </div>
        <div class="col-sm-6">
          <label for="inputPassword4" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName">
        </div>


        <div class="col-sm-6">
          <label for="inputbdate" class="form-label">Birth Date</label>
          <input type="date" class="form-control" id="inputbdate" onchange="calculateAge()"   name="birthDate">
        </div>
        <div class="col-sm-6">
          <label for="inputbdate" class="form-label">Age</label>
          <input type="text" class="form-control" id="age" readonly>
        </div>

        <div class="col-sm-12">
          <label for="inputState" class="form-label">Sex</label>
          <select id="inputState" class="form-select"name='sex'>
            <option selected>Choose...</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>

        <div class="col-sm-6">
          <label for="inputAddress" class="form-label">Address</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="adrs">
        </div>

        <div class="col-sm-6">
          <label for="inputDistrict" class="form-label">District</label>
          <select id="inputDistrict" class="form-select"name='district'>
            <option selected>Choose...</option>
              <?php include 'includes/district_options.php' ?>

          </select>
        </div>

        <div class="col-sm-6">
          <label for="inputMobile" class="form-label">Mobile</label>
          <input type="text" class="form-control" id="inputMobile" name="mobile_1" placeholder="Mobile Number 1" onkeyup="validateMobileNumber('inputMobile', 'inputHome')">
        </div>

        <div class="col-sm-6">
          <label for="inputHome" class="form-label">Home Phone</label>
          <input type="text" class="form-control" id="inputHome" name="mobile_2" placeholder="Home Phone" onkeyup="validateMobileNumber('inputHome', 'regBtn')">
        </div>

<!-- ***************** Hidden ******************** -->

        <div class="col-sm-12" id="divHidden">
          <label for="inputEmail4" class="form-label">OPD / Clinic / DTB / other Number</label>
          <input type="text" class="form-control"  name="givenId">
        </div>
        
        <div class="col-sm-6" id="divHidden">
          <label for="inputmethod" class="form-label">Method</label>
          <input type="text" name="mthd" value="passive">
        </div>

         <div class="col-sm-6" id="divHidden">
           <label for="inputReffer" class="form-label">Referred B</label>
          <input type="text" name="rfrd" value="self">
         </div>

        <div class="col-sm-6" id="divHidden">
           <label for="inputReffer" class="form-label">Referred B</label>
            <input type="text" name="regType" value="selfRegistration">
        </div>
     
<!-- **************** Hidden ********************* -->

         <div class="col-sm-12">
           <p><b> Risk Factors </b></p>
           <div class="form-check form-check-inline">
             <input type="hidden" name="smoking" value="0">
             <input class="form-check-input" type="checkbox" id="smoking" name="smoking" value="1">
             <label class="form-check-label" for="smoking">Smokin</label>
          </div>

          <div class="form-check form-check-inline">
            <input type="hidden" name="alcohol" value="0">
            <input class="form-check-input" type="checkbox" id="alcohol" name="alcohol" value="1">
            <label class="form-check-label" for="alcohol">Alcohol Use</label>
          </div>

          <div class="form-check form-check-inline">
            <input type="hidden" name="substance" value="0">
            <input class="form-check-input" type="checkbox" id="substance" name="substance" value="1" >
            <label class="form-check-label" for="substance">Substance Abuse</label>
          </div>

        </div>


        <div class="col-sm-12">
          <p><b> Comorbidities </b></p>
          <div class="form-check form-check-inline">
            <input type="hidden" name="diabetes" value="0">
            <input class="form-check-input" type="checkbox" id="diabetes" name="diabetes" value="1">
            <label class="form-check-label" for="diabetes">Diabetes</label>
          </div>

          <div class="form-check form-check-inline">
            <input type="hidden" name="ba" value="0">
            <input class="form-check-input" type="checkbox" id="ba" name="ba" value="1" >
            <label class="form-check-label" for="ba">BA</label>
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-check form-check-inline">
            <input type="hidden" name="cld" value="0">
            <input class="form-check-input" type="checkbox" id="cld" name="cld" value="1">
            <label class="form-check-label" for="cld">Chronic Liver Disease</label>
          </div>

          <div class="form-check form-check-inline">
            <input type="hidden" name="ihd" value="0">
            <input class="form-check-input" type="checkbox" id="ihd" name="ihd" value="1" >
            <label class="form-check-label" for="ihd">IHD</label>
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-check form-check-inline">
            <input type="hidden" name="crd" value="0">
            <input class="form-check-input" type="checkbox" id="crd" name="crd" value="1">
            <label class="form-check-label" for="crd">Chronic Renal Disease</label>
          </div>

          <div class="form-check form-check-inline">
            <input type="hidden" name="copd" value="0">
            <input class="form-check-input" type="checkbox" id="copd" name="copd" value="1" >
            <label class="form-check-label" for="copd">COPD</label>
          </div>
        </div>

         <div class="col-sm-12">
           <div class="form-check form-check-inline">
             <input type="hidden" name="calung" value="0">
             <input class="form-check-input" type="checkbox" id="calung" name="calung" value="1">
             <label class="form-check-label" for="calung">CA Lun</label>
           </div>

          <div class="form-check form-check-inline">
            <input type="hidden" name="other" value="0">
            <input class="form-check-input" type="checkbox" id="other" name="other" value="1">
            <label class="form-check-label" for="other">Other</label>
          </div>
        </div>

        <div class="col-sm-12 py-4">
          <div class="d-grid gap-2 col-4 mx-auto">
            <button class="btn btn-primary" id="regBtn" type="submit">Register</button>
          </div>
        </div>
      </form>


      </div>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?> <!-- Footer -->
  <script>
    function calculateAge() {
            // Get the entered birthdate from the input field
      var birthdate = new Date(document.getElementById('inputbdate').value);

            // Get the current date
      var currentDate = new Date();

            // Calculate the difference in milliseconds
      var ageInMilliseconds = currentDate - birthdate;

            // Calculate the age in years, months, and days
      var ageDate = new Date(ageInMilliseconds);
      var years = ageDate.getUTCFullYear() - 1970;
      var months = ageDate.getUTCMonth();
      var days = ageDate.getUTCDate() - 1;

            // Display the age in the 'age' input field
      document.getElementById('age').value = years + ' Years  ' + months + ' Months  ' + days + ' Days';
    }



function validateAndSubmit() {
    // Array of field IDs to be checked
    var fieldIds = ["otherName", "lastName" ,"inputAddress", "inputMobile", "inputbdate"];

    var formIsValid = true;

    // Loop through the field IDs
    for (var i = 0; i < fieldIds.length; i++) {
        var fieldId = fieldIds[i];
        var fieldValue = document.getElementById(fieldId).value;

        // Check if the field is empty
        if (fieldValue === "") {
            formIsValid = false;
            // Highlight the empty field in red
            document.getElementById(fieldId).style.borderColor = "red";
            //alert("Please fill in all required fields.");
            return false; // Prevent form submission
        } else {
            // Reset the border color if the field is not empty
            document.getElementById(fieldId).style.borderColor = "";
        }
    }

    if (!formIsValid) {
        alert("Please fill in all required fields.");
        return false;
    }

    return true;
}

document.getElementById("regForm").onsubmit = function() {
    return validateAndSubmit();
};

  </script>


  <style type="text/css">
    .form-label, h5{
      color: #001233;
      font-weight: bold;
    }
      #divHidden{
        display: none;
    }
  </style>

  <script type="text/javascript">
    function capitalizeEachWord(fieldId) {
    var inputField = document.getElementById(fieldId);
    var inputValue = inputField.value;

    // Check if the input value is not empty
    if (inputValue.trim() !== '') {
        // Split the input value into an array of words
        var words = inputValue.split(' ');

        // Capitalize the first letter of each word
        var capitalizedWords = words.map(function (word) {
            return word.charAt(0).toUpperCase() + word.slice(1);
        });

        // Join the words back together into a single string
        var capitalizedValue = capitalizedWords.join(' ');

        // Update the input field with the capitalized value
        inputField.value = capitalizedValue;
    }
}

// Add event listeners to call the function when input is finished
document.getElementById('otherName').addEventListener('blur', function () {
    capitalizeEachWord('otherName');
});

document.getElementById('lastName').addEventListener('blur', function () {
    capitalizeEachWord('lastName');
});

document.getElementById('adrs').addEventListener('blur', function () {
    capitalizeEachWord('adrs');
});


function validateMobileNumber(inputMobile, nextId) {
    // Get the mobile number field and its value
    var mobileNumberField = document.getElementById(inputMobile);
    var mobileNumberValue = mobileNumberField.value.trim();

    // Check if the mobile number starts with '+' or '0' and has a maximum length of 12
    if (/^[0]\d{1,9}$/.test(mobileNumberValue)) {
        // Mobile number is valid, reset border color
        mobileNumberField.style.border = '1px solid #ccc';
        // Check if 10 digits are entered, then focus on the next input field
        if (mobileNumberValue.length === 10) {
            var nextField = document.getElementById(nextId);
            if (nextField) {
                nextField.focus();
            }
        }
        return true;
    } else {
        // Mobile number is invalid, set border color to red
        mobileNumberField.style.border = '1px solid red';
        return false;
    }
}
  </script>
</body>
</html>