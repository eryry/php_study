<?php
session_start();
function h($text) {
  $res = htmlspecialchars($text,ENT_QUOTES,'UTF-8');
  return $res;
}
// データベース使わず、配列に入れて表示させる形のメモ帳

// クリアボタンで、リストをカラに（リセット）する
if(!empty($_POST["clear"]) && $_POST["clear"]=="メモ帳クリア") {
  $_SESSION["memolist"]=[];
}
if(empty($_POST["memo"])) {
  // $_SESSION["memolist"][]= "";
  // これだとカラの値が配列に貼ってしまうので不要
}
if(!empty($_POST["memo"])) {
  // 値があったら、配列に追加していく
  $_SESSION["memolist"][]= $_POST["memo"];
}
// 今日の日付（曜日）
$today = date("Y年m月d日");
$week = ["日", "月", "火", "水", "木", "金", "土" ];
$youbi = $week[date("w")];
$time = date("H:i:s");
;?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf=8">
  <title>MEMO帳</title>
  <style>
  body{
    margin:20px;
    color:#333;
  }
  .add_clear_section {
    padding-top:20px;
    padding-bottom:20px;
  }
  .add_clear_section input[type="text"],
  input[type="submit"],
  button{
    border-radius: 3px;
    border: 2px solid pink;
    padding:6px;
    background-color:#ffe2e787;
    color:#333;
  }
  .title {
    display:flex;
    flex-direction:row;
    align-items:center;
    border-left: solid 10px pink;
    border-bottom:solid 1px pink;
  }
  h1 {
   margin:0;
   padding-left:10px;
  }
  .memo_date {
    padding-left:20px;
  }
  ul {
    list-style:none;
    padding-left:10px;
  }
  ul li {
    line-height:30px;
    border-bottom:dotted 2px pink;
  }
  span {
    color:pink;
    padding-right:10px;
  }
  </style>
</head>
<body>
  <section class="add_clear_section">
    <form action="" method="post">
      <input type="text" name="memo" value="">
      <button>メモする</button>
      <input type="submit" value="メモ帳クリア" name="clear">
    </form>
  </section>
  <section>
    <?php if($_SESSION["memolist"]): ?>
    <div class="title">
      <h1>メモ帳</h1>
      <p class="memo_date"><?=$today."(".$youbi.")"; ?></p>
    </div>
      <ul>
      <?php foreach($_SESSION["memolist"] as $val=>$memo): ?>
        <?php if($memo !=""): ?>
          <li><span><?php echo $val+1; ?>:</span><?php echo h($memo); ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
      </ul>
    
    <?php endif; ?>
  </section>
</body>
</html>