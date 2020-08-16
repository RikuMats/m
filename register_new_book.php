<?php
$title = htmlspecialchars($_POST["title"]);
$author = htmlspecialchars($_POST["author"]);
$publisher = htmlspecialchars($_POST["publisher"]);

//マスタにデータがある確認
//なければ登録

//個人と本を結びつけるデータベースに登録
//未読、読了などの状態を保持できるようにする
?>