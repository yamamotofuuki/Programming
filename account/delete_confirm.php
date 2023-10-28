<?php

// id を取得
$accountId = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>アカウント削除確認</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
  </head>

<body>

<header>
  <div class="logo"></div>
    <ul>
        <li>トップ</li>
        <li>プロフィール</li>
        <li>D.IBlogについて</li>
        <li>アカウント登録</li>
        <li>アカウント一覧</li>
        <li>問い合わせ</li>
        <li>その他</li>
    </ul>
</header>  

<main>
<h3>アカウント削除確認画面</h3>
    <div class="confirm">
    <h1>本当に削除しますか？</h1>
      
        <style>
            .confirm h1 { /* 上下のスペースを調整 */
                margin-top: 100px;
                margin-bottom: 100px; 
            }
        </style>
 
    <form action="delete.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $accountId; ?>">
        <input type="submit" class="submitt" value="前に戻る">
    </form>
    
    <form action="delete_complete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $accountId; ?>">
        <input type="submit" class="submit" value="削除する">
    </form>
        
    </div>
  </main> 
<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>
   
    <script type="text/javascript" src="script.js"></script>
</body>
</html>