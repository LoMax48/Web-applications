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
    <title>Страница входа</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Форма входа</h1>
        <form action="../method/loginUser.php" method="GET">
            <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" value="<?=$_SESSION['loginTemp']?>"><br>
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль"><br>
            <?php
                if ($_SESSION['message']) {
                    echo '<p class = "message">' . $_SESSION['message'] . '</p><br>';
                }
                unset($_SESSION['message']);
                unset($_SESSION['loginTemp']);
            ?>
            <button class="btn btn-success" type="submit">Войти</button>
        </form>
    </div>
</body>
</html>