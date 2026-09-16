<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>スライダー</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <dev>
<?php
require_once("../../lib/util.php");
if (!cken($_POST)) {
    $encording = mb_internal_encoding();
    $err = "Encoding Error! The expected encoding is " . $encording;
    exit($err);
}

$_POST = es($_POST);


$errors = [];

$min = 1;
$max = 5;

if (isset($_POST["taste"])) {
    $taste = $_POST["taste"];
    $istaste = ctype_digit($taste) && ($taste >= $min) && ($max >= $taste);
    if (!$istaste) {
        $errors[] = "甘味の値にエラーがありました";
        $taste = $min;
    }
} else {
    $taste = round(($min + $max) / 2);
    $istaste = true;
}
?>
      <!-- 入力フォーム-->
      <form method="POST" action="<?php echo es($_SERVER['PHP_SELF']); ?>">
        <ul>
          <li><span>甘味：</span>
            <input type="range" name="taste" step="1" <?php echo "min={$min} max={$max} value={$taste}"; ?>>
          </li>
          <li><input type="submit" value="送信する"</li>
        </ul>
      </form>
<?php
if ($istaste) {
    $tastelist = ["甘い", "少し甘い","普通","少し苦い","苦い"];
    echo "<hr>";
    echo "甘味は「{$taste}.{$tastelist[$taste - 1]}」です。";
}

// error表示
if (count($errors)) {
    echo "<hr>";
    echo '<span class="error">', implode("<br>", $errors), "</span>";
}
?>
    </dev>
  </body>
</html>
