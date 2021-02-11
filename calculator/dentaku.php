<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h2>電卓を作るよ</h2>

<form action="dentaku.php" method="post">

<?php
//もし＝が押されたら
if(isset($_POST['result'])){

//割り算の時
 if($_POST["button"] === "÷"){
 $set = $_POST["one"] / $_POST["two"];
  echo '<input type="text" value="' .$set. '" name="two">'; //割り算の値を表示
 }

 //掛け算の時
 if($_POST["button"] === "×"){
 $set=$_POST["one"] * $_POST["two"];
 echo '<input type="text" value="'.$set.'" name ="two">'; //掛け算の値を表示
 }

 //引き算の時
 if($_POST["button"] === "-"){
 $set=$_POST["one"] - $_POST["two"];
 echo '<input type="text" value="'.$set.'" name="two">'; //引き算の値を表示
 }

 //足し算の時
 if($_POST["button"] === "+"){
 $set=$_POST["one"] + $_POST["two"];
 echo '<input type="text" value="'.$set.'" name="two">'; //足し算の値を表示
 }

}else{

if(isset($_POST["button"])){ //もし「÷×+-」が押されたら
 if(isset($_POST["one"])){ //一つ目の数字
     echo '<input type="text" value="'.$_POST["one"].'" name="one">';
     echo '<input type="text" value="'.$_POST["button"].'" name="button">';

 if(isset($_POST["two"])){ //二つ目の数字
     $set=$_POST["two"].$_POST["num"];
     echo '<input type="text" value=' .$set.' name="two">';

 }else{
     echo '<input type="text" value="' .$_POST ["num"].'" name="two">';
 }
 }else{
     echo '<input type="text" value=' .$_POST ["two"].' name="one">';
     echo '<input type="text" value=' .$_POST ["button"].' name="button">';
 }
 }else{

// 二回連続で数字が押された時
 if (isset($_POST ["num"])) {// もし「数字」が押されたら
     if (isset($_POST ["two"])){// 後者の数字がセットされたら
        $set = $_POST ["two"] . $_POST ["num"] ;// セットされた数字＋2回目にセットした数字を合わせる
        echo '<input type="text" value=' .$set.' name="two">';// 1の後に1を押したら11になり、それを後者にセットする
     } else {
     echo '<input type="text" value="' .$_POST ["num"].'" name="two">';// 後者の数字をセットする
     }
 }else{
    echo '<input type="text" value="0" name="set">';
 }
 }
}

?>



<table>

<tr>
<td><input type="submit" name="" value="AC"></td>
<td><input type="submit" name="" value="+/-"></td>
<td><input type="submit" name="" value="%"></td>
<td><input type="submit" name="button" value="÷"></td>
</tr>

<tr>
<td><input type="submit" name="num" value="7"></td>
<td><input type="submit" name="num" value="8"></td>
<td><input type="submit" name="num" value="9"></td>
<td><input type="submit" name="button" value="×"></td>
</tr>

<tr>
<td><input type="submit" name="num" value="4"></td>
<td><input type="submit" name="num" value="5"></td>
<td><input type="submit" name="num" value="6"></td>
<td><input type="submit" name="button" value="-"></td>
</tr>

<tr>
<td><input type="submit" name="num" value="1"></td>
<td><input type="submit" name="num" value="2"></td>
<td><input type="submit" name="num" value="3"></td>
<td><input type="submit" name="button" value="+"></td>
</tr>

<tr>
<td colspan="2"><input type="submit" name="button" value="0"></td>
<td><input type="submit" name="button" value="."></td>
<td><input type="submit" name="result" value="="></td>
</tr>

</table>
</form>

</body>
</html>