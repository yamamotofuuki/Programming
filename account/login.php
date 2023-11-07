<?php
session_start();

var_dump($_SESSION);

mb_internal_encoding("utf8");

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // データベースへの接続
        $pdo = new PDO("mysql:dbname=lesson02;host=localhost;", "root", "mysql");
        
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        // 入力されたメールアドレスをもとにアカウントを取得
        $stmt = $pdo->prepare("SELECT * FROM account WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // ログイン成功時の処理
            $_SESSION['user_id'] = $user['id']; // セッションにユーザーIDを保存(ログイン済であることを記録)
            $_SESSION['authority'] = $user['authority']; // また、権限情報を取得
            // ログイン後のページにリダイレクトする処理
            header("Location: index.php"); // ログイン後のページにリダイレクトする
            exit();
        } else {
            // ログイン失敗時の処理
            header("Location: login.php?error=1"); // ログイン失敗時のエラーをGETパラメータで渡す
            exit();
        }
      } catch (PDOException $e) {
          $error_message = "データベースエラー: " . $e->getMessage();
          //error_log($error_message, 3, "error.log");
          echo $error_message;
      }
  }

// ユーザーがログアウトした際、セッションを破棄する
$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
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
<h3>ログイン画面</h3>
    
  <div class="main-container">
    <form action="login.php" method="POST">
      <input type="hidden" name="id">
        
    <div>   
      <label>メールアドレス</label>
        <input type="email" maxlength="100" class="maill" size="35" name="mail"
               pattern="[A-Za-z0-9\-@.]*" required><br>
    </div>
        
    <div>   
      <label>パスワード</label>
        <input type="text" maxlength="10" class="pw" size="35" name="password"
               pattern="^[a-zA-Z0-9]+$" required><br>
    </div>
        
    <?php
      if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo "<div class='error'>⚠メールアドレスまたはパスワードが違います</div>";
      }
    ?>
        
    <?php
      // エラーメッセージを表示
      if (!empty($error_message)) {
        echo "<h2>エラーが発生したためログイン情報を取得できません</h2>";
      }
    ?>
        
    <div>
        <input type="submit" class="submi" value="ログイン">
        <style>
            .submi {
                border: 1px solid lightgray;
                font-size: 20px;
                padding: 5px 10px;
                padding-left: 30px;
                padding-right: 30px;
                margin: 20px;
                margin-left: 180px;
                color: black;
                background-color: lightgray;
                border-radius: 5px;
                border-bottom: 2px solid gray;
            }
            
            h2 {
                color: red;
                margin-left: 40px;
            }
        </style>
    </div>
        
  </form>
        
  </div>
</main>

<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>

</body>
</html>
