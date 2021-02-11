<?php
require_once("todoDatabase.php");
$res = $pdo->query("SELECT * FROM todos ORDER BY completed,id");

function h($text) {
  return htmlspecialchars($text,ENT_QUOTES);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf=8">
  <title>TODOリスト</title>
  <style>
    ul {
      list-style:none;
    }
    li {
      display:flex;
      flex-direction:row;
    }
  </style>
</head>
<body>
  <h1>TODO</h1>
  <form action="classTodo.php" method="post">
    <input type="text" name="contents" value="">
    <input type="submit" value="+">
  </form>
  <ul>
  <?php foreach($res as $row): ?>
  <li>
    <div><?php echo $row["completed"]==1 ? "☑" : "☐" ;?></div>
    <div><?php echo h($row["contents"]); ?></div>
    <?php if($row["completed"]!=1): ?>
    <div>
    <form action="classTodo.php" method="post">
      <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
      <input type="submit" value="ok">
    </form> 
    </div>
    <?php endif; ?>
  </li>
  <?php endforeach; ?>
  </ul>
</body>
</html>