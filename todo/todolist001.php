<?php
require_once("todoDatabase.php");
$res = $pdo->query("SELECT * FROM todos ORDER BY completed,id");
function h($text) {
  return htmlspecialchars($text,ENT_QUOTES);
}
$year = date("Y");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf=8">
  <title>TODOリスト</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="watercolor">
<div>
  <h1>MY TODO LIST <?php echo $year; ?></h1>
  <section class="add_area">
  <h2>add new TODO</h2>
  <form action="classTodo.php" method="post">
    <input type="text" name="contents" value="">
    <input type="submit" value="+">
  </form>
  </section>
  <section class="list_area">
  <h2>TODO LIST</h2>
  <ul>
  <?php foreach($res as $row): ?>
  <li>
    <div class="check"><?php echo $row["completed"]==1 ? "☑" : "☐" ;?></div>
    <div><?php echo h($row["contents"]); ?></div>
    <?php if($row["completed"]!=1): ?>
    <div class="btn_ok">
    <form action="classTodo.php" method="post">
      <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
      <input type="submit" value="OK">
    </form> 
    </div>
    <?php endif; ?>
  </li>
  <?php endforeach; ?>
  </ul>
  </section>
</div>
</body>
</html>