<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8">
    <title>アカウント一覧画面</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
  </head>

<body>
  <?php

    mb_internal_encoding("utf8");
    $pdo = new PDO("mysql:dbname=lesson02;host=localhost;","root","mysql");
    
    $stmt = $pdo->query("select * from account order by id desc"); 
    //情報を抽出する際のselect文 + ソートは降順表示

  ?>

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
  <h3>アカウント一覧画面</h3>
  <div class="main-container">
      <table>
          <tr> <!-- Table Row =表の行 ・Table Header =表の見出し-->
              <th>ID</th>
              <th>名前 (姓)</th>
              <th>名前 (名)</th>
              <th>カナ (姓)</th>
              <th>カナ (名)</th>
              <th>メールアドレス</th>
              <th>性別</th>
              <th>アカウント権限</th>
              <th>削除フラグ</th>
              <th>登録日時</th>
              <th>更新日時</th>
              <th>操作</th>
          </tr>
          <?php
         
          while ($row = $stmt->fetch()){  //DBからレコードを取り出しwhile文でループ処理
              $gender = $row['gender'];
              $authority = $row['authority'];
              $deleteFlag = $row['delete_flag'];
              // 登録日時をフォーマットする
              $registeredTime = date('Y-m-d', strtotime($row['registered_time']));
              
              // 更新日時をフォーマットする
              $update_time = date('Y-m-d', strtotime($row['update_time']));


              // DBから取得した性別、権限、削除フラグの数値をテキストに変換
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
    
              if ($deleteFlag == 0) {
                  $deleteFlagText = '有効';
              } elseif ($deleteFlag == 1) {
                  $deleteFlagText = '無効';
              }
              
              echo "<tr>"; // 新しい行を開始
              echo "<td>".$row['id']."</td>";
              echo "<td>".$row['family_name']."</td>";
              echo "<td>".$row['last_name']."</td>";
              echo "<td>".$row['family_name_kana']."</td>";
              echo "<td>".$row['last_name_kana']."</td>";
              echo "<td>".$row['mail']."</td>";
              echo "<td>".$genderText."</td>";
              echo "<td>".$authorityText."</td>";
              echo "<td>".$deleteFlagText."</td>";
              echo "<td>".$registeredTime."</td>";
              
              if ($row['update_time'] !== null) {
                  $update_time = date('Y-m-d', strtotime($row['update_time']));
                  echo "<td>".$update_time."</td>";
              } else {
                  echo "<td></td>"; // NULL値の場合、空白を表示
              }
              
              echo "<td>";
              echo "<button onclick='updateAccount(".$row['id'].")'>更新</button>";
              echo "<button onclick='deleteAccount(".$row['id'].")'>削除</button>";
              echo "</td>";
              echo "</tr>"; // 行の終了
          }                //echo:取得した情報の表示と表示場所指定
        
  ?>
          <script>
              function updateAccount(accountId) {
                  // 更新処理を実行
                  // 更新処理が完了したら、別のページに遷移
                  window.location.href = "update.php?id=" + accountId;
                     //クリックされたら accountId を取得し、それをクエリ文字列として遷移先のURLに追加
              }

              function deleteAccount(accountId) {
                  // 削除処理を実行
                  // 削除処理が完了したら、別のページに遷移
                  window.location.href = "delete.php?id=" + accountId;
              }
          </script>

      </table>
  </div>
</main>

<footer>
    Copyright D.I.works|D.I.blog is the one which A to Z about programming
</footer>

</body>
</html>
