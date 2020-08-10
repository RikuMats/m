<?php
require 'phpmailer/send.php';
$name = $_POST["name"];
$mailAddr= $_POST["mailAddr"];

//ランダム生成したい
$verify_num = 0;
//セッションに保存？

send_mail($name,$mailAddr,"認証番号です",$verify_num);

?>