<?php

//SELECT USER
function sqlSelectAllUser($pdo,$lid,$lpw){
  $stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND lpw=:lpw");
  $stmt->bindValue(':lid', $_POST["lid"]);
  $stmt->bindValue(':lpw', $_POST["lpw"]);
  return $stmt;
}

?>
