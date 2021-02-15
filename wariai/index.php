<?php
// require_once("calc.php");
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
}

if(!empty($_POST["submit"])) { 
  // 勤務時間合計を、計算用に分に変換して変数格納
  $all_time_hour = calc_hour(intval($_POST["all_time_hour"]));
  $all_time_min  = intval($_POST["all_time_min"]);
  $all_time = $all_time_hour+ $all_time_min;
  
  // 保育事業関連業務時間合計を、計算用に分に変換して変数格納
  $hoi_all_time_hour = calc_hour(intval($_POST["hoi_all_time_hour"]));
  $hoi_all_time_min  = intval($_POST["hoi_all_time_min"]);
  $hoi_all_time = $hoi_all_time_hour + $hoi_all_time_min;
  // 割合算出
  $hoi_wariai = ($hoi_all_time / $all_time) *100;
  
  // 婚活事業関連業務時間合計を、計算用に分に変換して変数格納
  $kon_all_time_hour = calc_hour(intval($_POST["kon_all_time_hour"]));
  $kon_all_time_min  = intval($_POST["kon_all_time_min"]);
  $kon_all_time = $kon_all_time_hour + $kon_all_time_min;
  // 割合算出
  $kon_wariai = ($kon_all_time / $all_time)*100;
  
  // その他業務時間合計を、計算用に分に変換して変数格納
  $else_all_time_hour = intval($_POST["else_all_time_hour"]);
  $else_all_time_min  = intval($_POST["else_all_time_min"]);
  $else_all_time = $else_all_time_hour * 60 + $else_all_time_min;
  // 割合算出
  $else_wariai = ($else_all_time / $all_time)*100;
  
} else{
  $all_time_hour = 0;
  $all_time_min  = 0;
  $hoi_all_time_hour = 0;
  $hoi_all_time_min  = 0;
  $kon_all_time_hour = 0;
  $kon_all_time_min  = 0;
  $else_all_time_hour = 0;
  $else_time_min  = 0;
}
function calc_hour($hour) {
  return $hour*60;
}
function calc_per($time) {
  if($all_time != 0){
    return ($time / $all_time) *100;
  }
}

$today = date("Y年m月d日");
$weeks = ["日","月","火","水","木","金","土"];
$week = $weeks[date("w")];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf=8">
  <title>配分計算</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="watercolor">
  <h1>割合計算<?php echo $today."(".$week.")"; ?></h1>
<div class="sections">
  <section class="base">
    <h2>本日の勤務時間数</h2>
    <ul>
    <form action="" method="post">
      <li>
        <input type="number" name="all_time_hour" value="8">時間
        <input type="number" name="all_time_min" value="00">分
      </li>
      <p>保育事業関連</p>
      <li class="hoi">
        <div>
          <input type="number" name="hoi_all_time_hour" value="00">時間
          <input type="number" name="hoi_all_time_min" value="00">分
        </div>
        <ul>
          <li>
            <input type="text" name="" value="" placeholder="詳細項目入力欄">
            <input type="number" name="" value="">時間
            <input type="number" name="" value="">分
          </li>
          
        </ul>
      </li>
      <p>婚活事業関連</p>
      <li>
        <input type="number" name="kon_all_time_hour" value="00">時間
        <input type="number" name="kon_all_time_min" value="00">分
      </li>
      <p>その他</p>
      <li>
        <input type="number" name="else_all_time_hour" value="00">時間
        <input type="number" name="else_all_time_min" value="00">分
      </li>
      
      <input type="submit" name="submit" value="計算する" class="btn">
    </form>  
  </ul>
  </section>
  
  <section class="result">
    <h2>今日の業務割合</h2>
    <p>今日の勤務時間 合計：<?php echo $all_time; ?>分</p>
    <ul>  

      <li>
       <p>保育事業関連：<?php echo $hoi_wariai;?>%</p>
      </li>
      <li>
       <p>婚活事業関連：<?php echo $kon_wariai;?>%</p>
      </li>
      <li>
       <p>その他：<?php echo $else_wariai;?>%</p>
      </li>
    </ul>
  <form action="" method="post">
    <input type="submit" value="all CLEAR" name="allclear">
  </form>
  </section>
</div>
</body>
</html>