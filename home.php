<?php
require "config_sql.php";
$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

session_start();



?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <title> home</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>

    <body>
        <h1>ようこそ <?php echo $_SESSION['name']; ?>さん</h1>
    </body>
</html>