<!DOCTYPE html>
<html charset="utf-8">
  <head>
    <title>リストボックス</title>
    <link herf="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php
require_once("../../lib/util.php");
if (!cken($_POST)) {
    $encording = mb_internal_encoding();
    $err = "Encording Error! The ecpected encording is" . $encording;
    // エラーメッセージを出して、以下のコード全てをキャンセルする
    exit($err);
}
$_POST = es($_POST);

$errors = [];

if (isset($_POST["meal"])) {
    $meals = ["朝食", "夕食"];
    $diffValue = array_diff($_POST["meal"], $meals);
    if (count($diffValue) == 0) {
        $mealSelected = $_POST["meal"];
    } else {
        $mealSelected = [];
        $errors[] = "「食事」にエラーがありました。";
    }
} else {
    $mealSelected = [];
}

if (isset($_POST["tour"])) {
    $tours = ["カヌー", "MTB", "トレラン"];
    $diffValue = array_diff($_POST["tour"], $tours);

    if (count($diffValue) == 0) {
        $tourSelected = $_POST["tour"];
    } else {
        $tourSelected = [];
        $errors[] = "「ツアー」にエラーがありました。";
    }
} else {
    $tourSelected = [];
}

function selected(string $value, array $selectedValue)
{
    $isSelected = in_array($value, $selectedValue);
    if ($isSelected) {
        echo "selected";
    }
}
?>

<!-- 入力フォーム -->
      <form method="POST" action="<?php echo es($_SERVER["PHP_SELF"]); ?>">
        <ul>
          <li><span>食事：</span>
            <select name="meal[]" size="2" multiple>
              <option value="朝食" <?php selected("朝食", $mealSelected); ?>>朝食</option>
              <option value="夕食" <?php selected("夕食", $mealSelected); ?>>夕食</option>
            </select>
          </li>
          <li><span>ツアー：</span>
            <select name="tour[]" size="3" multiple>
              <option value="カヌー" <?php selected("カヌー", $tourSelected); ?>>カヌー</option>
              <option value="MTB" <?php selected("MTB", $tourSelected); ?>>MTB</option>
              <option value="トレラン" <?php selected("トレラン", $tourSelected); ?>>トレラン</option>
            </select>
          </li>
          <li><input type="submit" value="送信する"></li>
        </ul>
      </form>
<?php
$isSelected = count($mealSelected) > 0 || count($tourSelected) > 0;
if ($isSelected) {
    echo "<hr>";
    echo "お食事: ", implode("と", $mealSelected), "<br>";
    echo "ツアー: ", implode("と", $tourSelected), "<br>";
} else {
    echo "<hr>";
    echo "選択されてるものがありません。";
}

if (count($errors) > 0) {
    echo "<hr>";
    echo '<span class="error"', implode("<br>", $errors), "</span>";
}
?>
    </div>
  </body>
</html>
