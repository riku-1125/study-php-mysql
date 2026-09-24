<!DOCTYPE heml>
<html lang="ja">
  <head>
    <meta charset="uft-8">
    <title>メモの入力</title>
    <link href="../../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
      <!-- 入力フォームを作る（メモをPOSTする）-->
      <form method="POST" action="write_memofile.php">
        <ul>
          <li><span>memo: </span>
            <textarea name="memo" cols="25" rows="4" maxlength="100" placeholder="メモ"></textarea>
          </li>
          <li>
            <input type="submit" value="送信する">
          </li>
        </ul>
      </form>
    </div>
  </body>
</html>
