<?php

// $accountId をセッションから取得
session_start();
$accountId = $_SESSION['accountId'];

// アカウント更新処理の成功・失敗を判定する変数
$result = false; // 初期値をfalseに設定

 // 更新処理を行う
try {
    $pdo = new PDO("mysql:dbname=lesson02;host=localhost;", "root", "mysql");
    
    // 現在のパスワードを取得
    $stmt = $pdo->prepare("SELECT password FROM account WHERE id = :id");
    $stmt->bindParam(':id', $accountId);
    $stmt->execute();
    $currentPassword = $stmt->fetchColumn();

    if ($_POST['password'] !== "") {
        // 新しいパスワードが入力された場合、新しいパスワードをハッシュ化
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if ($hashedPassword == false) {
            echo "パスワードのハッシュ化に失敗しました。";
        } else {
            // ハッシュ化が成功した場合は、$hashedPassword をデータベースに格納するなどの処理を行う。
        }
    }
    
    // 更新日時を取得 時差7時間
    $update_time = date('Y-m-d H:i:s',strtotime('+8 hours'));
    
    
    $stmt = $pdo->prepare("UPDATE account SET family_name = :family_name,
                           last_name = :last_name, family_name_kana = :family_name_kana,
                           last_name_kana = :last_name_kana, mail = :mail, password = :password,
                           gender = :gender, postal_code = :postal_code, 
                           prefecture = :prefecture, 
                           address_1 = :address_1, address_2 = :address_2,
                           authority = :authority, update_time = :update_time 
                           WHERE id = :id");
    
    // 以下のif文でパスワードの入力有無を確認し、パスワードが入力されている場合にパラメータを追加する
    if ($_POST['password'] !== "") {
        $stmt->bindValue(':password', $hashedPassword); // ハッシュ化したパスワードをバインド
    } else {
        // パスワードが空の場合、以前のパスワードをそのまま使用
        $stmt->bindValue(':password', $currentPassword); // 以前のハッシュ値をバインド
    }
    
    $stmt->bindParam(':family_name', $_POST['family_name']);
    $stmt->bindParam(':last_name', $_POST['last_name']);
    $stmt->bindParam(':family_name_kana', $_POST['family_name_kana']);
    $stmt->bindParam(':last_name_kana', $_POST['last_name_kana']);
    $stmt->bindParam(':mail', $_POST['mail']);
    $stmt->bindParam(':gender', $_POST['gender']);
    $stmt->bindParam(':postal_code', $_POST['postal_code']);
    $stmt->bindParam(':prefecture', $_POST['prefecture']);
    $stmt->bindParam(':address_1', $_POST['address_1']);
    $stmt->bindParam(':address_2', $_POST['address_2']);
    $stmt->bindParam(':authority', $_POST['authority']);
    $stmt->bindParam(':update_time', $update_time);
    $stmt->bindParam(':id', $accountId);

    $stmt->execute();
    
    $result = true;
    
} catch (PDOException $e) {
    $error_message = "データベースエラー: " . $e->getMessage();
    error_log($error_message, 3, "error.log");
    //echo $error_message;
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
        <h1>更新完了しました</h1>
        <?php } else { ?>
        <h2>エラーが発生した為アカウント更新できません</h2>
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