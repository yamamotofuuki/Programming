<?php
// セッションを開始または再開
session_start();

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

// セッション変数のデータをクリアする
session_unset();

// ユーザーがログアウトした際、セッションを破棄し新しいセッションを開始する必要がある場合
//session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>アカウント登録画面</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
  </head>

<body>
 <img src="./image/diblog_logo.jpg" width="290px"> 
<header>
  <div class="logo"></div>
    <ul>
        <li><a href="index.html">トップ</a></li>
        <li>プロフィール</li>
        <li>D.IBlogについて</li>
        <li>アカウント登録</li>
        <li>アカウント一覧</li>
        <li>問い合わせ</li>
        <li>その他</li>
    </ul>
</header>  
   
<main>  
<h3>アカウント登録画面</h3>
   
　　<form method="post" action="regist_confirm.php">
     
  <div>
    <label>名前 (姓)</label><!--ひらがな・漢字のみ指定-- name="xxx"部分は箱の名前(任意)-->
    <input type="text" maxlength="10" class="text" size="35" name="family_name"
           placeholder="山田"
           pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" value="<?php echo isset($family_name) ? htmlspecialchars($family_name, ENT_QUOTES) : ''; ?>"> <!-- 変数の中身が存在するか確認-->
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
           placeholder="太郎"
           pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" value="<?php echo isset($last_name) ? htmlspecialchars($last_name, ENT_QUOTES) : ''; ?>">
  </div>
  <?php
    // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
    if (isset($_GET['error']) && strpos($_GET['error'], '名前(名)が未入力です') !== false) {
        echo "<div class='error'>名前(名)が未入力です。</div>";
    }
  ?>
       
  <div>
    <label>カナ (姓)</label><!-- 日本語氏名のみの場合(ヵ)や(ヶ)を含む必要がないので[ァ-ヴ]-->
    <input type="text" maxlength="10" class="text" size="35" name="family_name_kana"
           placeholder="ヤマダ"
           pattern="[ァ-ヶ]*" value="<?php echo isset($family_name_kana) ? htmlspecialchars($family_name_kana, ENT_QUOTES) : ''; ?>"> 
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
           placeholder="タロウ"
           pattern="[ァ-ヶ]*" value="<?php echo isset($last_name_kana) ? htmlspecialchars($last_name_kana, ENT_QUOTES) : ''; ?>">
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
           placeholder="example@example.com"
           pattern="[A-Za-z0-9\-@.]*" value="<?php echo isset($mail) ? htmlspecialchars($mail, ENT_QUOTES) : ''; ?>">
  </div><!-- A-Z:大文字 a-z:小文字 0-9:数字 \:ハイフン @:アットマーク
　　　　　　　　→.(ドット)も含めるなら末尾に足す
　　　　　　　　→@の後ろに日本後入力できてしまうが「国際的なアドレス」で使用される為-->
  <?php
    // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
    if (isset($_GET['error']) && strpos($_GET['error'], 'メールアドレスが未入力です') !== false) {
        echo "<div class='error'>メールアドレスが未入力です。</div>";
    }
  ?>
      
  <div>
    <label>パスワード</label> <!--半角英数のみ-->
    <input type="text" pattern="^[a-zA-Z0-9]+$"  maxlength="10" class="pw" size="35"name="password"
           placeholder="Pwssword12"
           value="<?php echo isset($password) ? htmlspecialchars($password, ENT_QUOTES) : ''; ?>"
           >
  </div>
  <?php
    // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
    if (isset($_GET['error']) && strpos($_GET['error'], 'パスワードが未入力です') !== false) {
        echo "<div class='error'>パスワードが未入力です。</div>";
    }
  ?>
      
           
  <div>
    <label>性別</label>
    <input type="radio" class="man" name="gender" value="0" checked
           <?php echo ($gender == 0) ? 'checked':''; ?>>男
    <input type="radio" class="woman" name="gender" value="1"
           <?php echo ($gender == 1) ? 'checked':''; ?>>女
  </div><!--$genderが'male'と等しい場合に'checked'を返し、それ以外の場合は空文字列''を返す-->　
        <!--「value属性」で正しい値を指定-->

  <div>
    <label>郵便番号</label><!-- 半角数字のみ-->
    <input type="text" maxlength="7" class="post" size="10" name="postal_code"
           placeholder="1234567"
               pattern="^[0-9]+$" value="<?php echo isset($postal_code) ? htmlspecialchars($postal_code, ENT_QUOTES) : ''; ?>">
  </div>
  <?php
    // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
    if (isset($_GET['error']) && strpos($_GET['error'], '郵便番号が未入力です') !== false) {
        echo "<div class='error'>郵便番号が未入力です。</div>";
    }
  ?>

  <div>
    <label>住所 (都道府県)</label>
    <select class="prefecture" name="prefecture"
    value="<?php echo isset($postal_code) ? htmlspecialchars($postal_code, ENT_QUOTES) : ''; ?>"> 
        <option value=""></option>
        <option value="北海道"<?php if($prefecture =='北海道')echo'selected';?>>北海道</option>
        　　　　　　　　　　　　　　<!--セッション変数$prefectureの値が'北海道'と一致する場合
　　　　　　　　　　　　　　　　　　　　  'selected'属性を追加して、このオプションを選択状態にする-->
        <option value="青森県"<?php if($prefecture =='青森県')echo'selected';?>>青森県</option>
        <option value="岩手県"<?php if($prefecture =='岩手県')echo'selected';?>>岩手県</option>
        <option value="宮城県"<?php if($prefecture =='宮城県')echo'selected';?>>宮城県</option>
        <option value="秋田県"<?php if($prefecture =='秋田県')echo'selected';?>>秋田県</option>
        <option value="山形県"<?php if($prefecture =='山形県')echo'selected';?>>山形県</option>
        <option value="福島県"<?php if($prefecture =='福島県')echo'selected';?>>福島県</option>  
        <option value="茨城県"<?php if($prefecture =='茨城県')echo'selected';?>>茨城県</option>
        <option value="群馬県"<?php if($prefecture =='群馬県')echo'selected';?>>群馬県</option>  
        <option value="埼玉県"<?php if($prefecture =='埼玉県')echo'selected';?>>埼玉県</option>  
        <option value="千葉県"<?php if($prefecture =='千葉県')echo'selected';?>>千葉県</option>  
        <option value="東京都"<?php if($prefecture =='東京都')echo'selected';?>>東京都</option>  
        <option value="神奈川県"<?php if($prefecture =='神奈川県')echo'selected';?>>神奈川県</option>  
        <option value="新潟県"<?php if($prefecture =='新潟県')echo'selected';?>>新潟県</option>  
        <option value="富山県"<?php if($prefecture =='富山県')echo'selected';?>>富山県</option>  
        <option value="石川県"<?php if($prefecture =='石川県')echo'selected';?>>石川県</option>  
        <option value="福井県"<?php if($prefecture =='福井県')echo'selected';?>>福井県</option>  
        <option value="山梨県"<?php if($prefecture =='山梨県')echo'selected';?>>山梨県</option>  
        <option value="長野県"<?php if($prefecture =='長野県')echo'selected';?>>長野県</option>  
        <option value="岐阜県"<?php if($prefecture =='岐阜県')echo'selected';?>>岐阜県</option>  
        <option value="静岡県"<?php if($prefecture =='静岡県')echo'selected';?>>静岡県</option>  
        <option value="愛知県"<?php if($prefecture =='愛知県')echo'selected';?>>愛知県</option>  
        <option value="三重県"<?php if($prefecture =='三重県')echo'selected';?>>三重県</option>  
        <option value="滋賀県"<?php if($prefecture =='滋賀県')echo'selected';?>>滋賀県</option>  
        <option value="京都府"<?php if($prefecture =='京都府')echo'selected';?>>京都府</option>  
        <option value="大阪府"<?php if($prefecture =='大阪府')echo'selected';?>>大阪府</option>  
        <option value="兵庫県"<?php if($prefecture =='兵庫県')echo'selected';?>>兵庫県</option>  
        <option value="奈良県"<?php if($prefecture =='奈良県')echo'selected';?>>奈良県</option>  
        <option value="和歌山県"<?php if($prefecture =='和歌山県')echo'selected';?>>和歌山県</option>  
        <option value="鳥取県"<?php if($prefecture =='鳥取県')echo'selected';?>>鳥取県</option>  
        <option value="島根県"<?php if($prefecture =='島根県')echo'selected';?>>島根県</option>  
        <option value="岡山県"<?php if($prefecture =='岡山県')echo'selected';?>>岡山県</option>  
        <option value="広島県"<?php if($prefecture =='広島県')echo'selected';?>>広島県</option>  
        <option value="山口県"<?php if($prefecture =='山口県')echo'selected';?>>山口県</option>  
        <option value="徳島県"<?php if($prefecture =='徳島県')echo'selected';?>>徳島県</option>  
        <option value="香川県"<?php if($prefecture =='香川県')echo'selected';?>>香川県</option>  
        <option value="愛媛県"<?php if($prefecture =='愛媛県')echo'selected';?>>愛媛県</option>
        <option value="高知県"<?php if($prefecture =='高知県')echo'selected';?>>高知県</option>
        <option value="静岡県"<?php if($prefecture =='静岡県')echo'selected';?>>福岡県</option>
        <option value="佐賀県"<?php if($prefecture =='佐賀県')echo'selected';?>>佐賀県</option>
        <option value="長崎県"<?php if($prefecture =='長崎県')echo'selected';?>>長崎県</option>
        <option value="熊本県"<?php if($prefecture =='熊本県')echo'selected';?>>熊本県</option>
        <option value="大分県"<?php if($prefecture =='大分県')echo'selected';?>>大分県</option>
        <option value="宮崎県"<?php if($prefecture =='宮崎県')echo'selected';?>>宮崎県</option>
        <option value="鹿児島県"<?php if($prefecture =='鹿児島県')echo'selected';?>>鹿児島県</option>
        <option value="沖縄県"<?php if($prefecture =='沖縄県')echo'selected';?>>沖縄県</option>        
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
           placeholder="新宿区1丁目"
               pattern="[ぁ-んァ-ン一-龠0-9ー－\s]*" value="<?php echo isset($address_1) ? htmlspecialchars($address_1, ENT_QUOTES) : ''; ?>"> 
  </div><!-- ぁ-ん:ひらがな ァ-ン:カタカナ 一-龠:漢字 0-9:数字 ー－:長音符 \s:スペース-->
  <?php
    // もしGETパラメータにerrorが含まれている場合、エラーメッセージを表示
    if (isset($_GET['error']) && strpos($_GET['error'], '住所 (市区町村)が未入力です') !== false) {
        echo "<div class='error'>住所 (市区町村)が未入力です。</div>";
    }
  ?>
    
  <div>
    <label>住所 (番地)</label>
    <input type="text" maxlength="100" class="code" size="35" name="address_2"
           placeholder="1-2-3"
               pattern="[ぁ-ん一-龠0-9ァ-ンー－\s]*" value="<?php echo isset($address_2) ? htmlspecialchars($address_2, ENT_QUOTES) : ''; ?>">
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
    <option value="0"<?php if($authority == 0)echo'selected';?>>一般</option>
    <option value="1"<?php if($authority == 1)echo'selected';?>>管理者</option>
    </select>
  </div>
       
  <div>
    <input type="submit" class="submit" value="確認する">
  </div>
       
</form>
</main>
   
<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>
   
    <script type="text/javascript" src="script.js"></script>
</body>
</html>