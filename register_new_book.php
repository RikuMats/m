<?php
require 'config_sql.php';
session_start();

$title = htmlspecialchars($_POST["title"]);
$author = htmlspecialchars($_POST["author"]);
$publisher = htmlspecialchars($_POST["publisher"]);
$file = $_FILES["img"];

$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_WARNING));
//まずはマスタを確認なければインサート
//もしくはとりあえずインサートを実行し、セレクトでbook_idを取得
$sql = "INSERT IGNORE INTO bookmaster (title,author,publisher) VALUES (:title,:author,:publisher)";
$prestmt = $pdo->prepare($sql);
$prestmt->bindParam(':title',$title,PDO::PARAM_STR);
$prestmt->bindParam(':author',$author,PDO::PARAM_STR);
$prestmt->bindParam(':publisher',$publisher,PDO::PARAM_STR);
$prestmt->execute();

$sql = "SELECT id FROM bookmaster WHERE title=:title AND author=:author AND publisher=:publisher";
$prestmt = $pdo->prepare($sql);
$prestmt->bindParam(':title',$title,PDO::PARAM_STR);
$prestmt->bindParam(':author',$author,PDO::PARAM_STR);
$prestmt->bindParam(':publisher',$publisher,PDO::PARAM_STR);
$prestmt->execute();
$row = $prestmt->fetch();
$book_id = $row['id'];//マスタから持ってきた本のid

$sql = "INSERT IGNORE INTO user_book_table (book_id,user_id,status) VALUES(:book_id,:user_id,'unread')";
$prestmt = $pdo->prepare($sql);
$prestmt->bindParam(':book_id',$book_id,PDO::PARAM_INT);
$prestmt->bindParam(':user_id',$_SESSION['id'],PDO::PARAM_INT);
$prestmt->execute();

$filepath ="book_img/".$book_id;
move_uploaded_file($file['tmp_name'],$filepath);

//個人と本を結びつけるデータベースに登録
//未読、読了などの状態を保持できるようにする

 header("location:home.php");
?>