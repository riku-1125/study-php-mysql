<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>フォーム入力チェック</title>
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
?>

<?php
//エラーメッセージを入れる配列
$errors = [];
//クーポンコードの代入
if (isset($_POST['couponCode'])) {
    $couponCode = $_POST['couponCode'];
} else {
    //未確認のエラー
    $couponCode = "";
}
//商品IDの代入
if (isset($_POST['goodsID'])) {
    $goodsID = $_POST['goodsID'];
} else {
    $goodsID = "";
}

//セールデータを読み込む
require_once("saleData.php");
//割引率と単価の取得
$discount = getCouponRate($couponCode);
$tanka = getPrice($goodsID);

//割引率と単価に値があるかチェック
if (is_null($discount) || is_null($goodsID)) {
    //エラーメッセージを出して、以下のコードを全てキャンセルする
    $err = '<div class="error"不正な入力がありました。';
    exit($err);
}

if (isset($_POST['kosu'])) {
    $kosu = $_POST['kosu'];
    //入力値のチェック
    if (!ctype_digit($kosu)) {
        $errors[] = "個数は整数で入力してください。";
    }
} else {
    //未確認のエラー
    $errors[] = "個数が未設定";
}

if (count($errors) > 0) {
    echo '<ol class="error"';
    foreach ($errors as $value) {
        echo "<li>", $value, "</li>";
    }
    echo "<ol>";
} else {
    $price = $tanka * $kosu;
    $discount_price = floor($price * $discount);
    $off_price = $price - $discount_price;
    $off_per = (1 - $discount) * 100;
    //三桁位取り
    $tanka_fmt = number_format($tanka);
    $discount_price_fmt = number_format($discount_price);
    $off_price_fmt = number_format($off_price);
    //表示する
    echo "単価：{$tanka_fmt}円、", "個数；{$kosu}", "<br>";
    echo "金額：{$discount_price_fmt}円、", "<br>";
    echo "(割引：-{$off_price_fmt}円、", "{$off_per}% OFF)", "<br>";
}
?>

<!-- 戻るボタンのフォーム -->
  <form method="POST" action="discountForm.php">
    <!-- 見えない入力に個数をせってしてPOSTをする。--->
    <input type="hidden" name="kosu" value="<?php echo $kosu ?>">
    <ul>
      <li><input type="submit" value="戻る"></li>
    </ul>
  </form>

</div>
</body>
</html>
