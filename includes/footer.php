<?php 
//$fixbot = 1;
if (isset($fixbot)) {
 echo "<div class='container-lg fixed-bottom pb-2' >";
}
else {
  echo "<div class='container-lg py-4'>";
}
?>


<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3 ft <?php if (!isset($_SESSION['userId'])) {
  echo 'fixed-bottom';
} ?>">
    © 2024 <a class="aft"  href="https://www.nptccd.health.gov.lk">NPTCCD</a> | Ministry of Health Sri Lanka
  </div>
  <!-- Copyright -->
</footer>

</div>

<style type="text/css">
  a{
    color: #CAC0B3;
    font-weight: bolder;
  }
  .aft:link { 
  text-decoration: none; 
}
.aft:hover { 
  text-decoration: underline overline; 
  color: #FFD700;
}
  .ft{
    background-color: #001233; 
    color: #CAC0B3;
    font-weight:bold;

  }
</style>

