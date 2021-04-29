<?php
    include 'header.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Страница записи</title>
</head>
<body>
    <div class="postInfo">
        <h1><?=$_SESSION['postName']?></h1>
        <h3><?=$_SESSION['postDescription']?></h3>
        <div class="downloadFile">
            <img src="../img/free-icon-download-file-3142863.svg" width="20px" height="20px">
            <a href="../<?=$_SESSION['postFilePath']?>" class="fileReference"><?=str_replace('temp/', '', $_SESSION['postFilePath'])?></a>
        </div><br>
        Дата добавления: <?=$_SESSION['postTime']?><br>
        Автор: <?=$_SESSION['postAuthor']?>
    </div>
</body>
</html>