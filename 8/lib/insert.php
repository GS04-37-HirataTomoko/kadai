<?php
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["age"]) || $_POST["age"]=="" ||
  !isset($_POST["arr"]) || $_POST["arr"]==""
){
  exit('ParamError');
}

$name   = $_POST["name"];
$email  = $_POST["email"];
$age = $_POST["age"];
$arr = $_POST["arr"];

require "dbconection.php";

$pdo = dbcon();
$stmt = sqlInsertUser($pdo,$name,$email,$age);
$flag = $stmt->execute();

if($flag==false){
  exit;
}else
{
  $last_id = $pdo->lastInsertId();
}

if($last_id !=null and $arr != null){
  foreach ($arr as $pref) {
    $stmt = sqlInsertPref($pdo,$last_id,$pref);
    $flag = $stmt->execute();
    if($flag==false){
      $error = $stmt->errorInfo();
      exit("QueryError:".$error[2]);
    }else{
      header("Location: ../output_data.php");
      exit;
    }
  }
}
?>
