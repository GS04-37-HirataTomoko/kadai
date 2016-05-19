<?php

//DB CONEECT
function dbcon()
{
  try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('データベースに接続できませんでした。'.$e->getMessage());
  }
    return $pdo;
}

//SELECT ALL
function sqlSelectAll($pdo){
  $stmt = $pdo->prepare("SELECT * FROM gs_an_table");
  return $stmt;
}

//SELECT RANK
function sqlSelectRank($pdo){
  $stmt = $pdo->prepare("SELECT (SELECT sub.name FROM gs_all_pref_table AS sub WHERE sub.id = main.prefectures) AS pref,
  COUNT(main.prefectures) AS count
  FROM gs_pref_table AS main
  GROUP BY main.prefectures
  ORDER BY COUNT(main.prefectures) DESC");
  return $stmt;
}

//SELECT ID
function sqlSelectId($pdo,$id){
  $stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE id=:id");
  $stmt->bindValue(':id', $id);
  return $stmt;
}

//INSERT
function sqlInsertUser($pdo,$name,$email,$age){
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
  $stmt = $pdo->prepare("INSERT INTO gs_an_table (id, name, email, age, indate )VALUES(NULL, :name, :email, :age, sysdate())");
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':age', $age);
  return $stmt;
}

function sqlInsertPref($pdo,$last_id,$pref){
  $stmt = $pdo->prepare("INSERT INTO gs_pref_table (id, userid, prefectures) VALUES(NULL, :userid, :pref)");
  $stmt->bindValue(':userid', $last_id);
  $stmt->bindValue(':pref', $pref);
  return $stmt;
}

//UPDATE
function sqlUpdateId($pdo,$id,$name,$email,$age){
  $stmt = $pdo->prepare("UPDATE gs_an_table SET name=:name, email=:email, age=:age WHERE id=:id");
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':age', $age);
  $stmt->bindValue(':id', $id);
  return $stmt;
}

//DELETE
function sqlDeleteId($pdo,$id){
  $stmt = $pdo->prepare("DELETE FROM gs_an_table WHERE id=:id");
  $stmt->bindValue(':id', $id);
  return $stmt;
}
?>
