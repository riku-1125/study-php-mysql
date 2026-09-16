<?php
session_start();
require_once("../../lib/util.php");


if (!cken($_POST)) {
    $encording = mb_internal_encoding();
    $err = "Encording Error! The ecpected encording is" . $encording;
    // エラーメッセージを出して、以下のコード全てをキャンセルする
    exit($err);
}

$error = [];

if (empty($_SESSION["name"])) {
    $error[] = "名前を入力してください。";
} else {
    $name = $_SESSION["name"];
}

if (empty($_SESSION["kotoba"])) {
    $error[] = "好きな言葉を入力してください。";
} else {
    $kotoba = $_SESSION["kotoba"];
}

if (isset($_POST["dogcat"])) {
    $dogcat = $_POST["dogcat"];
    $diffvalue = array_diff($dogcat, ["犬", "猫"]);
    var_dump($dogcat);
    if (count($diffvalue) > 0) {
        $error[] = "犬好き猫好きの回答にエラーがありました。";
        $_SESSION["dogcat"] = [];
    } else {
        $dogcatString = implode("好きで、", $dogcat) . "好きです。";
        $_SESSION["dogcatString"] = $dogcatString;
        $_SESSION["dogcat"] = $dogcat;
    }
} else {
    $dogcatString = "どちらも好きではありません。";
    $_SESSION["dogcatString"] = $dogcatString;
    $_SESSION['dogcat'] = [];
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
<?php if (count($error) > 0) { ?>
    <!-- エラー時 -->
        <span class="error"><?php echo implode("<br>", $error); ?></span><br>
        <span>
          <input type="button" value="戻る" onclick="location.href='input.php'">
        </span>
<?php } else { ?>
    <!-- エラーがない時 -->
        <ul>
          <li>名前：<?php echo es($name) ;?></li>
          <li>好きな言葉：<?php echo es($kotoba) ;?></li>
          <li>犬猫好き？：<?php echo es($dogcatString) ;?></li>
        </ul>
        <input type="button" value="訂正する" onclick="location.href='input.php'">
        <input type="button" value="送信する" onclick="location.href='thankyou.php'">
<?php } ?>
      </form>
    </div>
  </body>
</html>
