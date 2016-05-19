<?php
if(
  !isset($_GET["id"]) || $_GET["id"]=="" ||
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["age"]) || $_POST["age"]==""
){
  exit('ParamError');
}

$id = $_GET["id"];
$name   = $_POST["name"];
$email  = $_POST["email"];
$age = $_POST["age"];

require "dbconection.php";
$pdo = dbcon();
$stmt = sqlUpdateId($pdo,$id,$name,$email,$age);
$flag = $stmt->execute();

if($flag==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  header("Location: ../output_data.php");
  exit;
}
?>
