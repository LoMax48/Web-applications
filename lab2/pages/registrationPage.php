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
    <title>Страница регистрации</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Форма регистрации</h1>
        <form action="../method/registerUser.php" method="POST">
            <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" value="<?=$_SESSION['nameTemp']?>"><br>
            <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" value="<?=$_SESSION['loginTemp']?>"><br>
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль"><br>
            <input type="password" class="form-control" name="repeatpass" id="repeatpass" placeholder="Повторите пароль"><br>
            <input type="checkbox" class="form-check-input" name="flexCheckDefault" id="flexCheckDefault">
            <label for="flexCheckDefault" class="form-check-label">Согласие на обработку персональных данных</label><br><br>
            <?php
                if ($_SESSION['message']) {
                    echo '<p class = "message">' . $_SESSION['message'] . '</p><br>';
                }
                unset($_SESSION['message']);
                unset($_SESSION['nameTemp']);
                unset($_SESSION['loginTemp']);
            ?>
            <button class="btn btn-success" type="submit">Зарегистрироваться</button>
        </form>
    </div>
</body>
</html>