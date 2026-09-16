<?php
require_once("../../lib/util.php");
// セッションの開始。
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>確認ページ</title>
    <link href="../../css/style.css" ref="stylesheet">
  </head>
  <body>
    <div>
<?php

if (isset($_SESSION["coupon"])) {
    $coupon = $_SESSION["coupon"];
    $couponlist = ["ABC123", "XYZ999"];
    if (in_array($coupon, $couponlist)) {
        echo es($coupon), "は、正しいクーポンコードです。";
    } else {
        echo es($coupon), "は、誤ったクーポンコードです。";
    }
} else {
    echo "セッションエラーです。";
}
?>
    </div>
  </body>
</html>

