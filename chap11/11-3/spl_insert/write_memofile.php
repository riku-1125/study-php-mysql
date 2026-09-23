
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
$newdata = $date . "    " . $memo;
try {
    // ワークファイルのファイルオブジェクト（新規書き込み）
    $workingfileObj = new SplFileObject("working.tmp", "wb");
    // 新しいメモをワークファイルに書き込む
    $workingfileObj->flock(LOCK_EX); // 排他ロック
    $workingfileObj->fwrite($newdata);
    $workingfileObj->flock(LOCK_UN);
} catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
    exit();
}

// 元ファイル
$filename = "memo.txt";
// 元ファイルがあるか確認
if (file_exists($filename)) {
    // 元フィあるのファイルオブジェクト（読み込み専用モード）
    $fileObj = new SplFileObject($filename, "rb");
    $size = $fileObj->getSize();
    if ($size > 0) {
        $fileObj->flock(LOCK_SH);
        $olddata = $fileObj->fread($size);
        $fileObj->flock(LOCK_UN);

        $olddata = PHP_EOL . $olddata;

        $workingfileObj->flock(LOCK_EX);
        $workingfileObj->fwrite($olddata);
        $workingfileObj->flock(LOCK_UN);
    }

    // 元ファイルをクローズする
    $fileObj = null;
    // 元ファイルをクローズする
    unlink($filename);
}

//　作業ファイルをクローズする
$workingfileObj = null;
// 作業ファイルをクローズする
rename("working.tmp", $filename);

// リダイレクト
$url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
header("HTTP/1.1 303 See Other");
header("Location:" . $url . "/read_memofile.php");
