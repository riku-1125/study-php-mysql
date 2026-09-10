<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ラジオボタン</title>
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
//POSTされた性別を取り出す
if (isset($_POST["sex"])) {
    //性別かどうか確認する
    $sexvalues = ["男性", "女性"];
    //$sexvaluesに含まれていたらtrue
    $isSex = in_array($_POST["sex"], $sexvalues);
    if ($isSex) {
        //選択されてる値を取り出す
        $sex = $_POST["sex"];
    } else {
        $sex = "error";
        $errors[] = "性別に入力エラーがありました。";
    }
} else {
    //POSTされた値がない時
    $isSex = false;
    $sex = "男性";
}
//POSTされた結婚を取り出す
if (isset($_POST["marriage"])) {
    //結婚かどうか確認する
    $marriagevalues = ["独身", "既婚", "同棲中"];
    //$marriagevaluesに含まれていたらtrue
    $isMarriage = in_array($_POST["marriage"], $marriagevalues);
    if ($isMarriage) {
        //選択されてる値を取り出す
        $marriage = $_POST["marriage"];
    } else {
        $marriage = "error";
        $errors[] = "結婚に入力エラーがありました。";
    }
} else {
    //POSTされた値がない時
    $isMarriage = false;
    $marriage = "独身";
}

//チェック状態にするかどうか調べる
function checked(string $value, array $chrckefValies)
{

    //選択する値が引数の配列に含まれているか調べる
    $isChecked = in_array($value, $chrckefValies);
    if ($isChecked) {
        // チェック状態にするためのecho
        echo "checked";
    }
}
?>
<!-- 入力フォームを作る -->
        <form method="POST" action="<?php echo es($_SERVER['PHP_SELF']); ?>">
        <ul>
            <li>
            <span>性別：</span>
            <label><input type="radio" name="sex" value="男性" <?php checked("男性", [$sex]); ?> >男性</label>
            <label><input type="radio" name="sex" value="女性" <?php checked("女性", [$sex]); ?> >女性</label>
            </li>
            <li><span>結婚：</span>
                <label><input type="radio" name="marriage" value="独身" <?php checked("独身", [$marriage]) ; ?> >独身</label>
                <label><input type="radio" name="marriage" value="既婚" <?php checked("既婚", [$marriage]); ?> >既婚</label>
                <label>
                    <input type="radio" name="marriage" value="同棲中" <?php checked("同棲中", [$marriage]); ?> >同棲中
                </label>
            </li>
            <li><input type="submit" value="送信する" ></li>
        </ul>
        </form>
<?php
//性別と結婚が受信されていれば血kを表示する
$isSubmited = $isSex && $isMarriage;
if ($isSubmited) {
    echo "<HR>";
    echo "あなたは「{$sex}、{$marriage}」です。";
}
//エラー表示
if (count($errors) > 0) {
    echo "<HR>";
    //値を"<br>"で連結して表示する
    echo '<span class="error">', implode("<br", $errors), '</span>';
}
?>
    </div>
  </body>
</html>
