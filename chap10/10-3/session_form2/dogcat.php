<?php

// セッションの開始
session_start();
require_once("../../lib/util.php");

// $_POSTに変数があった時、それをセッション変数に渡す
if (isset($_POST["name"])) {
    $_SESSION["name"] = trim(mb_convert_kana($_POST["name"], "s"));
}
if (isset($_POST["kotoba"])) {
    $_SESSION["kotoba"] = trim(mb_convert_kana($_POST["kotoba"], "s"));
}
if (empty($_SESSION['dogcat'])) {
    $dogcat = [];
} else {
    $dogcat = $_SESSION["dogcat"];
}


function checked(string $value, array $checkedValue)
{
    // 選択する前に値が含まれているかどうかをしらべる
    $isChecked = in_array($value, $checkedValue);
    if ($isChecked) {
        // チェック状態にする
        echo "checked";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>犬派猫派ページ</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
      アンケート（１/ ２）<br>
      <form method="POST" action="confirm.php">
        <ul>
          <li>犬が好きですか？猫が好きですか？<br>
            <label><input type="checkbox" name="dogcat[]" value="犬" <?php checked("犬", $dogcat); ?>>犬</label>
            <label><input type="checkbox" name="dogcat[]" value="猫" <?php checked("猫", $dogcat); ?>>猫</label>
          </li>
        </ul>
        <input type="button" value="戻る" onclick="location.href='input.php'">
        <input type="submit" value="確認する">
      </form>
    </div>
  </body>
</html>
