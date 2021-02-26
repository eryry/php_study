<?php

class Calc {
  
  // 時間を分に変換
  function calc_hour($hour) {
    return $hour*60;
  }
  // 割合を％で表示
  function calc_per($time,$all_time) {
    if($all_time != 0){
      return ($time / $all_time) *100;
    }
  }
}