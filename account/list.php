<?php
session_start();

mb_internal_encoding("utf8");

// データベースへの接続
$pdo = new PDO("mysql:dbname=lesson02;host=localhost;", "root", "mysql");

$stmt = null; // 初期化

// 一般権限でアクセスした場合にエラーメッセージを表示
if ($_SESSION['authority'] == '0') {
    echo "<p>アクセス権限がありません。</p>";
    exit();
}
    
// 初期表示では検索条件を空にする
if ($_SERVER["REQUEST_METHOD"] == "GET" && empty($_GET)) {
    $stmt = false; // データがないことを示すフラグ
}

// 検索ボタンが押された場合の処理
elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // 条件を満たすアカウントのみを取得するクエリを準備
    $sql = "SELECT * FROM account";

    $where = []; // 検索条件を格納するための配列
    
    // 各検索条件の取得
    $familyName = isset($_GET['family_name']) ? $_GET['family_name'] : '';
    $lastName = isset($_GET['last_name']) ? $_GET['last_name'] : '';
    $familyNameKana = isset($_GET['family_name_kana']) ? $_GET['family_name_kana'] : '';
    $lastNameKana = isset($_GET['last_name_kana']) ? $_GET['last_name_kana'] : '';
    $mail = isset($_GET['mail']) ? $_GET['mail'] : '';
    $gender = isset($_GET['gender']) ? $_GET['gender'] : '';
    $authority = isset($_GET['authority']) ? $_GET['authority'] : '';
    
    // 各検索条件が空でない場合、SQLの条件文を作成
    if (!empty($familyName)) {
        $where[] = "family_name LIKE '%$familyName%'";
    }
    if (!empty($lastName)) {
        $where[] = "last_name LIKE '%$lastName%'";
    }
    if (!empty($familyNameKana)) {
        $where[] = "family_name_kana LIKE '%$familyNameKana%'";
    }
    if (!empty($lastNameKana)) {
        $where[] = "last_name_kana LIKE '%$lastNameKana%'";
    }
    if (!empty($mail)) {
        $where[] = "mail LIKE '%$mail%'";
    }
    if ($gender !== '') {
        $where[] = "gender = $gender";
    }
    if ($authority !== '') {
        $where[] = "authority = $authority";
    }

    // クエリを準備して実行
    if (!empty($where)) {
        $whereCondition = implode(" AND ", $where);
        $sql .= " WHERE $whereCondition ORDER BY id DESC";
        $stmt = $pdo->query($sql);
    } else {
        // 条件が空の場合、全てのアカウント情報を取得
        $sql .= " ORDER BY id DESC";
        $stmt = $pdo->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8">
    <title>アカウント一覧画面</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
  </head>

<body>
  <?php

    //mb_internal_encoding("utf8");
    //$pdo = new PDO("mysql:dbname=lesson02;host=localhost;","root","mysql");
    
    //$stmt = $pdo->query("select * from account order by id desc"); 
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
    
  <form action="list.php" method="GET">
    <table class="search-table">
     
      <tr>
        <th>名前(姓)</th>
        <td><input type="text" name="family_name"></td>
        <th>名前(名)</th>
        <td><input type="text" name="last_name"></td>
      </tr>
      <tr>
        <th>カナ(姓)</th>
        <td><input type="text" name="family_name_kana"></td>
        <th>カナ(名)</th>
        <td><input type="text" name="last_name_kana"></td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td><input type="text" name="mail"></td>
        <th>性別</th>
        <td>
          <input type="radio" name="gender" value="0" checked> 男
          <input type="radio" name="gender" value="1"> 女
          <input type="radio" name="gender" value="">選択なし
        </td>
      </tr>
      <tr>
        <th>アカウント権限</th>
        <td>
          <select name="authority">
            <option value="">選択なし</option>
            <option value="0" selected>一般</option>
            <option value="1">管理者</option>
          </select>
        </td>
        <td></td>
        <td></td>
      </tr>
          
    </table>
      
    <button type="submit" class="submi">検索</button>
      
  </form>
  
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
         
          // 検索ボタンが押された場合のみ、データを表示
          if ($stmt) {
            // $stmt がある場合は結果を表示
            if ($stmt->rowCount() > 0) {
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
              
                // 削除した場合(削除フラグ1の場合)の処理
                if ($deleteFlag == 0) {
                    echo "<td>";
                    echo "<button onclick='updateAccount(".$row['id'].")'>更新</button>";
                    echo "<button onclick='deleteAccount(".$row['id'].")'>削除</button>";
                    echo "</td>";
                } else {
                    echo "<td>削除済</td>"; // "<td></td>"; この行を削除
                }
             }  
            } else {
                echo "<tr><td colspan='12'>データはありません</td></tr>";
            }
          } else {
              // $stmt がない場合（初期表示時）は何も表示しない
              // 何もコードを書かない
          }
          //echo:取得した情報の表示と表示場所指定
        
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
