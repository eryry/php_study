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

  // 取得した結果を$postsに格納
  $posts=[];
  if($result !==false && mysqli_num_rows($result)) {
    while($post= mysqli_fetch_assoc($result)) {
      $posts[]= $post;
    }
  }
  ?>
  <?php if(count($posts) > 0): ?>
  <ul>
    <?php foreach($posts as $post): ?>
    <li> 
      <?php echo htmlspecialchars($post["name"],ENT_QUOTES, 'UTF-8'); ?>
      <?php echo htmlspecialchars($post["comment"],ENT_QUOTES, 'UTF-8'); ?>
      -<?php echo htmlspecialchars($post["created_at"],ENT_QUOTES, 'UTF-8'); ?>
    </li>
   <?php endforeach; ?>
  </ul>
  <?php endif; ?>

  <?php 
  // 取得結果を開放して接続閉じる
  mysqli_free_result($result);
  mysqli_close($link);
  ?>
</body>
</html>