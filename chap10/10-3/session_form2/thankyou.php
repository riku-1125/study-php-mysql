
<?php
require_once("../../lib/util.php");

session_start();

$error = [];
if (!empty($_SESSION["name"]) && !empty($_SESSION["kotoba"])) {
    $name = $_SESSION["name"];
    $kotoba = $_SESSION["kotoba"];
    $dogcatString = $_SESSION["dogcatString"];
} else {
    $error[] = "セッションエラーです。";
}

// htmlを表示するためにセッションを終了する
killSession();

function killSession()
{
    // セッション変数をからに
    $_SESSION = [];
    // セッションクッキーを破棄する
    if (isset($_COOKIE[session_name()])) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params['path']);
    }
    // セッションを破棄する
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>完了ページ</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php if (count($error) > 0) { ?>
    <!-- エラー時 -->
      <span class="error"><?php echo implode("<br>", $error); ?></span><br>
      <input type="button" value="最初のページに戻る" onclick="location.href='input.php'">
<?php } else { ?>
    <!-- エラーがなかった時 -->
    次のように受付けました。ありがとうございました。
      <hr>
      <ul>
        <li>名前：<?php echo es($name); ?></li>
        <li>好きな言葉：<?php echo es($kotoba); ?></li>
        <li>犬猫好き？：<?php echo es($dogcatString); ?></li>
      </ul>
<?php } ?>
    </div>
  </body>
</html>
