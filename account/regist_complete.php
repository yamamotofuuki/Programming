<?php

mb_internal_encoding("utf8");

$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","mysql");

$pdo ->exec("insert into contactform(
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
    <link rel="stylesheet" type="text/css" href="style2.css">
  </head>

  <body>
    
      <h3>アカウント登録完了画面</h3>
      <div class="confirm">
          <h1>登録完了しました</h1>
      </div>
      
    <form action="index.html">
        <input type="submit" class="button1" value="TOPページへ戻る">
    </form>
      
  </body>
</html>
