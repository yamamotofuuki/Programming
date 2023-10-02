<?php

mb_internal_encoding("utf8");

$pdo = new PDO("mysql:dbname=lesson02;host=localhost;","root","mysql");

$pdo ->exec("insert into account(
family_name,last_name,family_name_kana,last_name_kana,mail,password,gender,postal_code,
prefecture,address_1,address_2,authority)value

('".$_POST['family_name']."','".$_POST['last_name']."','".$_POST['family_name_kana']."',
'".$_POST['last_name_kana']."','".$_POST['mail']."','".$_POST['password']."',
'".$_POST['gender']."','".$_POST['postal_code']."','".$_POST['prefecture']."',
'".$_POST['address_1']."','".$_POST['address_2']."','".$_POST['authority']."');");

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
        <h1>登録完了しました</h1>
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
