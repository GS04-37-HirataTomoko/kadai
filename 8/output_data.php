<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>アンケート結果</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/mapcoler.css">
</head>

<body>
  <h1>アンケート結果</h1>
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
              <th></th>
              <th></th>
              <th>ID</th>
              <th>名前</th>
              <th>MAIL</th>
              <th>年齢</th>
              <th>登録日時</th>
            </tr>
          </thead>
          <tbody>
          <?php
          require "lib\dbconection.php";

          $pdo = dbcon();
          $stmt2 = sqlSelectAll($pdo);
          $flag = $stmt2->execute();

          if($flag==false){
          }else{
            while( $result = $stmt2->fetch(PDO::FETCH_ASSOC)){
              echo '<tr>';
              echo '<td><a href="edit_data.php?id='.$result["id"].'" class="btn btn-info" >Edit</a></td>';
              echo '<td><a href="lib/delete_data.php?id='.$result["id"].'" class="deleteA btn btn-danger" >Delete</a></td>';
              echo "<td>".$result['id']."</td>";
              echo "<td>".$result['name']."</td>";
              echo "<td>".$result['age']."</td>";
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
              $pdo = dbcon();
            }
            $stmt2 = sqlSelectRank($pdo);
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
<script type="text/javascript">
  $('[class^=deleteA]').click(function(){
    if (!confirm('削除します。\nよろしいですか？')) {
    		return false;
    	}
  });
</script>
</body>
</html>
