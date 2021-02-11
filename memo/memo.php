<?php
session_start();
function h($text) {
  $res = htmlspecialchars($text,ENT_QUOTES,'UTF-8');
  return $res;
}
// データベース使わず、配列に入れて表示させる形のメモ帳

// クリアボタンで、リストをカラに（リセット）する
if(!empty($_POST["clear"]) && $_POST["clear"]=="リストクリア") {
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
;?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf=8">
  <title>MEMO帳</title>
</head>
<body>
  <form action="" method="post">
    <input type="text" name="memo" value="">
    <button>メモする</button>
    <input type="submit" value="リストクリア" name="clear">
  </form>
  <?php if($_SESSION["memolist"]): ?>
  <div>
    <h2><?=$today."(".$youbi.")"; ?>メモリスト</h2>
    <?php foreach($_SESSION["memolist"] as $val=>$memo): ?>
      <?php if($memo !=""): ?>
        <p><?php echo $val+1; ?>:<?php echo h($memo); ?></p>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</body>
</html>