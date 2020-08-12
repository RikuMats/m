<?php
require 'config_sql.php';

$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
$sql = "SELECT COUNT(*) FROM essential_user_data WHERE id =:id AND password =:password";
$prestmt = $pdo->prepare($sql);
$prestmt->bindParam(':id',$_POST['id'],PDO::PARAM_STR);
$prestmt->bindParam(':password',$_POST['password'],PDO::PARAM_STR);
$result= $prestmt->fetchAll();
var_dump($result);

?>