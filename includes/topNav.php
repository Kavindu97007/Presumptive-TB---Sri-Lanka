<div class="container-md p-2" >

  <nav class="navbar navbar-expand-lg" style="background-color: #FFFAFA;">

    <div class="container-fluid">

      <a class="navbar-brand" href="home.php"><img src="imgs/nptccd.png" width="50"></a>

      <button class="navbar-toggler customTog" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <h3 style="color:#CAC0B3"><b>NPTCCD</b></h3>
          </li>

          <?php if (isset($_SESSION['practitionerId'])) {
           echo "

           <li class='nav-item dropdown px-4'>
           <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
           <B>Enter Data</B>
           </a>
           <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
           <li><a class='dropdown-item' href='register.php'>Register New Patient</a></li>
           <li><a class='dropdown-item' href='../Appoinment/findPatientApp.php'>Get an Appointment</a></li>
           <li><a class='dropdown-item' href='../Patient/findPatient.php'>Find Patient</a></li>
           <li><a class='dropdown-item' href='#'>Add Results</a></li>
           <li><a class='dropdown-item' href=scanQr>Scan QR</a></li>
           </ul>
           </li>


           <li class='nav-item dropdown px-4'>
           <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
           <b>View Results</b>
           </a>
           <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
           <li><a class='dropdown-item' href='pretb.php'>Presumptive TB Resiter</a></li>
           <li><a class='dropdown-item' href='#'></a></li>
           <li><a class='dropdown-item' href='#'>2</a></li>
           </ul>
           </li>
           " ; } ?>


           <?php if (isset($_SESSION['practitionerId']) AND $_SESSION['userType']==1) {
             echo " 
             <li class='nav-item dropdown px-4'>
           <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
           <b>User Management</b>
           </a>
           <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
           <li><a class='dropdown-item' href='reguser.php'>Add New User</a></li>
           <li><a class='dropdown-item' href='#'>Manage User</a></li>
           </ul>
           </li>

             " ; } ?>
           <?php if (isset($_SESSION['practitionerId']) ) {
             echo " 
             <li class='nav-item dropdown px-4'>
           <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
           <b>Welcome ". $_SESSION['practitionerFName']."</b>
           </a>
           <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
           <li><a class='dropdown-item' href='index.php'>Log out</a></li>
           </ul>
           </li>

             " ; } ?>


           <?php if (isset($_SESSION['practitionerId'])) {
             echo "
             </ul>
             <span class='navbar-text'>
             <a class='nav-link active' aria-current='page' href='#'>Welcome ". $_SESSION['practitionerFName']."</a>
             </span>

             " ; } ?>

           </div>

         </div>

       </nav>

     </div>

     <style type="text/css">
      .nav-link, li, .navbar-text {
        color: #000;
      }
      .nav-link:hover{
        color: #FFD700;
      }

      .customTog {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,102,203, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
      } 
    </style>


