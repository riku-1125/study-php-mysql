<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>割引購入ページ</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php
require_once("../../lib/util.php");
//文字エンコードの検証
if (!cken($_POST)) {
    $encodeing = mb_internal_encoding();
    $err = "Encoding Error! The ecpected encodeing is" . $encodeing;
    //エラーメッセージを出して、以下のコードを全てキャンセルする
    exit($err);
}
//HTMLエスケープ（XSS対策）
$_POST = es($_POST);

if (isset($_POST['kosu'])) {
    $kosu = $_POST['kosu'];
} else {
    $kosu = "";
}

//セールデータを読み込む
require_once("saleData.php");
//クーポンコードと商品ID
$couponCode = "ha45as";
$goodsID = "ax102";
//割引率と単価取得
$discount = getCouponRate($couponCode);
$tanka = getPrice($goodsID);
if (is_null($discount) || is_null($tanka)) {
    //エラーメッセージを出して以下のコードを全てキャンセルする
    $err = '<div class="error">不正な操作がありました。</div>';
    exit($err);
}

$off = (1 - $discount) * 100;
if ($discount > 0) {
    echo "<h2>このページでのご購入は{$off}%OFFとなります。！！！</h2>";
}
//　三桁位取り
$tanka_fmt = number_format($tanka);
?>
      <!-- 入力フォームを作る --->
      <form method="POST" action="discount.php">
        <input type="hidden" name="couponCode" value="<?php echo $couponCode; ?>">
        <input type="hidden" name="goodsID" value="<?php echo $goodsID; ?>">
        <ul>
          <li><label>単価：<?php echo $tanka_fmt; ?>円</label></li>
          <li><label>個数：
        <input type="number" name="kosu" value="<?php echo $kosu; ?>">
          </label></li>
          <li><input type="submit" value="計算する"></li>
        </ul>
      </form>
    </div>
  </body>
</html>
