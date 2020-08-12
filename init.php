<?php
//データベースを作る
//その他　初期化があれば行う

require 'config_sql.php';

$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
echo "connected<br>";

$sql = "CREATE TABLE IF NOT EXISITS essential_user_data"
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"
    ."name char(32),"
    ."password char(6),"
    ."e_mail TEXT,"
    .")";

$stmt = $pdo->query($sql);

echo "end";
?>
