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
    <title>Добавление записи</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Добавление записи</h1>
        <form action="../method/addPost.php" method="POST" enctype="multipart/form-data">
            <input type="text" class="form-control" name="name" id="name" placeholder="Введите название" value="<?=$_SESSION['postNameTemp']?>"><br>
            <input type="text" class="form-control" name="description" id="description" placeholder="Введите описание" value="<?=$_SESSION['postDescriptionTemp']?>"><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="15000000">
            <input type="file" name="userfile"><br><br>
            <?php
                if ($_SESSION['message']) {
                    echo '<p class="message">' . $_SESSION['message'] . '</p><br>';
                }
                unset($_SESSION['message']);
                unset($_SESSION['postNameTemp']);
                unset($_SESSION['postDescriptionTemp']);
            ?>
            <button class="btn btn-success" type="submit">Добавить запись</button>
        </form>
    </div>
</body>
</html>