<?php

// アカウント更新処理の成功・失敗を判定する変数
$result = false; // 初期値をfalseに設定

 // 更新処理を行う
try {
    $pdo = new PDO("mysql:dbname=lesson02;host=localhost;", "root", "mysql");
    
    $stmt = $pdo->prepare("select * from account");
    $stmt->bindParam(':id', $accountId);
    $stmt->execute();
    
    // 更新日時を取得 時差7時間
    $update_time = date('Y-m-d H:i:s',strtotime('+7 hours'));
    
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
    <title>アカウント更新完了</title>
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
    <h3>アカウント更新完了画面</h3>
    <div class="confirm">
        <?php if ($result) { ?>
        <h1>更新しました</h1>
        <?php } else { ?>
        <h2>エラーが発生した為アカウント更新できません</h2>
        <?php } ?>
      
    <form action="list.php" method="post">
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