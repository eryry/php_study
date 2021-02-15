<?php

$all_time = '';
if(!empty($_POST["submit"])) {

  
  $all_time_hour = $_POST["all_time_hour"];
  $all_time_min  = $_POST["all_time_min"];
  
  $all_time = $all_time_hour*60 + $all_time_min;
  
  header("Location: index.php");
} 

?>