<?php
// 設計作業
// ①画面設計書を作る
// ②テーブル設計
// ・TODO内容
// ・TODO完了したかどうか
// ③

$dsn = 'mysql:dbname=todo;host=localhost';
$user = "root";
$password ="root";

$dbh = new PDO($dsn, $user, $password);
$res = $dbh->query("SELECT * FROM todos ORDER BY completed,id");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf=8">
  <title>TODOリスト</title>
</head>
<body>
 <h1>TODO</h1>
 <form action="./register_input.php">
 <input type="submit" value="+">
</form>
<?php foreach($res as $row): ?>
 <div style="display: flex;">
  <div styel="flex: 0 0 60px;">☑</div>
  <div styel="flex: 1 1 0px;"><?php echo $row["contents"]; ?></div>
  <div styel="flex: 0 0 60px;"><input type="submit" value="ok"></div>
 </div>
 <?php endforeach; ?>
</body>
</html>