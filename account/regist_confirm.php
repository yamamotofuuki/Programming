<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>アカウント登録確認</title>
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
<h3>アカウント登録確認画面</h3>
    
    <div class="confirm">
        <p>名前 (姓)
            <?php echo $_POST['family_name'];?>  <!--登録画面から送信された名前のデータを表示-->
        </p>
        
        <p>名前 (名)
            <?php echo $_POST['last_name'];?>
        </p>
        
        <p>カナ (姓)
            <?php echo $_POST['family_name_kana'];?>
        </p>
        
        <p>カナ (名)
            <?php echo $_POST['last_name_kana'];?>
        </p>
        
        <p>メールアドレス
            <?php echo $_POST['mail'];?>
        </p>
        
        <p>パスワード
            <?php echo $_POST['password'];?>
        </p>
        
        <p>性別
            <?php echo $_POST['gender'];?>
        </p>
        
        <p>郵便番号
            <?php echo $_POST['postal_code'];?>
        </p>
        
        <p>住所 (都道府県)
            <?php echo $_POST['prefecture'];?>
        </p>
        
        <p>住所 (市区町村)
            <?php echo $_POST['address_1'];?>
        </p>
        
        <p>住所 (番地)
            <?php echo $_POST['address_2'];?>
        </p>
        
        <p>アカウント権限
            <?php echo $_POST['authority'];?>
        </p>
        
    <form action="regist.php">
        <input type="submit" class="submitt" value="前に戻る">
    </form>
    
    <form action="regist_complete.php" method="post">
        <input type="submit" class="submit" value="登録する">
            <!--htmlから引き渡されたpostをregist_complete.phpへと送信-->
        <input type="hidden" value="<?php echo $_POST ['family_name'];?>" name="family_name">
        <input type="hidden" value="<?php echo $_POST ['last_name'];?>" name="last_name">
        <input type="hidden" value="<?php echo $_POST ['family_name_kana'];?>" name="family_name_kana">
        <input type="hidden" value="<?php echo $_POST ['last_name_kana'];?>" name="last_name_kana">
        <input type="hidden" value="<?php echo $_POST['mail'];?>" name="mail">
        <input type="hidden" value="<?php echo $_POST['password'];?>" name="password">
        <input type="hidden" value="<?php echo $_POST ['gender'];?>" name="gender">
        <input type="hidden" value="<?php echo $_POST ['postal_code'];?>" name="postal_code">
        <input type="hidden" value="<?php echo $_POST ['prefecture'];?>" name="prefecture">
        <input type="hidden" value="<?php echo $_POST ['address_1'];?>" name="address_1">
        <input type="hidden" value="<?php echo $_POST ['address_2'];?>" name="address_2">
        <input type="hidden" value="<?php echo $_POST ['authority'];?>" name="authority">
    </form>
        
    </div>
  </main> 
<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>
   
    <script type="text/javascript" src="script.js"></script>
</body>
</html>