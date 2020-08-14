<?php
require 'phpmailer/send.php';
require 'config_sql.php';

$user_in = $_POST["verify_code"];

//セッションなどからとってくる
session_start();

$verify_code = $_SESSION["verify_code"];
$name = $_SESSION["name"];
$mailAddr = $_SESSION["email"];
//ランダム生成などする
echo $verify_code;
if ($user_in !=$verify_code){
    echo "コードが違っています<br> <a href='verification.html'>戻る</a>";
}else{
    $pass = substr(bin2hex(random_bytes(6)),0,6);

    //データベースに名前　パスワード　メールアドレスを保存
    $pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql = "INSERT INTO essential_user_data (name,password,e_mail) VALUES(:name,:password,:e_mail)";
    $prestmt = $pdo->prepare($sql);
    $prestmt->bindParam(':name',$name,PDO::PARAM_STR);
    $prestmt->bindParam(':password',$pass,PDO::PARAM_STR);
    $prestmt->bindParam(':e_mail',$mailAddr,PDO::PARAM_STR);
    $prestmt->execute();


    send_mail($name,$mailAddr,"sign up complete","お疲れ様です\nid:".$pdo->lastInsertId()."\n仮パスワード :".$pass);
}



?>