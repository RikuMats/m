<?php 
//はじめはhomeでの読了ボタンが押されたときに訪れ感想を書きまたここにアクセスする
//次は感想をデータベースに書き込み、homeに戻る

require "config_sql.php";
$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

session_start();

//本が読み終わった
if(isset($_POST['redBookID'])){
    $_SESSION['redBookID'] = $_POST['redBookID'];
    $sql = "SELECT * from bookmaster where id=:id";
    $prestmt= $pdo->prepare($sql);
    $prestmt->bindParam(':id',$_POST['redBookID'],PDO::PARAM_INT);
    $prestmt->execute();
    $row = $prestmt->fetch();
}

//感想を書いた
if(isset($_POST['review'])){
    $sql= "UPDATE user_book_table SET status='red',review=:review,redDateTime=:redDateTime where user_id=:user_id AND book_id=:book_id";
    $prestmt = $pdo->prepare($sql);
    $prestmt->bindParam(':user_id',$_SESSION['id'],PDO::PARAM_INT);
    $prestmt->bindParam(':book_id',$_SESSION['redBookID'],PDO::PARAM_STR);
    $prestmt->bindParam(':redDateTime',date('Y-m-d h:i:s'));
    $prestmt->bindParam(':review',$_POST['review'],PDO::PARAM_STR);
    $prestmt->execute();

    header("location:home.php");

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>review</title>
</head>
<body>
    <h1>感想</h1>
    <h2><?php echo $row['title'] ?></h2>
    <h3><?php echo $row ['author']?></h3>
    <img src="book_img/<?php echo $_POST['redBookID']?>" width=100px height=100px><br>
    <form action="" method="post">
        感想:<br>
        <input type="text" name="review">
        <input type="submit" value="送信">
    </form>
    
</body>
</html>