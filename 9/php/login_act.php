<?php
session_start();
include('lib/dbconection.php');
include('lib/sql.php');

$pdo = dbcon();
$stmt = sqlSelectAllUser($pdo,$_POST["lid"],$_POST["lpw"]);
$res = $stmt->execute();
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch();

if( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  header("Location: ../index.html?name=".$val['name']);
}else{
  header("Location: logout.php");
}

exit();



?>
