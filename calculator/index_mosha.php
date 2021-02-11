<?php
// POSTされた値を変数に入れる
$disp_num = $_POST["disp_num"];
$pre_num  = $_POST["pre_num"];
$input_num  = $_POST["input_num"];
$ope  = $_POST["ope"];
$button  = $_POST["button"];
$pre_button  = $_POST["pre_button"];

if(isNumBtn($button) || empty($button)) {
  // POSTされたbutton(=$button)の値が、半角数字か（isNumBtn()は半角数字とマッチしてるかを確認してtrueかfalseを返す。
  // またはカラだった時の処理

  if(isOpeBtn($pre_button)) {
    $pre_num = $disp_num;
    if(preg_match('/\./', $button )) {
      // $button(つまりポストされたボタンの値)が、任意の一文字あれば
      $disp_num = '0';
    } else {
      $disp_num = $button;
    }
  } else {
    $disp_num = $disp_num . $button;
  }
  $input_num = $disp_num;
} else {
  switch($button) {
    case 'C':
      // クリアが押されたら、変数をからにする
      $disp_num = '';
      $pre_num = '';
      $input_num = '';
      break;
    case '+/-':
      $disp_num = -$disp_num;
      break;
    case '%':
      $disp_num = $disp_num / 100;
      break;
    default:
      if(!empty($pre_num) && (preg_match('/=/', $button)) || (isOpeBtn($button) && isNumBtn($pre_num) ) ) {
        switch($ope) {
          case '+':
            $disp_num = $pre_num +$disp_num;
            break;
          case '-':
            $disp_num = $pre_num - $disp_num;
            break;
          case '×':
            $disp_num = $pre_num * $disp_num;
            break;
          case '÷':
            $disp_num = $pre_num / $disp_num;
            break;
          default:
            break;
        }
      }
      $pre_num = $input_num;
      $ope = $button == '=' ? $ope : $button;
      break;
  }
}


$pre_button = $button;

function convertDispNum($num) {
  preg_match('/(-?)(\d+)(\.?\d*)/', $num, $matches);
  // preg_match　$matchesに配列として格納される
  // -? -> -が0～1回　（$matches[1]にはいる）
  // d+ ->半角数字が1回以上　（$matches[2]にはいる）
  // .? ->　任意の一文字0～1回　と d* -> 半角数字が0回以上　（$matches[3]にはいる）
  return $matches[1] . number_format($matches[2]) . $matches[3];
  
}

function  isOpeBtn($btn) {
  return preg_match('/(+|-|×|÷)/', $btn);
  // （）の中の値が、四則演算子かどうかを確認し、1か0を返す
}

function isNumBtn($btn) {
  return preg_match('/(\d|\.)/', $btn);
  // dは全ての半角数字なので、正規表現で半角数字かどうかを確認する。（）の中の値がが半角数字か、 または　任意の一文字かどうかどうかを確認し返す。
}


;?>
<!DOCTYPE HTML>
<html lang="ja">
	<head>
		<meta charaset="utf-8">
		<title>電卓</title>
		<link rel="stylesheet" href="/style.css">
		<meta name="viewport" content="width-device-width">
	</head>
	<body>
    <h2>Calculator</h2>
    <p>
      <?php echo convertDispNum($disp_num);
      // 
      ?>
    </p>
		<form action="" method="post">
      <input type="hidden" name="disp_num" value="<?php echo $disp_num; ?>" />
      <input type="hidden" name="pre_num" value="<?php echo $pre_num; ?>">
      <input type="hidden" name="input_num" value="<?php echo $input_num; ?>">
      <input type="hidden" name="pre_button" value="<?php echo $pre_button; ?>">
      <input type="hidden" name="ope" value="<?php echo $ope; ?>">
			<table>
			<tr class="">
				<td><button type="submit" name="button" value="C">C</button></td>
				<td><button type="submit" name="button" value="+/-">+/-</button></td>
				<td><button type="submit" name="button" value="%">%</button></td>
				<td><button type="submit" name="button" value="÷">÷</button></td>
			</tr>
			<tr class="">
				<td><button type="submit" name="button" value="7">7</button></td>
				<td><button type="submit" name="button" value="8">8</button></td>
				<td><button type="submit" name="button" value="9">9</button></td>
				<td><button type="submit" name="button" value="×">×</button></td>
			</tr>
			<tr>
				<td><button type="submit" name="button" value="4">4</button></td>
				<td><button type="submit" name="button" value="5">5</button></td>
				<td><button type="submit" name="button" value="6">6</button></td>
				<td><button type="submit" name="button" value="-">-</button></td>
			</tr>
			<tr>
				<td><button type="submit" name="button" value="1">1</button></td>
				<td><button type="submit" name="button" value="2">2</button></td>
				<td><button type="submit" name="button" value="3">3</button></td>
				<td><button type="submit" name="button" value="+">+</button></td>
			</tr>
			<tr>
				<td colspan="2"><button type="submit" name="button" value="0">0</button></td>
				<td><button type="submit" name="button" value=".">.</button></td>
				<td><button type="submit" name="button" value="=">=</button></td>
				<!-- <td><button type="submit" name="button" value="+">+</button></td> -->
			</tr>
		</form>
	</body>
</html>
