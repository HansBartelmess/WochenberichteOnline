<?php
require('contrib/RedBeanPHP/rb.php');
R::setup('mysql:host=localhost;dbname=projektv3','root','');
if(isset($_POST["submit"])) {

   $reports = R::dispense('reports');
   $reports->reportNumber = $_POST['reportNumber'];
   $reports->division = $_POST['division'];
   $reports->startDate = $_POST['startDate'];
   $reports->company = $_POST['company'];
   $reports->training = $_POST['training'];
   $reports->school = $_POST['school'];
   R::store($reports);
}

R::close();
?>
