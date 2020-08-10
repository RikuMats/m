<?php
require 'phpmailer/send.php';

$user_in = $_POST["VerificationCode"];

//セッションなどからとってくる
$verify_num = 0;
$name = 0;
$mailAddr = 0;


//ランダム生成などする
$pass = 0;

send_mail($name,$mailAddr,"sign up complete","お疲れ様です".PHP_EOL."仮パスワード :".$pass);


?>