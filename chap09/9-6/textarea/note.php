<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>テキストエリア</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php
require_once("../../lib/util.php");

if (!cken($_POST)) {
    $encording = mb_internal_encoding();
    $err = "Encording Error! The ecpected encording is" . $encording;
    // エラーメッセージを出して、以下のコード全てをキャンセルする
    exit($err);
}
if (isset($_POST["note"])) {
    $note = $_POST["note"];
    // HTMLタグや、PHPタグを削除する
    $note = strip_tags($note);
    // 最大150文字だけ取り出す(改行コードもカウントする)
    $note = mb_substr($note, 0, 150);
    // htmlエスケープを行う
    $note = es($note);
} else {
    $note = "";
}
?>
      <!-- 入力フォーム-->
      <form method="POST" action="<?php echo es($_SERVER['PHP_SELF']); ?>">
        <ul>
          <li><span>NOTE:</span>
            <textarea name="note" cols="25" row="4" maxlength="100" placeholder="コメントをどうぞ"><?php echo $note; ?></textarea>
          </li>
          <li><input type="submit" value="送信する"</li>
        </ul>
      </form>
<?php

$length = mb_strlen($note);
if ($length > 0) {
    echo "<hr>";
    $note_br = nl2br($note, false);
    echo $note_br;
}
?>
    </div>
  </body>
</html>
