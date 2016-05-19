<?php
$id = $_GET["id"];

require "lib/dbconection.php";

$title = "編集";
$action = "lib/update.php?id=".$id;
$name = "";
$email = "";
$age = "";

$pdo = dbcon();

$stmt = sqlSelectId($pdo,$id);
$flag = $stmt->execute();

if($flag==false){
}else{
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $name = $result['name'];
  $email = $result['email'];
  $age = $result['age'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include ('header.php'); ?>
<body>
  <?php include ('detail.php'); ?>
</body>
</html>
