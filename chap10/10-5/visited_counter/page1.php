
<?php
require_once("../../lib/util.php");
// クッキーの値があれば取り出す。
if (isset($_COOKIE["visitedLog"])) {
    $logdata = $_COOKIE["visitedLog"];
    $counter = $logdata["counter"];
    $time = $logdata["time"];
    $lasttime = date("Y年n月j日 A g時i分", $time);
} else {
    $counter = 0;
    $lasttime = "今回が初めての訪問";
}

$resulte1 = setcookie('visitedLog[counter]', ++$counter, time() + 60 * 60 * 24);
$resulte2 = setcookie('visitedLog[time]', time(), time() + 60 * 60 * 24);
$resulte = ($resulte1 && $resulte2);

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
if ($resulte) {
    echo "このページの訪問は", es($counter), "回目です。", "<br>";
    echo "前回の訪問：", es($lasttime), "<hr>";
    echo '<a href="page2.php">このページを移動する。</a>', "<br>";
    echo '(<a href="reset_counter.php">リセットする</a>)';
} else {
    echo '<span class="error">クッキーが利用できませんでした。</span>';
}
?>
    </div>
  </body>
</html>
