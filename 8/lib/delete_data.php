<?php
if(!isset($_GET["id"]) || $_GET["id"]=="")
{
  exit('ParamError');
}
$id = $_GET["id"];

require "dbconection.php";
$pdo = dbcon();
$stmt = sqlDeleteId($pdo,$id);
$flag = $stmt->execute();

if($flag==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  header("Location: ../output_data.php");
  exit;
}
?>
