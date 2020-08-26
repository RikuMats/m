<?php
require 'config_sql.php';
$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
$sql = "SELECT * FROM user_book_table INNER JOIN bookmaster ON user_book_table.status='red' AND bookmaster.id=user_book_table.book_id
ORDER BY redDateTime DESC";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BootstrapのCSS読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>
        top
    </title>
</head>

<body>
    <h1>Top </h1>
    <div class="container">
    <button type="button" class="btn btn-primary" onclick="location.href='signin.html'">sign in</button>
    <button type="button" class="btn btn-primary" onclick="location.href='signup.html'">sign up</button>
    </div>
    <br>
    <div class="container">
    <table class="table">
        <caption>最近読まれた本</caption>
        <thred>
            <tr>
                <th></th>
                <th>タイトル</th>
                <th>著者</th>
                <th>感想</th>
            </tr>
        </thread>
        <tbody>
        <?php
        foreach($result as $row)
        echo "<tr>
            <td><img src='book_img/{$row["book_id"]}' width=120px height=180px></td>
            <td>{$row['title']}</td>
            <td>{$row['author']}</td>
            <td>{$row['review']}</td>
        </tr>";
        ?>
        </tbody>
    </table>
    </div>
</body>

</html>