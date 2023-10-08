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
    <input type="radio" class="man" name="gender" value="male" checked>男
    <input type="radio" class="woman" name="gender" value="female">女
  </div>　　　　　　　　　　　　　　　　　<!--「value属性」で正しい値を指定-->
 
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
        <option value="0"></option>
        <option>北海道</option>
        <option>青森県</option>
        <option>岩手県</option>
        <option value="4">宮城県</option>
        <option value="5">秋田県</option>
        <option value="6">山形県</option>
        <option value="7">福島県</option>  
        <option value="8">茨城県</option>  
        <option value="9">群馬県</option>  
        <option value="10">埼玉県</option>  
        <option value="11">千葉県</option>  
        <option value="12">東京都</option>  
        <option value="13">神奈川県</option>  
        <option value="14">新潟県</option>  
        <option value="15">富山県</option>  
        <option value="16">石川県</option>  
        <option value="17">福井県</option>  
        <option value="18">山梨県</option>  
        <option value="19">長野県</option>  
        <option value="20">岐阜県</option>  
        <option value="21">静岡県</option>  
        <option value="22">愛知県</option>  
        <option value="23">三重県</option>  
        <option value="24">滋賀県</option>  
        <option value="25">京都府</option>  
        <option value="26">大阪府</option>  
        <option value="27">兵庫県</option>  
        <option value="28">奈良県</option>  
        <option value="29">和歌山県</option>  
        <option value="30">鳥取県</option>  
        <option value="31">島根県</option>  
        <option value="32">岡山県</option>  
        <option value="33">広島県</option>  
        <option value="34">山口県</option>  
        <option value="35">徳島県</option>  
        <option value="36">香川県</option>  
        <option value="38">愛媛県</option>
        <option value="39">高知県</option>
        <option value="40">福岡県</option>
        <option value="41">佐賀県</option>
        <option value="42">長崎県</option>
        <option value="43">熊本県</option>
        <option value="44">大分県</option>
        <option value="45">宮崎県</option>
        <option value="56">鹿児島県</option>
        <option value="47">沖縄県</option>        
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
    <option>一般</option>
    <option>管理者</option>
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