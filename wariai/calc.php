<?php
require_once "ClassCalc.php";
$cal = new Calc();

if(empty($_POST)){
  $all_time_hour = 0;
  $all_time_min  = 0;
  $all_time = 0;
  $hoi_all_time_hour = 0;
  $hoi_all_time_min  = 0;
  $kon_all_time_hour = 0;
  $kon_all_time_min  = 0;
  $else_all_time_hour = 0;
  $else_time_min  = 0;
  $hoi_wariai=0;
  $kon_wariai=0;
  $else_wariai=0;
  $hoi_dane01=0;
  $hoi_dane02=0;
  $hoi_dane03=0;
  $hoi_dane04=0;
  $hoi_dane05=0;
  $hoi_done01_hour=0;
  $hoi_done02_hour=0;
  $hoi_done03_hour=0;
  $hoi_done04_hour=0;
  $hoi_done05_hour=0;
  $hoi_done01_min=0;
  $hoi_done02_min=0;
  $hoi_done03_min=0;
  $hoi_done04_min=0;
  $hoi_done05_min=0;
  $hoi_done02_alltime=0;
}

if(!empty($_POST["submit"])) { 
  // 勤務時間合計を、計算用に分に変換して変数格納
  $all_time_hour = $cal->calc_hour(intval($_POST["all_time_hour"]));
  $all_time_min  = intval($_POST["all_time_min"]);
  $all_time = $all_time_hour+ $all_time_min;
  
  // 保育事業関連業務時間合計を、計算用に分に変換して変数格納
  $hoi_all_time_hour = $cal->calc_hour(intval($_POST["hoi_all_time_hour"]));
  $hoi_all_time_min  = intval($_POST["hoi_all_time_min"]);
  $hoi_all_time = $hoi_all_time_hour + $hoi_all_time_min;
  // 割合算出
  $hoi_wariai = $cal->calc_per($hoi_all_time,$all_time);
  
  // 保育事業内訳項目と割合
  if(!empty($_POST["hoi_done01"]) || !empty($_POST["hoi_done01_hour"])|| !empty($_POST["hoi_done01_min"])){
    $hoi_done01 = $_POST["hoi_done01"];
    $hoi_done01_hour = $cal->calc_hour(intval($_POST["hoi_done01_hour"]));
    $hoi_done01_min  = intval($_POST["hoi_done01_min"]);
    $hoi_done01_alltime = $hoi_done01_hour + $hoi_done01_min;
    if($hoi_all_time!=0) {
      $hoi_done01_wariai = $cal->calc_per($hoi_done01_alltime,$hoi_all_time);
    }else {
      $hoi_done01_wariai= "-";
    }
  }
  if(!empty($_POST["hoi_done02"])|| !empty($_POST["hoi_done02_hour"])|| !empty($_POST["hoi_done02_min"])){
    $hoi_done02 = $_POST["hoi_done02"];
    $hoi_done02_hour = $cal->calc_hour(intval($_POST["hoi_done02_hour"]));
    $hoi_done02_min  = intval($_POST["hoi_done02_min"]);
    $hoi_done02_alltime = $hoi_done02_hour + $hoi_done02_min;
    if($hoi_all_time!=0) {
      $hoi_done02_wariai = $cal->calc_per($hoi_done02_alltime,$hoi_all_time);
    }else {
      $hoi_done02_wariai= "-";
    }
  }
  if(!empty($_POST["hoi_done03"])|| !empty($_POST["hoi_done03_hour"])|| !empty($_POST["hoi_done03_min"])){
    $hoi_done03 = $_POST["hoi_done03"];
    $hoi_done03_hour = $cal->calc_hour(intval($_POST["hoi_done03_hour"]));
    $hoi_done03_min  = intval($_POST["hoi_done03_min"]);
    $hoi_done03_alltime = $hoi_done03_hour + $hoi_done03_min;
    if($hoi_all_time!=0) {
      $hoi_done03_wariai = $cal->calc_per($hoi_done03_alltime,$hoi_all_time);
    }else {
      $hoi_done03_wariai= "-";
    }
  }
  if(!empty($_POST["hoi_done04"])|| !empty($_POST["hoi_done04_hour"])|| !empty($_POST["hoi_done04_min"])){
    $hoi_done04 = $_POST["hoi_done04"];
    $hoi_done04_hour = $cal->calc_hour(intval($_POST["hoi_done04_hour"]));
    $hoi_done04_min  = intval($_POST["hoi_done04_min"]);
    $hoi_done04_alltime = $hoi_done04_hour + $hoi_done04_min;
    if($hoi_all_time!=0) {
      $hoi_done04_wariai = $cal->calc_per($hoi_done04_alltime,$hoi_all_time);
    }else {
      $hoi_done04_wariai= "-";
    }
  }
  if(!empty($_POST["hoi_done05"])|| !empty($_POST["hoi_done05_hour"])|| !empty($_POST["hoi_done05_min"])){
    $hoi_done05 = $_POST["hoi_done05"];
    $hoi_done05_hour = $cal->calc_hour(intval($_POST["hoi_done05_hour"]));
    $hoi_done05_min  = intval($_POST["hoi_done05_min"]);
    $hoi_done05_alltime = $hoi_done05_hour + $hoi_done05_min;
    if($hoi_all_time!=0) {
      $hoi_done05_wariai = $cal->calc_per($hoi_done05_alltime, $hoi_all_time);
    }else {
      $hoi_done05_wariai= "-";
    }
  }
  
  // 婚活事業関連業務時間合計を、計算用に分に変換して変数格納
  $kon_all_time_hour = $cal->calc_hour(intval($_POST["kon_all_time_hour"]));
  $kon_all_time_min  = intval($_POST["kon_all_time_min"]);
  $kon_all_time = $kon_all_time_hour + $kon_all_time_min;
  // 割合算出
  $kon_wariai = $cal->calc_per($kon_all_time,$all_time);
  
  // その他業務時間合計を、計算用に分に変換して変数格納
  $else_all_time_hour = intval($_POST["else_all_time_hour"]);
  $else_all_time_min  = intval($_POST["else_all_time_min"]);
  $else_all_time = $cal->calc_hour($else_all_time_hour) + $else_all_time_min;
  // 割合算出
  $else_wariai = $cal->calc_per($else_all_time,$all_time);

  
} else{
  $all_time_hour = 0;
  $all_time_min  = 0;
  $hoi_all_time_hour = 0;
  $hoi_all_time_min  = 0;
  $kon_all_time_hour = 0;
  $kon_all_time_min  = 0;
  $else_all_time_hour = 0;
  $else_time_min  = 0;
  $hoi_dane01_hour=0;
}



?>