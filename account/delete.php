<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8">
    <title>アカウント削除</title>
    <link rel="stylesheet" type="text/css" href="style4.css">
  </head>

<body>
    
    <?php
    mb_internal_encoding("utf8");
    $pdo = new PDO("mysql:dbname=lesson02;host=localhost;", "root", "mysql");

    if (isset($_GET['id'])) {
        $accountId = $_GET['id'];
        // データベースから選択したアカウント情報を取得するSQLクエリを実行
        $stmt = $pdo->prepare("SELECT * FROM account WHERE id = :id");
        $stmt->bindParam(':id', $accountId);
        $stmt->execute();
    }
   ?>

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
  <h3>アカウント削除画面</h3>
    
    <div class="main-container">
      <?php
        
       $row = $stmt->fetch();  //DBからレコードを取り出す
              $gender = $row['gender'];
              $authority = $row['authority'];

              // DBから取得した性別、権限、数値をテキストに変換
              if ($gender == 0) {
                  $genderText = '男';
              } elseif ($gender == 1) {
                  $genderText = '女';
              }

              if ($authority == 0) {
                  $authorityText = '一般';
              } elseif ($authority == 1) {
                  $authorityText = '管理者';
              } 
       ?>
           <!-- 一覧画面から遷移した際に該当のデータをスペース開けて表示 -->
        <label class="name-label">名前 (姓)</label><?php echo $row['family_name']; ?><br>
        <label class="name-label">名前 (名)</label><?php echo $row['last_name']; ?><br>
        <label class="name-label">カナ (姓)</label><?php echo $row['family_name_kana']; ?><br>
        <label class="name-label">カナ (名)</label><?php echo $row['last_name_kana']; ?><br>
        <label class="mail">メールアドレス</label><?php echo $row['mail']; ?><br>
        <label class="pw">パスワード</label>
        
        <?php echo str_pad("●●●●●●●●●●", strlen($row['password'])); ?>
        <br> <!-- 通常、実際のパスワードを再度表示(逆変換)できないので、任意での「●」表示 -->
        
        <label class="gender">性別</label><?php echo $genderText; ?><br>
        
        <?php
        $postal_code = $row['postal_code'];
        if ($postal_code == "0000000") {
            $postal_code = "0000000";
        } else {
            $postal_code = ltrim($postal_code, '0'); //0で埋められた先頭の文字列を指定し削除して取得
        }
        ?>
        <label class="name-label">郵便番号</label><?php echo $postal_code; ?><br>
        
        <label class="zyuusyo">住所(都道府県)</label><?php echo $row['prefecture']; ?><br>
        <label class="zyuusyo">住所(市区町村)</label><?php echo $row['address_1']; ?><br>
        <label class="code">住所(番地)</label><?php echo $row['address_2']; ?><br>
        <label class="account">アカウント権限</label><?php echo $authorityText; ?><br>
        
        <form action="delete_confirm.php">
            <input type="hidden" name="id" value="<?php echo $accountId; ?>">
            <input type="submit" class="submit" value="確認する">
        </form>
        
    </div>
</main>

<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>

</body>
</html>
