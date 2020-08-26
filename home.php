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
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BootstrapのCSS読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    </head>

    <body>
       <div class="jumbotron">
        <h1>ようこそ <?php echo $_SESSION['name']; ?>さん</h1>
        <p>ここはあなたの本棚です。これから読む本は登録しましょう。読み終わった本は読了ボタンを押して感想を書きましょう。</p>
        </div>
        <button type="button" id="newBookButton" class="btn btn-primary" onclick="location.href='register_new_book.html'">新しい本の登録</button>

        <div class="container-fluid row">
            <div class="col-sm-6 container">
            <form action="book_red.php" method="post">

                    <table id = "unreadBookList" class="table table-striped" >
                        <caption>未読の本</caption>
                        <tbody>
                        <?php
                        foreach($result_unread as $row)
                        echo "<tr>".
                            "<td><img src = 'book_img/{$row["book_id"]}'width=80px height=120px></td>"
                            ."<td>{$row['title']}</td>"
                            ."<td>{$row['author']}</td>"
                            ."<td><button type='submit' class='btn btn-info' name='redBookID' value={$row["book_id"]}>読了</button></td>"
                        ."</tr>";
                        ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-sm-6 container" >
                <table id = "redBookList" class="table table-striped">
                    <caption>読み終わった本</caption>
                    <tbody>
                    <?php
                       foreach($result_red as $row)
                            echo "<tr>".
                            "<td><img src = 'book_img/{$row["book_id"]}' width=80px height=120px></td>"
                            ."<td>{$row['title']}</td>"
                            ."<td>{$row['author']}</td>"
                            ."</tr>";
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </body>
</html>