<?php session_start();
if (!isset($_SESSION['postData'])) {
 $_SESSION['postData']['slmcId'] = $_SESSION['postData']['practitionerFirstName'] =$_SESSION['postData']['practitionerLastName'] = $_SESSION['postData']['MobileNo'] = '';
}
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

  <style>.error {border: 2px solid red;}</style>

</head>
<body style="background-color: #FFFAFA;" onload="updateInputFieldValue()"> 

  <?php include 'includes/topNav.php'; ?> <!-- Top Navigation -->


  <div class="container-md pt-2">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active" aria-current="page">New User</li>
      </ol>
    </nav>


    <div class="card">
      <div class="card-body">
        <div class="col-sm-12 p-2 text-center">
          <h5 class="card-title"> New User Registration </h5>
        </div>
        <hr>
        <form class="row g-3" method="POST" action="phpfiles/newUserRegistration.php" id="userRegForm">

          <div class="col-sm-12">
            <label for="SLMCID" class="form-label">SLMC ID <small id="slmcErr"></small></label>
            <input type="text" class="form-control" id="SLMCID" name="slmcId" value="<?php echo $_SESSION['postData']['slmcId']; ?>">
          </div>

          <div class="col-sm-6">
            <label for="practitionerFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="practitionerFirstName" name="practitionerFirstName" value="<?php echo $_SESSION['postData']['practitionerFirstName']; ?>">
          </div>
          <div class="col-sm-6">
            <label for="practitionerLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="practitionerLastName" name="practitionerLastName" value="<?php echo $_SESSION['postData']['practitionerLastName']; ?>">
          </div>
          <div class="col-sm-12">
            <label for="Active" class="form-label">Active</label>
            <select class="form-select" id="Active" name="Active">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <!-- Occupation -->
          <div class="col-sm-6">
            <label for="speciality" class="form-label">Speciality</label>
            <select class="form-select" id="speciality" name="speciality">
              <?php include 'includes/userTypelist.php';?>
            </select>
          </div>
          <!-- Other form fields -->
          <div class="col-sm-6">
            <label for="organization" class="form-label">Attached Instituition</label>
            <select class="form-select" id="organization" name="organization">
              <?php include 'includes/instituitionList.php';?>
            </select>
          </div>
          <div class="col-sm-12">
            <label for="MobileNo" class="form-label">Mobile Number <small id="mobileErr"></small></label>
            <input type="text" class="form-control" id="MobileNo" name="MobileNo" value="<?php echo $_SESSION['postData']['MobileNo']; ?>">
          </div>
          <div class="col-sm-12">
            <label for="language" class="form-label" name='communication'>Preferred Language</label>
            <select class="form-select" id="language" name='communication'>
              <option value="Sinhalese language">Sinhalese language</option>
              <option value="Tamil language">Tamil language</option>
              <option value="English language" selected>English language</option>
            </select>
          </div>
          <div class="col-sm-12">
            <label class="form-label">Password <small></small></label>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" aria-label="Password" aria-describedby="button-addon2" name="pw" id="pw" style="letter-spacing: 0.3em;">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="updateInputFieldValue()">Regenerate</button>
          </div>

          <div class="col-sm-12 py-4">
            <div class="d-grid gap-2 col-4 mx-auto">
              <button class="btn btn-primary" type="submit">Register</button>
            </div>
          </div>
        </form>

      </div>

    </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
  <style type="text/css">
    #slmcErr{
      color: red;
      font-weight: bold;
    }
  </style>

  <script>
  //SLMC number validation 
    document.getElementById('SLMCID').addEventListener('input', function() {
      var SLMCIDInput = this.value.trim();
      var SLMCIDField = document.getElementById('SLMCID');
      var practitionerFirstNameField = document.getElementById('practitionerFirstName');
      var slmcErrField = document.getElementById('slmcErr');

    // Check if SLMCID contains only numbers
      if (!/^\d+$/.test(SLMCIDInput) || SLMCIDInput.length < 3 || SLMCIDInput.length >= 6) {
        SLMCIDField.classList.add('error');
        slmcErrField.innerHTML  = "&#x274C;";
        slmcErrField.style.display = 'inline';
      } else {
        SLMCIDField.classList.remove('error');
        slmcErrField.innerText = '';
        slmcErrField.style.display = 'none';
      }

    // Move cursor to practitionerFirstName field if 5 numbers entered
      if (SLMCIDInput.length === 5) {
        practitionerFirstNameField.focus();
      }
    });

  // Capitalize each word of the first and last name
    document.getElementById('practitionerFirstName').addEventListener('input', function() {
      this.value = capitalizeWords(this.value);
    });

    document.getElementById('practitionerLastName').addEventListener('input', function() {
      this.value = capitalizeWords(this.value);
    });

    function capitalizeWords(str) {
      return str.replace(/\b\w/g, function(txt) {
        return txt.toUpperCase();
      });
    }

  // Mobile number validation 
    document.getElementById('MobileNo').addEventListener('input', function() {
      var mobileNoInput = this.value.trim();
      var mobileNoField = document.getElementById('MobileNo');
      var languageField = document.getElementById('language');
      var mobileErrField = document.getElementById('mobileErr');

    // Check if MobileNo contains only numbers and has length exactly 10
      if (/^\d{10}$/.test(mobileNoInput)) {
        mobileNoField.classList.remove('error');
        languageField.focus();
        mobileErrField.innerText = '';
        mobileErrField.style.display = 'none';
      } else {
        mobileNoField.classList.add('error');
        mobileErrField.innerHTML  = "&#x274C;";
        mobileErrField.style.display = 'inline';
      }
    });


    //Random password generation 
    function generateRandomText() {
      var chars = '123456789abcdefghijklmnpqrstuvwxyz';
      var randomText = '';
      for (var i = 0; i < 8; i++) {
        var randomIndex = Math.floor(Math.random() * chars.length);
        randomText += chars[randomIndex];
      }
      return randomText;
    }

    function updateInputFieldValue() {
      var randomText = generateRandomText();
      document.getElementById('pw').value = randomText;
    }
  </script>



</body>
</html>
