<!DOCTYPY html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>プルダウンメニュー</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php
error_log(print_r($_POST, true));
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

// エラーを入れる配列
$errors = [];
// POSTされた「性別」を取り出す
if (isset($_POST["sex"])) {
    //性別かどうか確認する。
    $sexValues = ["男性", "女性"];
    $issex = in_array($_POST["sex"], $sexValues);
    //sexValuesに含まれているか否かでの処理分岐
    if ($issex) {
        $sex = $_POST["sex"];
    } else {
        $sex = "error";
        $errors[] = "「性別」に入力エラーがあります。";
    }
} else {
    //POSTされた値がない時
    $issex = false;
    $sex = "男性";
}

// POSTされた「結婚」を取り出す
if (isset($_POST["marriage"])) {
    // 結婚の要素か確認する
    $marriageValues = ["独身", "既婚", "同棲中"];
    $ismarriage = in_array($_POST["marriage"], $marriageValues);

    if ($ismarriage) {
        $marriage = $_POST["marriage"];
    } else {
        $marriage = "error";
        $errors[] = "「結婚」に入力エラーがあります。";
    }
} else {
    $marriage = "独身";
    $ismarriage = false;
}

function selected(string $value, array $selectedValue)
{
    $isselected = in_array($value, $selectedValue);
    if ($isselected) {
        echo "selected";
    }
}
?>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <ul>
          <li><span>性別：</span>
            <select name="sex">
              <option value="男性", <?php selected("男性", [$sex]) ;?>>男性</option>
              <option value="女性", <?php selected("女性", [$sex]) ;?>>女性</option>
            </select>
          </li>
          <li><span>結婚：</span>
            <select name="marriage">
              <option value="独身", <?php selected("独身", [$marriage]) ;?>>独身</option>
              <option value="既婚", <?php selected("既婚", [$marriage]) ;?>>既婚</option>
              <option value="同棲中", <?php selected("同棲中", [$marriage]) ;?>>同棲中</option>
            </select>
          </li>
          <li><input type="submit" value="送信ボタン"</li>
        </ul>
      </form>
<?php
$issubmited = $issex > 0 && $ismarriage;
if ($issubmited) {
    echo "<HR>";
    echo "あなたは「{$sex}」で、かつ「{$marriage}」です。";
}
// エラー表示
if (count($errors)) {
    echo "<HR>";
    echo '<span class="error">', implode("<br>", $errors), "</span>";
}
?>
    </div>
  </body>
</html>

