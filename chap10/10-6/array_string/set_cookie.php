
<?php
require_once("../../lib/util.php");
// 保存する配列
$fruits = ["りんご", "みかん", "レモン", "バナナ"];
$valueString = implode("&", $fruits);
// クッキーに保存する
$result = setcookie("fruits", $valueString);
?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>クッキーを保存する</title>
    <link href="../../css/style.css" rel="stulesheet">
  </head>
  <body>
    <div>
<?php
if ($result) {
    echo "好きなフルーツを保存しました。", "<br>";
    echo '<a href="check_cookie.php">クッキーを確認する</a>';
} else {
    echo '<span class="error">クッキーが利用できませんでした。</span>';
}
?>
    </div>
  </body>
</html>
