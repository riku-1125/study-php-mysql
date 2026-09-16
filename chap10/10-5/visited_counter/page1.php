
<?php
require_once("../../lib/util.php");
// クッキーの値があれば取り出す。
if (isset($_COOKIE["visitedCount"])) {
    $visitedCount = $_COOKIE["visitedCount"];
} else {
    $visitedCount = 0;
}

$result = setcookie("visitedCount", ++$visitedCount, time() + 60 * 5);
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Page1</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php
if ($result) {
    echo "このページの訪問は", es($visitedCount), "回目です。", "<hr>";
    echo '<a href="page2.php">このページを移動する。</a>', "<br>";
    echo '(<a href="reset_counter.php">リセットする</a>)';
} else {
    echo '<span class="error">クッキーが利用できませんでした。</span>';
}
?>
    </div>
  </body>
</html>
