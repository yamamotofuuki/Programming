<?php

// id を取得
$accountId = $_POST['id'];

// アカウント削除処理の成功・失敗を判定する変数
$result = false; // 初期値をfalseに設定

 // 削除処理を行う
try {
    $pdo = new PDO("mysql:dbname=lesson02;host=localhost;", "root", "mysql");
    
    $stmt = $pdo->prepare("UPDATE account SET delete_flag = 1 WHERE id = :id");
    $stmt->bindParam(':id', $accountId);
    $stmt->execute();
    
    // 削除成功したかどうかを確認する
    if ($stmt->rowCount() > 0) {
        echo "削除フラグを更新しました";
    } else {
        echo "削除できませんでした";
    }
    
    $result = true;
    
} catch (PDOException $e) {
    $error_message = "データベースエラー: " . $e->getMessage();
    error_log($error_message, 3, "error.log");
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>アカウント削除完了</title>
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
    <h3>アカウント削除完了画面</h3>
    <div class="confirm">
        <?php if ($result) { ?>
        <h1>削除完了しました</h1>
        <?php } else { ?>
        <h2>エラーが発生した為アカウント削除できません</h2>
        <?php } ?>
      
    <form action="index.html" method="post">
        <input type="submit" class="submi" value="TOPページに戻る">
    </form>
        
        <style>
            .confirm h1 { /* 上下のスペースを調整 */
                margin-top: 100px; 
                margin-bottom: 100px; 
            }
        
            .submi {
                border: 1px solid lightgray;
                font-size: 20px;
                padding: 5px 10px;
                padding-left: 30px;
                padding-right: 30px;
                margin: 20px;
                margin-left: 210px;
                color: white;
                background-color: orange;
                border-radius: 5px;
                border-bottom: 2px solid gray;
            }
        </style>
        
    </div>
  </main> 
<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>
   
    <script type="text/javascript" src="script.js"></script>
</body>
</html>