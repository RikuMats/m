<?php
require 'phpmailer/send.php';

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


    send_mail($name,$mailAddr,"sign up complete","お疲れ様です".PHP_EOL."仮パスワード :".$pass);
}



?>