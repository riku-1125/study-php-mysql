<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>チェックボックス</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php
require_once("../../lib/util.php");
//文字エンコード検証
if (!cken($_POST)) {
    $encoding = mb_internal_encoding();
    $err = "Encoding Error! The expected encoding is " . $encoding ;
    // エラーメッセージを出して、以下のコードをすべてキャンセルする
    exit($err);
}
// HTMLエスケープ（XSS対策）
$_POST = es($_POST);

//エラーを入れる配列
$errors = [];
//POSTされた$maelsを取り出す
if (isset($_POST["meal"])) {
    $meals = ["朝食", "夕食"];
    $diffValue = array_diff($_POST["meal"], $meals);

    //想定外の値が含まれていなければtrue
    if (!count($diffValue)) {
        $mealChecked = $_POST["meal"];
    } else {
        //食事に$mealsにない値が含まれてた時
        $mealChecked = [];
        $errors[] = "「食事」にエラーがありました。";
    }
} else {
    //POSTされた値がない時
    $mealChecked = [];
}
//POSTされた$toursを取り出す
if (isset($_POST["tour"])) {
    $tours = ["カヌー", "MTB", "トレラン"];
    $diffValue = array_diff($_POST["tour"], $tours);

    //想定外の値が含まれていなければtrue
    if (!count($diffValue)) {
        $tourChecked = $_POST["tour"];
    } else {
        //食事に$toursにない値が含まれてた時
        $tourChecked = [];
        $errors[] = "「食事」にエラーがありました。";
    }
} else {
    //POSTされた値がない時
    $tourChecked = [];
}

//チェック状態にするか決める関数定義
function checked(string $value, array $checkedVlues)
{
    $isCheked = in_array($value, $checkedVlues);
    if ($isCheked) {
        //チェック状態にする
        echo "checked";
    }
}
?>
      <form method="POST" action="<?php echo es($_SERVER['PHP_SELF']); ?>">
        <ul>
          <li><span>食事：</span>
            <label><input type="checkbox" name="meal[]" value="朝食" <?php checked("朝食", $mealChecked); ?> >朝食</label>
            <label><input type="checkbox" name="meal[]" value="夕食" <?php checked("夕食", $mealChecked); ?> >夕食</label>
          </li>
          <li><span>ツアー：</span>
            <label><input type="checkbox" name="tour[]" value="カヌー" <?php checked("カヌー", $tourChecked); ?> >カヌー</label>
            <label><input type="checkbox" name="tour[]" value="MTB" <?php checked("MTB", $tourChecked); ?> >MTB</label>
            <label><input type="checkbox" name="tour[]" value="トレラン" <?php checked("トレラン", $tourChecked); ?> >トレラン</label>
          </li>
          <li><input type="submit" value="送信する"</li>
        </ul>
      </form>
<?php
//食事とツアーのどちらかが受信されていれば結果を表示する
$isSelected = count($mealChecked) > 0 || count($tourChecked) > 0;
if ($isSelected) {
    echo "<HR>";
    echo "お食事：", implode("と、", $mealChecked), "<br>";
    echo "ツアー：", implode("と、", $tourChecked), "<br>";
} else {
    echo "<HR>";
    echo "選択されてるものがありません。";
}

if (count($errors) > 0) {
    echo "<HR>";
    echo '<span class="error">', implode("<br>", $errors), "</span>";
}
?>
    </div>
  </body>
</html>
