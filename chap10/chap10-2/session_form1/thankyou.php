
<?php
require_once("../../lib/util.php");

// セッションの開始
session_start();
$errors = [];
// セッションから変数を取り出す
if (!empty($_SESSION["name"]) && !empty($_SESSION["kotoba"])) {
    // セッション変数から値をを取り出す
    $name = $_SESSION['name'];
    $kotoba = $_SESSION['kotoba'];
} else {
    $errors[] = "セッションエラーです。";
}

// HTMLを表示すす前にセッションを破棄する
killsession();

function killsession()
{
    $_SESSION = [];
    // セッションクッキーを破棄する
    if (isset($_COOKIE[session_name()])) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 36000, $params['path']);
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
<?php
if (count($errors) > 0) {
    ?>
      <span class="error"><?php echo implode('<br>', $errors); ?></span><br>
      <a href="input.html">最初のページに戻る</a>
    <?php
} else {
    ?>
      <span>
        次のように受け付けました。ありがとうございました。
        <hr>
        <span>
          名前：<?php echo es($name); ?><br>
          好きな言葉：<?php echo es($kotoba); ?><br>
          <a href="input.html">最初のページに戻る</a>
        </span>
      </span>
    <?php
}
?>
    </div>
  </body>
</html>
