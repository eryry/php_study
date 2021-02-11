<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $num1 = $_GET['num1'];
        $num2 = $_GET['num2'];

        $operation = $_GET['r1'];

        if ($operation === "Add") {
            $add = $num1 + $num2;
            echo ("足し算の結果: " . $add);
        } else if ($operation === "Sub") {
            $sub = $num1 - $num2;
            echo ("引き算の結果: " . $sub);
        } else if ($operation === "mul") {
            $mul = $num1 * $num2;
            echo ("掛け算の結果: " . $mul);
        } else if ($operation === "div") {
            if ($num2 == 0) {
                echo ("0での割り算はできません");
            } else {
                $div = $num1 / $num2;
                echo ("割り算の結果: " . $div);
            }
        }
        ?>
    </body>
</html>