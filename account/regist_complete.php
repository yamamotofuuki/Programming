<?php

mb_internal_encoding("utf8");

// アカウント登録処理の成功・失敗を判定する変数
$result = false; // 初期値をfalseに設定

try {
    $pdo = new PDO("mysql:dbname=lesson02;host=localhost;","root","mysql");

    // パスワードをハッシュ化
    //PASSWORD_DEFAULTの指定で、PHPが利用可能な最適なハッシュアルゴリズムを選択
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if ($hashedPassword == false) {
        echo "パスワードのハッシュ化に失敗しました。";
    } else {
        // ハッシュ化が成功した場合は、$hashedPassword をデータベースに格納するなどの処理を行う。
    }
    
    
    // 登録日時を取得 時差7時間
        $registered_time = date('Y-m-d H:i:s',strtotime('+7 hours'));
    
     // 削除フラグを設定 intval=整数に変換する関数
    $delete_flag = intval('delete_flag');
   
    
    $pdo ->exec("insert into account(
    family_name,last_name,family_name_kana,last_name_kana,mail,password,gender,postal_code,
    prefecture,address_1,address_2,authority,delete_flag,registered_time)value

   ('".$_POST['family_name']."','".$_POST['last_name']."','".$_POST['family_name_kana']."',
    '".$_POST['last_name_kana']."','".$_POST['mail']."','".$hashedPassword."',
    '".$_POST['gender']."','".$_POST['postal_code']."','".$_POST['prefecture']."',
    '".$_POST['address_1']."','".$_POST['address_2']."','".$_POST['authority']."',
    '".$delete_flag."','".$registered_time."');");
    $result = true;
    
} catch (PDOException $e) { //〈Exception〉= 全ての例外を補足
    //echo "データベースエラー:".$e->getMessage(); //ブラウザ上での表示
    $error_message = "データベースエラー:".$e->getMessage();
    error_log($error_message, 3, "error.log"); // エラーメッセージを「error.log」に記録
}
?>

<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8">
    <title>アカウント登録完了画面</title>
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
      <li>問い合わせ</li>
      <li>その他</li>
    </ul>
</header>

<main>
  <h3>アカウント登録完了画面</h3>
    <div class="complete">
        <?php if ($result) { ?>
            <h1>登録完了しました</h1>
        <?php } else { ?>
            <h2>エラーが発生した為アカウント登録できません</h2>
        <?php } ?>
    </div>

    <form action="index.html">
        <input type="submit" class="submit3" value="TOPページへ戻る">
    </form>
</main>

<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>

</body>
</html>
