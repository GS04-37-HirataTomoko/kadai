<?php
$name = null;
$email = null;
$age = null;
$arr = [];
$last_id = null;
$message = null;
$pdo = null;

if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['age'])) {
    $age = $_POST['age'];
}
if (isset($_POST['arr'])) {
    $arr = $_POST['arr'];
}

if ($name == null or $email == null or $age == null) {
  $message = '登録データがありません';
}else{
  //mysql
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
  $stmt = $pdo->prepare("INSERT INTO gs_an_table (id, name, email, age, indate )VALUES(NULL, :name, :email, :age, sysdate())");
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':age', $age);
  $status = $stmt->execute();
  //直前のインクリメントを取得
  if($status==false){
    $message = "エラーが発生しました";
    exit;
  }else{
    $last_id = $pdo->lastInsertId();
  }

  if($last_id !=null and $arr != null){
    foreach ($arr as $pref) {
      $stmt = $pdo->prepare("INSERT INTO gs_pref_table (id, userid, prefectures) VALUES(NULL, :userid, :pref)");
      $stmt->bindValue(':userid', $last_id);
      $stmt->bindValue(':pref', $pref);
      $status = $stmt->execute();
      if($status==false){
        $message = "エラーが発生しました";
        exit;
      }
    }
    $message = '登録が完了しました';
  }
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>アンケート結果</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/mapcoler.css">
</head>

<body>
  <h1><?=$message?></h1>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#page_user" data-toggle="tab">User</a></li>
    <li><a href="#page_rank" data-toggle="tab">Ranking</a></li>
  </ul>
  <div id="myTabContent" class="tab-content">
    <div id="page_user" class="tab-pane fade in active">
      <h1>登録者情報</h1>
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>名前</th>
              <th>MAIL</th>
              <th>登録日時</th>
            </tr>
          </thead>
          <tbody>
          <?php
          if($pdo == null){
            $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
          }
          $stmt2 = $pdo->prepare("SELECT * FROM gs_an_table");
          $flag = $stmt2->execute();
          if($flag==false){
            $message = "SQLエラー";
          }else{
            while( $result = $stmt2->fetch(PDO::FETCH_ASSOC)){
              echo '<tr>';
              echo "<td>".$result['id']."</td>";
              echo "<td>".$result['name']."</td>";
              echo "<td>".$result['email']."</td>";
              echo "<td>".$result['indate']."</td>";
              echo '</tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
    <div id="page_rank" class="tab-pane fade">
      <h1>選択された都道府県ランキング</h1>
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
            <th class='col-md-2'>RANK</th>
            <th class='col-md-6'>都道府県</th>
            <th class='col-md-6'>人数</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($pdo == null){
              $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
            }
            $stmt2 = $pdo->prepare("SELECT (SELECT sub.name FROM gs_all_pref_table AS sub WHERE sub.id = main.prefectures) AS pref,
            COUNT(main.prefectures) AS count
            FROM gs_pref_table AS main
            GROUP BY main.prefectures
            ORDER BY COUNT(main.prefectures) DESC");
            $flag = $stmt2->execute();
            if($flag==false){
              print_r("SQLエラー");
            }else{
              $count = 1;
              while( $result = $stmt2->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
                echo "<td>".$count."</td>";
                echo "<td>".$result['pref']."</td>";
                echo "<td>".$result['count']."人</td>";
                echo '</tr>';
                $count++;
              }
            }
            ?>
      </tbody>
    </table>
  </div>
  </div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
