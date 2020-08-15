<?php
require 'config_sql.php';

$id = htmlspecialchars($_POST['id']);
$password = htmlspecialchars($_POST['password']);
$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
$sql = "SELECT COUNT(*) as cnt FROM essential_user_data WHERE id =:id AND password =:password";
$prestmt = $pdo->prepare($sql);
$prestmt->bindParam(':id',$id,PDO::PARAM_STR);
$prestmt->bindParam(':password',$password,PDO::PARAM_STR);
$prestmt->execute();
$result= $prestmt->fetchAll();
$row = $result[0];
$count = $row['cnt'];

if($count == 1){

    echo ' ログイン成功';
    //user名等をsessionに入れて置く
    $sql = "SELECT * FROM essential_user_data WHERE id=".$id;
    $stmt = $pdo->query(sql);
    $result = $stmt->fetchAll();
    $row = $result[0];

    session_start();

    $_SESSION['id'] = $id;
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $row['email'];

}else{
    echo'ログイン失敗<br>'
    .'<a href=signin.html>戻る</a>';
}
//次回はここから確認する

?>