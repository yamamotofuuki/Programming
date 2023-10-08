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
        
    <?php
      // フォームからのデータを取得
        $family_name = $_POST['family_name'];
        $last_name = $_POST['last_name'];
        $family_name_kana = $_POST['family_name_kana'];
        $last_name_kana = $_POST['last_name_kana'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $prefecture = $_POST['prefecture'];
        $postal_code = $_POST['postal_code'];
        $address_1 = $_POST['address_1'];
        $address_2 = $_POST['address_2'];

      // 未選択の項目があるかを確認
        $errors = array();

        if (empty($family_name)) {
            $errors[] = "名前(姓)が未入力です。";
        }

        if (empty($last_name)) {
            $errors[] = "名前(名)が未入力です。";
        }
        
        if (empty($family_name_kana)) {
            $errors[] = "カナ(姓)が未入力です。";
        }
        
        if (empty($last_name_kana)) {
            $errors[] = "カナ(名)が未入力です。";
        }
        
        if (empty($mail)) {
            $errors[] = "メールアドレスが未入力です。";
        }
        
        if (empty($password)) {
            $errors[] = "パスワードが未入力です。";
        }
        
        if (empty($postal_code)) {
            $errors[] = "郵便番号が未入力です。";
        }
        
        if (empty($prefecture)) {
            $errors[] = "住所 (都道府県)が未選択です。";
        }
        
        if (empty($address_1)) {
            $errors[] = "住所 (市区町村)が未入力です。";
        }
        
        if (empty($address_2)) {
            $errors[] = "住所 (番地)が未入力です。";
        }

        // 未選択の項目がある場合、エラーメッセージを入力フォームに表示
        if (!empty($errors)) {
            $error_message = implode("<br>", $errors);
            header("Location: regist.php?error=$error_message");
            exit;
        }
    ?>

        
        <p>名前 (姓)
            <span class="space-around"><?php echo $_POST['family_name']; ?></span>
        </p><!--登録画面から送信された名前のデータをスペース開けて表示-->
        
        <p>名前 (名)
            <span class="space-around"><?php echo $_POST['last_name'];?></span>
        </p>
        
        <p>カナ (姓)
            <span class="space-around"><?php echo $_POST['family_name_kana'];?></span>
        </p>
        
        <p>カナ (名)
            <span class="space-around"><?php echo $_POST['last_name_kana'];?></span>
        </p>
        
        <p>メールアドレス
            <span class="mail"><?php echo $_POST['mail'];?></span>
        </p>
        
        <p>パスワード
            <span class="pw"><?php echo $_POST['password'];?></span>
        </p>
        
        
        <p>性別
            <span class="gender">
            <?php $gender = $_POST['gender'];// フォームから送信された性別の値を取得
                if ($gender == 'male') {// もし性別が 'male' と一致する場合「男」
                    echo '男';
                } elseif ($gender == 'female') {// もし性別が 'female' と一致する場合「女」
                    echo '女';
                } 
            ?>
            </span>
        </p>

        
        <p>郵便番号
            <span class="space-around"><?php echo $_POST['postal_code'];?></span>
        </p>
        
        <p>住所 (都道府県)
            <span class="zyuusyo"><?php echo $_POST['prefecture'];?></span>
        </p>
        
        <p>住所 (市区町村)
            <span class="zyuusyo"><?php echo $_POST['address_1'];?></span>
        </p>
        
        <p>住所 (番地)
            <span class="code"><?php echo $_POST['address_2'];?></span>
        </p>
        
        <p>アカウント権限
            <span class="account"><?php echo $_POST['authority'];?></span>
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