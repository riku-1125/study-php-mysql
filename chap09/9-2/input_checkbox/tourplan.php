<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>チェックボックス</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php
require_once("../../lib/util.php");
//文字エンコード検証
if (!cken($_POST)) {
    $encoding = mb_internal_encoding();
    $err = "Encoding Error! The expected encoding is " . $encoding ;
    // エラーメッセージを出して、以下のコードをすべてキャンセルする
    exit($err);
}
// HTMLエスケープ（XSS対策）
$_POST = es($_POST);

//エラーを入れる配列
$errors = [];
//POSTされた$maelsを取り出す
if (isSet($_POST["meal"])) {
    $meals = ["朝食", "夕食"];
    $diffValue = array_diff($_POST["meal"], $meals);

    //想定外の値が含まれていなければtrue
    if (!count($diffValue)) {
        $mealChecked = $_POST["meal"];
    } else {
        //食事に$mealsにない値が含まれてた時
        $mealChecked = [];
        $errors[] = "「食事」にエラーがありました。";
    }
} else {
    //POSTされた値がない時
    $mealChecked = [];
}
//POSTされた$toursを取り出す
if (isSet($_POST["tour"])) {
    $tours = ["カヌー", "MTB", "トレラン"];
    $diffValue = array_diff($_POST["tour"], $tours);

    //想定外の値が含まれていなければtrue
    if (!count($diffValue)) {
        $tourChecked = $_POST["tour"];
    } else {
        //食事に$toursにない値が含まれてた時
        $tourChecked = [];
        $errors[] = "「食事」にエラーがありました。";
    }
} else {
    //POSTされた値がない時
    $tourChecked = [];
}

//チェック状態にするか決める関数定義
function checked (string $value, array $checkedVlues)
{
    $ischecked
}
    </div>
  </body>
</html>
