<?php
// セッションを開始または再開
session_start();

var_dump($_SESSION);

// //ログインなし、または一般権限でアクセスした場合にエラー表示
if ($_SESSION['authority'] != '1') {
    if ($_SESSION['authority'] != '0' || $_SESSION['authority'] == '0') {
        echo "<p>アクセス権限がありません。</p>";
        exit();
    }
}

// セッション変数から値を取得し、フォームに表示
$family_name = isset($_SESSION['family_name']) ? $_SESSION['family_name'] : '';
$last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';
$family_name_kana = isset($_SESSION['family_name_kana']) ? $_SESSION['family_name_kana'] : '';
$last_name_kana = isset($_SESSION['last_name_kana']) ? $_SESSION['last_name_kana'] : '';
$mail = isset($_SESSION['mail']) ? $_SESSION['mail'] : '';
$password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
$gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : '';
$postal_code = isset($_SESSION['postal_code']) ? $_SESSION['postal_code'] : '';
$prefecture = isset($_SESSION['prefecture']) ? $_SESSION['prefecture'] : '';
$address_1 = isset($_SESSION['address_1']) ? $_SESSION['address_1'] : '';
$address_2 = isset($_SESSION['address_2']) ? $_SESSION['address_2'] : '';
$authority = isset($_SESSION['authority']) ? $_SESSION['authority'] : '';

// セッション変数のデータを指定してクリアする
unset($_SESSION['family_name']);
unset($_SESSION['last_name']);
unset($_SESSION['family_name_kana']);
unset($_SESSION['last_name_kana']);
unset($_SESSION['mail']);
unset($_SESSION['password']);
unset($_SESSION['gender']);
unset($_SESSION['postal_code']);
unset($_SESSION['prefecture']);
unset($_SESSION['address_1']);
unset($_SESSION['address_2']);
//session_unset();

// ユーザーがログアウトした際、セッションを破棄し新しいセッションを開始する必要がある場合
//session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8">
    <title>アカウント更新</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
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
        $row = $stmt->fetch(); // アカウント情報を取得
        
        $family_name = $row['family_name'];
        $last_name = $row['last_name'];
        $family_name_kana = $row['family_name_kana'];
        $last_name_kana = $row['last_name_kana'];
        $mail = $row['mail'];
        
       // $row が未定義でないことを確認する
        if (isset($row) && isset($row['password'])) {
            $passwordLength = strlen($row['password']);
            $maskedPassword = str_pad("", 0); //「●」の数を指定
        }
        
        $gender = $row['gender'];
        
        $postal_code = $row['postal_code'];
        if ($postal_code == "0000000") {
            $postal_code = "0000000";
        } else {
            $postal_code = ltrim($postal_code, '0'); //0で埋められた先頭の文字列を指定し削除して取得
        }
        
        $address_1 = $row['address_1'];
        $address_2 = $row['address_2'];
        $prefecture = $row['prefecture']; // 住所情報を取得
        $authority = $row['authority']; // 住所情報を取得
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
<h3>アカウント更新画面</h3>
    
  <div class="main-container">
    <form action="update_confirm.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $accountId; ?>">
     
    <div>
      <label>名前 (姓)</label>
        <input type="text" maxlength="10" class="text" size="35" name="family_name"
               placeholder="山田" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" 
               value="<?php echo isset($family_name) ? 
               htmlspecialchars($family_name, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], '名前(姓)が未入力です') !== false) {
        echo "<div class='error'>名前(姓)が未入力です。</div>";
      }
    ?>
        
    <div>    
      <label>名前 (名)</label>
        <input type="text" maxlength="10" class="text" size="35" name="last_name"
               placeholder="太郎" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" 
               value="<?php echo isset($last_name) ? 
               htmlspecialchars($last_name, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], '名前(名)が未入力です') !== false) {
        echo "<div class='error'>名前(名)が未入力です。</div>";
      }
    ?>
        
    <div>    
      <label>カナ (姓)</label>
        <input type="text" maxlength="10" class="text" size="35" name="family_name_kana"
               placeholder="ヤマダ" pattern="[ァ-ヶ]*" 
               value="<?php echo isset($family_name_kana) ? 
               htmlspecialchars($family_name_kana, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], 'カナ(姓)が未入力です') !== false) {
        echo "<div class='error'>カナ(姓)が未入力です。</div>";
      }
    ?>
        
    <div>   
      <label>カナ (名)</label>
        <input type="text" maxlength="10" class="text" size="35" name="last_name_kana"
               placeholder="タロウ" pattern="[ァ-ヶ]*" 
               value="<?php echo isset($last_name_kana) ? 
               htmlspecialchars($last_name_kana, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], 'カナ(名)が未入力です') !== false) {
        echo "<div class='error'>カナ(名)が未入力です。</div>";
      }
    ?>
        
    <div>   
      <label>メールアドレス</label>
        <input type="email" maxlength="100" class="maill" size="35" name="mail"
               placeholder="example@example.com" pattern="[A-Za-z0-9\-@.]*" 
               value="<?php echo isset($mail) ? htmlspecialchars($mail, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], 'メールアドレスが未入力です') !== false) {
        echo "<div class='error'>メールアドレスが未入力です。</div>";
      }
    ?>
        
    <div>   
      <label>パスワード</label>
        <input type="text" maxlength="10" class="pw" size="35" name="password"
               placeholder="●●●●●●●●●●" pattern="^[a-zA-Z0-9]+$" 
               value="<?php echo isset($maskedPassword) ? 
               htmlspecialchars($maskedPassword, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], 'パスワードが未入力です') !== false) {
        echo "<div class='error'>パスワードが未入力です。</div>";
      }
    ?>
        
    <div>
      <label>性別</label>
      <input type="radio" class="man" name="gender" value="0"
             <?php echo isset($gender) && $gender == 0 ? 'checked' : ''; ?>>男
      <input type="radio" class="woman" name="gender" value="1"
             <?php echo isset($gender) && $gender == 1 ? 'checked' : ''; ?>>女
    </div>
        
    <div>   
      <label>郵便番号</label>
        <input type="text" maxlength="7" class="post" size="10" name="postal_code"
               placeholder="1234567" pattern="^[0-9]+$" 
               value="<?php echo isset($postal_code) ? 
               htmlspecialchars($postal_code, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], '郵便番号が未入力です') !== false) {
        echo "<div class='error'>郵便番号が未入力です。</div>";
      }
    ?>
    
    <div>   
      <label>住所 (都道府県)</label>
        <select class="prefecture" name="prefecture">
        <option value=""></option>
        <option value="北海道"<?php echo isset($prefecture) && $prefecture == '北海道' ?
        'selected' : ''; ?>>北海道</option>
            
        <option value="青森県"<?php echo isset($prefecture) && $prefecture == '青森県' ?
        'selected' : ''; ?>>青森県</option>
            
        <option value="岩手県"<?php echo isset($prefecture) && $prefecture == '岩手県' ?
        'selected' : ''; ?>>岩手県</option>
            
        <option value="宮城県"<?php echo isset($prefecture) && $prefecture == '宮城県' ? 
        'selected' : ''; ?>>宮城県</option>
        
        <option value="秋田県"<?php echo isset($prefecture) && $prefecture == '秋田県' ? 
        'selected' : ''; ?>>秋田県</option>
            
        <option value="山形県"<?php echo isset($prefecture) && $prefecture == '山形県' ? 
        'selected' : ''; ?>>山形県</option>
            
        <option value="茨城県"<?php echo isset($prefecture) && $prefecture == '茨城県' ? 
        'selected' : ''; ?>>茨城県</option>
            
        <option value="群馬県"<?php echo isset($prefecture) && $prefecture == '群馬県' ? 
        'selected' : ''; ?>>群馬県</option>
            
        <option value="埼玉県"<?php echo isset($prefecture) && $prefecture == '埼玉県' ? 
        'selected' : ''; ?>>埼玉県</option>
            
        <option value="千葉県"<?php echo isset($prefecture) && $prefecture == '千葉県' ? 
        'selected' : ''; ?>>千葉県</option>
            
        <option value="東京都"<?php echo isset($prefecture) && $prefecture == '東京都' ? 
        'selected' : ''; ?>>東京都</option>    
            
        <option value="神奈川県"<?php echo isset($prefecture) && $prefecture == '神奈川県' ? 
        'selected' : ''; ?>>神奈川県</option>    
            
        <option value="新潟県"<?php echo isset($prefecture) && $prefecture == '新潟県' ? 
        'selected' : ''; ?>>新潟県</option>
            
        <option value="富山県"<?php echo isset($prefecture) && $prefecture == '富山県' ? 
        'selected' : ''; ?>>富山県</option>    
            
        <option value="石川県"<?php echo isset($prefecture) && $prefecture == '石川県' ? 
        'selected' : ''; ?>>石川県</option>
            
        <option value="福井県"<?php echo isset($prefecture) && $prefecture == '福井県' ? 
        'selected' : ''; ?>>福井県</option>
            
        <option value="山梨県"<?php echo isset($prefecture) && $prefecture == '山梨県' ? 
        'selected' : ''; ?>>山梨県</option>
            
        <option value="長野県"<?php echo isset($prefecture) && $prefecture == '長野県' ? 
        'selected' : ''; ?>>長野県</option>
            
        <option value="岐阜県"<?php echo isset($prefecture) && $prefecture == '岐阜県' ? 
        'selected' : ''; ?>>岐阜県</option>
            
        <option value="静岡県"<?php echo isset($prefecture) && $prefecture == '静岡県' ? 
        'selected' : ''; ?>>静岡県</option>
            
        <option value="愛知県"<?php echo isset($prefecture) && $prefecture == '愛知県' ? 
        'selected' : ''; ?>>愛知県</option>
            
        <option value="三重県"<?php echo isset($prefecture) && $prefecture == '三重県' ? 
        'selected' : ''; ?>>三重県</option>
            
        <option value="滋賀県"<?php echo isset($prefecture) && $prefecture == '滋賀県' ? 
        'selected' : ''; ?>>滋賀県</option>
            
        <option value="京都府"<?php echo isset($prefecture) && $prefecture == '京都府' ? 
        'selected' : ''; ?>>京都府</option>
            
        <option value="大阪府"<?php echo isset($prefecture) && $prefecture == '大阪府' ? 
        'selected' : ''; ?>>大阪府</option>
            
        <option value="兵庫県"<?php echo isset($prefecture) && $prefecture == '兵庫県' ? 
        'selected' : ''; ?>>兵庫県</option>
            
        <option value="奈良県"<?php echo isset($prefecture) && $prefecture == '奈良県' ? 
        'selected' : ''; ?>>奈良県</option>
            
        <option value="和歌山県"<?php echo isset($prefecture) && $prefecture == '和歌山県' ? 
        'selected' : ''; ?>>和歌山県</option>
            
        <option value="鳥取県"<?php echo isset($prefecture) && $prefecture == '鳥取県' ? 
        'selected' : ''; ?>>鳥取県</option>
            
        <option value="島根県"<?php echo isset($prefecture) && $prefecture == '島根県' ? 
        'selected' : ''; ?>>島根県</option>
            
        <option value="岡山県"<?php echo isset($prefecture) && $prefecture == '岡山県' ? 
        'selected' : ''; ?>>岡山県</option>
            
        <option value="広島県"<?php echo isset($prefecture) && $prefecture == '広島県' ? 
        'selected' : ''; ?>>広島県</option>
        
        <option value="山口県"<?php echo isset($prefecture) && $prefecture == '山口県' ? 
        'selected' : ''; ?>>山口県</option>
            
        <option value="徳島県"<?php echo isset($prefecture) && $prefecture == '徳島県' ? 
        'selected' : ''; ?>>徳島県</option>
        
        <option value="香川県"<?php echo isset($prefecture) && $prefecture == '香川県' ? 
        'selected' : ''; ?>>香川県</option>
            
        <option value="愛媛県"<?php echo isset($prefecture) && $prefecture == '愛媛県' ? 
        'selected' : ''; ?>>愛媛県</option>
            
        <option value="高知県"<?php echo isset($prefecture) && $prefecture == '高知県' ? 
        'selected' : ''; ?>>高知県</option>
            
        <option value="佐賀県"<?php echo isset($prefecture) && $prefecture == '佐賀県' ? 
        'selected' : ''; ?>>佐賀県</option>
            
        <option value="長崎県"<?php echo isset($prefecture) && $prefecture == '長崎県' ? 
        'selected' : ''; ?>>長崎県</option>
            
        <option value="熊本県"<?php echo isset($prefecture) && $prefecture == '熊本県' ? 
        'selected' : ''; ?>>熊本県</option>
            
        <option value="大分県"<?php echo isset($prefecture) && $prefecture == '大分県' ? 
        'selected' : ''; ?>>大分県</option>
            
        <option value="宮崎県"<?php echo isset($prefecture) && $prefecture == '宮崎県' ? 
        'selected' : ''; ?>>宮崎県</option>
            
        <option value="鹿児島県"<?php echo isset($prefecture) && $prefecture == '鹿児島県' ? 
        'selected' : ''; ?>>鹿児島県</option>
            
        <option value="沖縄県"<?php echo isset($prefecture) && $prefecture == '沖縄県' ? 
        'selected' : ''; ?>>沖縄県</option>
            
        </select>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], '住所 (都道府県)が未選択です') !== false) {
        echo "<div class='error'>住所 (都道府県)が未選択です。</div>";
      }
    ?>
        
    <div>   
      <label>住所 (市区町村)</label>
        <input type="text" maxlength="10" class="prefecture" size="35" name="address_1"
               placeholder="新宿区1丁目" pattern="[ぁ-んァ-ン一-龠0-9ー－\-s]*" 
               value="<?php echo isset($address_1) ? htmlspecialchars($address_1, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], '住所 (市区町村)が未入力です') !== false) {
        echo "<div class='error'>住所 (市区町村)が未入力です。</div>";
      }
    ?>
        
    <div>   
      <label>住所 (番地)</label>
        <input type="text" maxlength="100" class="code" size="35" name="address_2"
               placeholder="1-2-3" pattern="[ぁ-ん一-龠0-9ァ-ンー－\-s]*" 
               value="<?php echo isset($address_2) ? htmlspecialchars($address_2, ENT_QUOTES) : ''; ?>"><br>
    </div>
    <?php
      // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
      if (isset($_GET['error']) && strpos($_GET['error'], '住所 (番地)が未入力です') !== false) {
        echo "<div class='error'>住所 (番地)が未入力です。</div>";
      }
    ?>
        
    <div>
      <label>アカウント権限</label>
      <select class="prefecture" name="authority">
      <option value="0"<?php echo isset($authority) && $authority == 0 ? 'selected' : ''; ?>>一般</option>
      <option value="1"<?php echo isset($authority) && $authority == 1 ? 'selected' : ''; ?>>管理者</option>
      </select>
    </div>
        
          
    <div>
      <input type="submit" class="submit" value="確認する">
    </div>
        
  </form>
        
  </div>
</main>

<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>

</body>
</html>
