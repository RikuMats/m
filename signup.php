<?php
require 'phpmailer/send.php';
$name = $_POST["name"];
$mailAddr= $_POST["mailAddr"];

//ランダム生成したい・数値としてではなく数字として6桁にしたい

$verify_code = mt_rand(0,999999);
//セッションに保存？
session_start();
$_SESSION["verify_code"] = $verify_code;
$_SESSION["name"]=$name;
$_SESSION["email"]=$mailAddr;

//メールはテストの時だけする
send_mail($name,$mailAddr,"認証番号です","$verify_code".PHP_EOL);
header("location:verification.html")
?>