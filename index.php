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
    <title>
        top
    </title>
    <meta charset="UTF-8">
</head>

<body>
    <h1>Top </h1>
    <button type="button" onclick="location.href='signin.html'">sign in</button>
    <button type="button" onclick="location.href='signup.html'">sign up</button>
    <br>
    <table>
        <caption>最近読まれた本</caption>
        <?php
        foreach($result as $row)
        echo "<tr>
            <td><img src='book_img/{$row["book_id"]}' width=120px height=180px></td>
            <td>{$row['title']}</td>
            <td>{$row['author']}</td>
            <td>{$row['redDateTime']}</td>
        </tr>";
        ?>
    </table>
</body>

</html>