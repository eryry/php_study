<?php
// データベースに接続
// mysql_connect() は、php7では使えないので、mysqli\connect()にする
$link = mysqli_connect('localhost','root','');
if(!$link) {
  die('データベースに接続できません: ' . mysql_error());
}

// データベースを洗濯する
// mysql_select_db()もphp7では使えないので、 mysqli_select_db()にする＋()内も本と逆順
mysqli_select_db($link,'online_bbs');

$errors = array();

// POSTなら保存処理実行
if($_SERVER["REQUEST_METHOD"]==='POST') {
  // 名前が正しく入力されているかをチェック
  $name = null;
  if(!isset($_POST["name"]) || !strlen($_POST["name"])) {
    $errors["name"] = '名前を入力してください';
  }else if(strlen($_POST["name"]) > 40 ) {
    $errors["name"] ="名前は40文字以内で入力してくだい";
  }else {
    $name = $_POST["name"];
  }

  // ひとことが正しく入力されているかをcheck
  $comment = null;
  if(!isset($_POST["comment"]) || !strlen($_POST["comment"])) {
    $errors["comment"] ="ひとことを入力してください";
  }else if(strlen($_POST["comment"]) > 200) {
    $errors["comment"] = "ひとことは200文字以内で入力してください";
  }else {
    $comment = $_POST["comment"];
  }

  // エラーがなければ保存
  if(count($errors)===0) {
    // 保存するためのSQL文を作成
    // ここもphp7では本のままの関数だとエラーなので、mysqli_real_string(,) 引数の数も違うので、$linkも追加
    $sql = "INSERT INTO `post`(`name`, `comment`, `created_at`) VALUES('"
      . mysqli_real_escape_string($link,$name) . "', '"
      . mysqli_real_escape_string($link,$comment) ."', '"
      . date('Y-m-d H:i:s') . "')";

      // 保存する
      // ここもphp7では本のままの関数だとエラーなので、mysqli_query(,) 引数の順番も逆
      mysqli_query($link,$sql);

      mysqli_close($link);
      header('Location: http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  }

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional/dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ひとこと掲示板</title>
</head>
<body>
  <h1>ひとこと掲示板</h1>

  <form action="bbs.php" method="post">
    <?php if(count($errors)): ?>
    <ul class="error_list">
      <?php foreach($errors as $error): ?>
        <li>
          <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    名前：<input type="text" name="name" /></br />
    ひとこと：<input type="text" name="comment" size="60" /><br />
    <input type="submit" name="submit" value="送信" />
  </form>
  
  <?php
  // 投稿された内容を取得するSQL作成して結果を取得
  $sql = "SELECT * FROM post ORDER BY created_at DESC";
  $result = mysqli_query($link, $sql);
  ?>
  <?php if($result !== false && mysqli_num_rows($result)): ?>
  <ul>
    <?php while($post= mysqli_fetch_assoc($result)): ?>
    <li> 
      <?php echo htmlspecialchars($post["name"],ENT_QUOTES, 'UTF-8'); ?>
      <?php echo htmlspecialchars($post["comment"],ENT_QUOTES, 'UTF-8'); ?>
      -<?php echo htmlspecialchars($post["created_at"],ENT_QUOTES, 'UTF-8'); ?>
    </li>
    <?php endwhile; ?>
  </ul>
  <?php endif; ?>

  <?php 
  // 取得結果を開放して接続閉じる
  mysqli_free_result($result);
  mysqli_close($link);
  ?>
</body>
</html>