<?php
$date = date("Y/n/j G:i:s", time());
$writedata = <<< "EOD"
ヒアドキュメントならば、
途中で改行したり、
変数を使った文章が作れますね。
更新日：$date
EOD;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ファイルに保存</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
<?php
$filename = "mytext.txt";
// touch()でファイルが存在しなければ作成（あれば日付更新）
$result = touch($filename);
if ($result) {
    // ファイルに書き出し
    file_put_contents($filename, $writedata, LOCK_EX);
    echo "{$filename}にデータを書き出しました。", "<hr>";
    echo '<a href="get_contents.php">ファイルを読み込み</a>';
} else {
    // ファイルエラー
    echo '<span clas="error">ファイルに保存できませんでした。</span>';
}
?>
    </div>
  </body>
</html>
