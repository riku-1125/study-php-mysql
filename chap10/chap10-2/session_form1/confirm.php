<?php
require_once("../../lib/util.php");

// セッションの開始
session_start();

if (!cken($_POST)) {
    $encording = mb_internal_encoding();
    $err = "Encording Error! The ecpected encording is" . $encording;
    // エラーメッセージを出して、以下のコード全てをキャンセルする
    exit($err);
}

if (isset($_POST["name"])) {
    $_SESSION["name"] = trim(mb_convert_kana($_POST["name"], "s"));
}
if (isset($_POST["kotoba"])) {
    $_SESSION["kotoba"] = trim(mb_convert_kana($_POST["kotoba"], "s"));
}

$errors = [];

if (empty($_SESSION["name"])) {
    $errors[] = "名前を入力してください。";
} else {
    $name = $_SESSION["name"];
}

if (empty($_SESSION["kotoba"])) {
    $errors[] = "好きな言葉を入力してください。";
} else {
    $kotoba = $_SESSION["kotoba"];
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>確認ページ</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
      <form>
<?php
if (count($errors) > 0) {
    ?>
        <span class="error"><?php echo implode("<br>", $errors); ?></span><br>
        <span>
        <input type="button" value="戻る" onclick="location.href='input.html'">
        </span>
    <?php
} else {
    ?>
        <span>
        名前：<?php echo es($name); ?><br>
        好きな言葉：<?php echo es($kotoba); ?><br>
        <input type="button" value="戻る" onclick="location.href='input.html'">
        <input type="button" value="送信する" onclick="location.href='thankyou.php'">
        </span>
    <?php
}
?>
      </form>
    </div>
  </body>
</html>
