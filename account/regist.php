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
        <label>名前 (姓)</label>
        <input type="text" maxlength="10" class="text" size="35" name="family_name" value="<?php echo $name; ?>">
     </div><!-- name="xxx"部分は箱の名前(任意)-->
       
     <div>
        <label>名前 (名)</label>
        <input type="text" maxlength="10" class="text" size="35" name="last_name"  value="<?php echo $name; ?>">
     </div>
       
     <div>
        <label>カナ (姓)</label>
        <input type="text" maxlength="10" class="text" size="35" name="family_name_kana">
     </div>
       
     <div>
        <label>カナ (名)</label>
        <input type="text" maxlength="10" class="text" size="35" name="last_name_kana">
     </div>
       
      <div>
        <label>メールアドレス</label>
        <input type="email" maxlength="100" class="maill" size="35" name="mail" value="<?php echo $mail; ?>">  
      </div>
       
      <div>
        <label>パスワード</label>
        <input type="text" pattern="^[a-zA-Z0-9]+$"  maxlength="10" class="pw" size="35" name="password">  <!--半角英数のみ-->
      </div>
       
      <div>
        <label>性別</label>
        <input type="radio" class="man" name="gender" checked>男
        <input type="radio" class="woman" name="gender">女
      </div>
     
      <div>
        <label>郵便番号</label>
        <input type="text" maxlength="7" class="post" size="10" name="postal_code">  
      </div>

      <div>
        <label>住所 (都道府県)</label>
        <select class="prefecture" name="prefecture">
        <option value="0"></option>
        <option value="1">北海道</option>
        <option value="2">青森県</option>
        <option value="3">岩手県</option>
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
     
      <div>
        <label>住所 (市区町村)</label>
        <input type="text" maxlength="10" class="prefecture" size="35" name="address_1">  
      </div>
     
      <div>
        <label>住所 (番地)</label>
        <input type="text" maxlength="100" class="code" size="35" name="address_2">  
      </div>
     
      <div>
        <label>アカウント権限</label>
        <select class="prefecture" name="authority">
        <option value="1">一般</option>
        <option value="2">管理者</option>
       
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