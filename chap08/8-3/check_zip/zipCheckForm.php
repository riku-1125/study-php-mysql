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
if (isset($_POST['zip'])) {
    //郵便番号を取り出す
    $zip = trim($_POST['zip']);
    //郵便番号のパターン
    $pattern = "/^[0-9]{3}-[0-9]{4}$/";
    if (!preg_match($pattern, $zip)) {
        //郵便番号の形式になっていない
        $errors[] = "郵便番号を正しく入力してください！";
    }
} else {
    //未設定のエラー
    $errors[] = "郵便番号を正しく入力してください。";
}
?>

<?php
if (count($errors) > 0) {
  //エラーがあったとき
    echo '<ol class="error">';
    foreach ($errors as $value) {
        echo "<li>", $value , "</li>";
    }
    echo "</ol>";
} else {
  // エラーがなかったとき
    echo "郵便番号は{$zip}です。";
}
?>
    </div>
  </body>
</html>
