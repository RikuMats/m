<?php
require "config_sql.php";
$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

session_start();

//登録した本をデータベースから読み込む

?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <title> home</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>

    <body>
        <h1>ようこそ <?php echo $_SESSION['name']; ?>さん</h1>
        <button type="button" onclick="location.href='register_new_book.html'">新しい本の登録</button>
        

    </body>
</html>