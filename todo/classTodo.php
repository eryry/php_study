<?php
require_once("todoDatabase.php");

if(!empty($_POST["contents"])) {
  $sql = "INSERT INTO todos(contents) VALUES(:contents);";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":contents",$_POST["contents"],PDO::PARAM_STR);
  $stmt->execute();
  header("Location: todolist001.php");
}

if(!empty($_POST["id"])) {
  $sql = "UPDATE todos SET completed=1 WHERE id=:id;";
  $stmt= $pdo->prepare($sql);
  $stmt->bindValue(":id",$_POST["id"],PDO::PARAM_INT);
  $stmt->execute();
  header("Location: todolist001.php");
}