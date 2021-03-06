<?php

$name = null;
$mail = null;
$arr = [];

if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
}
if (isset($_POST['arr'])) {
    $arr = $_POST['arr'];
}

if ($name != null and $mail != null) {
    array_unshift($arr, $name, $mail);
    $file = fopen('data/data.csv', 'a'); //add:追記
  flock($file, LOCK_EX);//ロック開始
  if ($file) {
      fputcsv($file, $arr);
  }
    flock($file, LOCK_UN);//ロック解除
  fclose($file);
}

// ※phpからcsv読み込みしてみた
//  最終的にjsで処理することにしたのでコメントアウト

// $filepath = './data/data.csv';
// $prefecture = [];
// $prefecture = array_pad($prefecture, 48, 0);
//
// $data = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// foreach ($data as $line) {
//     $tmp = explode(',', $line);
//     unset($tmp[0], $tmp[1]);
//     foreach ($tmp as $ans) {
//         $prefecture[$ans] = $prefecture[$ans] + 1;
//     }
// }
//
// //$prefecture[0]は使用しない
// $hokkaido = $prefecture[1];
// $touhoku = $prefecture[2] + $prefecture[3] + $prefecture[4] + $prefecture[5] + $prefecture[6] + $prefecture[7];
// $kanto = $prefecture[8] + $prefecture[9] + $prefecture[10] + $prefecture[11] + $prefecture[12] + $prefecture[13] + $prefecture[14];
// $hokuriku = $prefecture[15] + $prefecture[16] + $prefecture[17] + $prefecture[18] + $prefecture[19] + $prefecture[20];
// $toukai = $prefecture[21] + $prefecture[22] + $prefecture[23] + $prefecture[24];
// $kinki = $prefecture[25] + $prefecture[26] + $prefecture[27] + $prefecture[28] + $prefecture[29] + $prefecture[30];
// $tyugoku = $prefecture[31] + $prefecture[32] + $prefecture[33] + $prefecture[34] + $prefecture[35];
// $shikoku = $prefecture[36] + $prefecture[37] + $prefecture[38] + $prefecture[39];
// $kyushu = $prefecture[40] + $prefecture[41] + $prefecture[42] + $prefecture[43] + $prefecture[44] + $prefecture[45] + $prefecture[46];
// $okinawa = $prefecture[47];

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
  <ul class="nav nav-tabs">
    <li class="active"><a href="#page_map" data-toggle="tab">MAP</a></li>
    <li><a href="#page_table" data-toggle="tab">Table</a></li>
  </ul>
  <div id="myTabContent" class="tab-content">
  <div id="page_map" class="tab-pane fade in active">
    <div id="main">
        <div id="map"></div>
    </div>
  </div>
  <div id="page_table" class="tab-pane fade">
    <div class="container">
      <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>お名前</th>
          <th>MAIL</th>
          <th>都道府県No</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $filepath = './data/data.csv';
        $prefecture = [];
        $data = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($data as $line) {
            $tmp = explode(',', $line);
            echo '<tr>';
            echo '<td></td>';
            echo "<td>$tmp[0]</td>";
            echo "<td>$tmp[1]</td>";
            unset($tmp[0], $tmp[1]);
            $area = implode(',', $tmp);
            echo "<td>$area</td>";
            echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="./js/jquery.japan-map.min.js"></script>
<script id="mainsrc" src="./js/main.js"></script>
</body>
</html>
