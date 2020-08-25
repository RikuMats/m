<?php
require "config_sql.php";
$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

session_start();


//登録した本をデータベースから読み込む
$sql = "SELECT * FROM bookmaster INNER JOIN user_book_table 
        ON bookmaster.id = user_book_table.book_id and user_book_table.status='unread' and user_book_table.user_id={$_SESSION['id']};";
$stmt = $pdo->query($sql);
$result_unread = $stmt->fetchAll();

$sql = "SELECT * FROM bookmaster INNER JOIN user_book_table 
        ON bookmaster.id = user_book_table.book_id and user_book_table.status='red' and user_book_table.user_id={$_SESSION['id']};";

$stmt = $pdo->query($sql);
$result_red = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <title> home</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/bookList.css">
    </head>

    <body>
       
        <h1>ようこそ <?php echo $_SESSION['name']; ?>さん</h1>
            <button type="button" id="newBookButton" onclick="location.href='register_new_book.html'">新しい本の登録</button>

        <div class="listArea">
            <form action="book_red.php" method="post">
            <table id = "unreadBookList">
                <caption>未読の本</caption>
                <?php
                foreach($result_unread as $row)
                echo "<tr>".
                    "<td><img src = 'book_img/{$row["book_id"]}'width=80px height=120px></td>"
                    ."<td>{$row['title']}</td>"
                    ."<td>{$row['author']}</td>"
                    ."<td><button type='submit' name='redBookID' value={$row["book_id"]}>読了</button></td>"
                ."</tr>";
                ?>
            </table>
            </form>
            <table id = "redBookList">
                <caption>読み終わった本</caption>
                <?php
                foreach($result_red as $row)
                echo "<tr>".
                    "<td><img src = 'book_img/{$row["book_id"]}' width=80px height=120px></td>"
                    ."<td>{$row['title']}</td>"
                    ."<td>{$row['author']}</td>"
                ."</tr>";
                ?>
            </table>
        </div>

    </body>
</html>