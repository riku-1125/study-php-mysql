
<?php
// POSTされたテキストを取り出す
if (empty($_POST['memo'])) {
    // POSTされた値がない時（０の場合も含む）
    $host = $_SERVER['HTTP_HOST'];
    $self = $_SERVER['PHP_SELF'];
    $dir = dirname($self);
    $url = "http://" . $host . $dir;
    // リダイレクト（メモの入力ページに戻る）
    header("Location: " . $url . "/input_memo.php");
    exit();
}

$memo = $_POST["memo"];
$date = date("Y/n/j G:i:s", time());
$writedata = "---" . PHP_EOL . $date . PHP_EOL . $memo . PHP_EOL;
// メモファイル
$filename = "memo.txt";
try {
    // ファイルオブジェクトを作る（読み書き、追記モード）
    $fileObj = new SplFileObject($filename, "a+b");
} catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
    exit();
}

// ファイルロック（排他ロック）
$fileObj->flock(LOCK_EX);
// メモを追記する
$result = $fileObj->fwrite($writedata);
// アンロック
$fileObj->flock(LOCK_UN);

// リダイレクト（メモを読むページへ
$url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
header("Location:" . $url . "/read_memofile.php");
exit();
