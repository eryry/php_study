<?php
session_start();
function h($text) {
  $res = htmlspecialchars($text,ENT_QUOTES,'UTF-8');
  return $res;
}

// データベース使わず、配列に入れて表示させる形のメモ帳
// 別途データベース使うものも作る
// これを元にチェックリストにするベース

// クリアボタンで、リストをカラに（リセット）する
if(!empty($_POST["clear"]) && $_POST["clear"]=="リストクリア") {
  $_SESSION["memolist"]=[];
}

if(empty($_POST["memo"])) {
// このままだと、カラでメモするボタン押すと、今までのメモ消えてしまう
// からの投稿時は、メモ追加しない仕様に修正する
  $_SESSION["memolist"]= [];
}

if(!empty($_POST["memo"])) {
  // 値があったら、配列に追加していく
  $_SESSION["memolist"][]= $_POST["memo"];
}
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
    <h2>メモリスト</h2>
    <?php foreach($_SESSION["memolist"] as $memo): ?>
    <p>□<?php echo h($memo); ?></p>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</body>
</html>