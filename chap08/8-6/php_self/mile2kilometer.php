<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>計算ページ</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>

<?php
require_once("../../lib/util.php");
// 文字エンコードの検証
if (!cken($_POST)) {
    $encoding = mb_internal_encoding();
    $err = "Encoding Error! The expected encoding is " . $encoding ;
    // エラーメッセージを出して、以下のコードをすべてキャンセルする
    exit($err);
}
// HTMLエスケープ（XSS対策）
$_POST = es($_POST);

//POSTされた値を取り出す
if (isset($_POST["mile"])) {
    $is_num = is_numeric($_POST["mile"]);
    if ($is_num) {
        //数値ならば計算式とフォーム表示の値を使う
        $mile = $_POST["mile"];
        $error = "";
    } else {
        $mile = "";
        $error = '<span class="error"><-数値を入力してください。</span>';
    }
} else {
    //POSTされた値がない時
    $is_num = false;
    $mile = "";
    $error = "";
}
?>
      <form method="POST" action="<?php echo es($_SERVER['PHP_SELF']); ?>">
        <ul>
          <li>
            <label>
              <input type="text" name="mile" value="<?php echo $mile; ?>">
            </label>
            <!-- エラー表示 -->
            <?php echo $error; ?>
          </li>
          <li>
            <input type="submit" value="計算する">
          </li>
        </ul>
      </form>

<?php
// $mileが数値であれば計算結果を表示する
if ($is_num) {
    echo "<HR>";
    $kirometer = $mile * 1.609344;
    echo "{$mile}マイルは{$kirometer}です。";
}
?>
    </div>
  </body>
</html>
