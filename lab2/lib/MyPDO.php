<?php

class MyPDO
{
    // Переменная для экземпляра класса PDO
    private $dbh;

    //Инициализируем объект PDO и открываем сессию
    function __construct()
    {
        try {
            $this->dbh = new PDO($GLOBALS['dsn'], $GLOBALS['db_user'], $GLOBALS['db_pass']);
            session_start();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Регистрация пользователя
    function registerUser(User $user)
    {
        $addUserQuery = $this->dbh->prepare("INSERT INTO users (Name, Login, Password) VALUES (:name, :login, :password)");
        $addUserQuery->bindParam(':name', $user->getName());
        $addUserQuery->bindParam(':login', $user->getLogin());
        $addUserQuery->bindParam(':password', password_hash($user->getPassword(), PASSWORD_BCRYPT));
        $status = $addUserQuery->execute();
        if ($status) {
            header("Location: ../index.php");
        } else {
            throw new Exception('Ошибка регистрации. Возможно, пользователь с таким логином уже существует.');
        }
    }

    // Проверка данных перед регистрацией
    function validateRegistrationData(User $user)
    {
        if (!empty($user->getName()) && !empty($user->getLogin()) && !empty($user->getPassword())) {
            if (!preg_match("/^[а-яА-я_\-%\s]+$/iu", $user->getName())) {
                throw new Exception('В имени допустимы только русские буквы, пробелы и дефисы.');
            } elseif (!filter_var($user->getLogin(), FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Некорректный адрес электронной почты.');
            } elseif (strlen($user->getPassword()) < 6) {
                throw new Exception('Пароль должен содержать в себе более шести символов.');
            } elseif (!preg_match("/[^0-9]/", $user->getPassword())) {
                throw new Exception('Пароль не должен состоять только из цифр.');
            } elseif (strcasecmp($_POST['repeatpass'], $user->getPassword()) != 0) {
                throw new Exception('Пароли не совпадают.');
            } elseif (strcasecmp($user->getCookieFlag(), "on") != 0) {
                throw new Exception('Не дано разрешение на обработку персональных данных.');
            } else {
                return true;
            }
        } else {
            throw new Exception('Заполнены не все поля.');
        }
    }

    // Вход пользователя в аккаунт
    function loginUser(string $login, string $pass)
    {
        $getUserQuery = $this->dbh->prepare("SELECT Login, Password FROM users WHERE Login = :login");
        $getUserQuery->bindParam(':login', $login);
        $getUserQuery->execute();
        $row = $getUserQuery->fetch();
        if (password_verify(trim($pass), $row['Password'])) {
            header("Location: ../index.php");
        } else {
            throw new Exception('Неверный логин или пароль.');
        }
    }

    // Выход из аккаунта
    function logoutUser()
    {
        unset($_SESSION['username']);
        header("Location: ../index.php");
    }

    // Добавление записи в БД
    function addPost(string $postName, string $postDescription, string $postAuthor, string $postFilePath)
    {
        try {
            $addPostQuery = $this->dbh->prepare("INSERT INTO posts (Name, Description, Author, Time, FilePath) 
                VALUES (:name, :desc, :author, now(), :filepath)");
            $addPostQuery->bindParam(':name', $postName);
            $addPostQuery->bindParam(':desc', $postDescription);
            $addPostQuery->bindParam(':author', $postAuthor);
            $addPostQuery->bindParam(':filepath', $postFilePath);
            $status = $addPostQuery->execute();
            if ($status) {
                header("Location: ../pages/aboutPostPage.php");
            } else {
                throw new Exception('Произошла неизвестная ошибка.');
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Проверка данных перед добавлением записи в БД
    function validatePostData(string $postName, string $postDescription, string $postAuthor)
    {
        if (!empty($postName) && !empty($postDescription) && !empty($postAuthor) && !empty($_FILES['userfile'])) {
            if ($_FILES['userfile']['type'] != 'application/zip, application/octet-stream, application/x-zip-compressed, multipart/x-zip'
             && $_FILES['userfile']['type'] != 'application/msword'
             && $_FILES['userfile']['type'] != 'application/pdf'
             && $_FILES['userfile']['type'] != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
             && $_FILES['userfile']['type'] != 'image/jpeg'
             && $_FILES['userfile']['type'] != 'image/jpg'
             && $_FILES['userfile']['type'] != 'image/png') {
                throw new Exception('Неподходящий формат файла. Файл может быть одного из следующих расширений: 
                .zip, .doc, .docx, .xls, .xlsx, .pdf, .jpg, .png, 
                а размер файла не должен превышать 15 мб.');
            } else {
                move_uploaded_file($_FILES['userfile']['tmp_name'], '../temp/' . $_FILES['userfile']['name']);
                return true;
            }
        } else {
            throw new Exception('Заполнены не все поля.');
        }
    }

    // Читаем все записи из БД
    function getPosts()
    {
        try {
            $getPostsQuery = $this->dbh->prepare("SELECT Name, Author, Time FROM posts ORDER BY Time DESC");
            $status = $getPostsQuery->execute();
            if ($status) {
                $posts = $getPostsQuery->fetchAll(PDO::FETCH_ASSOC);
                return $posts;
            } else {
                throw new Exception('Произошла неизвестная ошибка.');
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Получить информацию о посте по названию, автору и дате
    function getPostInfo($postNameParam, $postAuthorParam, $postTimeParam)
    {
        try {
            $getPostInfoQuery = $this->dbh->prepare("SELECT Name, Description, Author, Time, FilePath FROM posts 
            WHERE Name = :name AND Author = :author AND Time = :time");
            $getPostInfoQuery->bindParam(':name', $postNameParam);
            $getPostInfoQuery->bindParam(':time', $postTimeParam);
            $getPostInfoQuery->bindParam(':author', $postAuthorParam);
            $status = $getPostInfoQuery->execute();
            if ($status) {
                $post = $getPostInfoQuery->fetch();
                $_SESSION['postName'] = $post['Name'];
                $_SESSION['postDescription'] = $post['Description'];
                $_SESSION['postAuthor'] = $post['Author'];
                $_SESSION['postTime'] = $post['Time'];
                $_SESSION['postFilePath'] = $post['FilePath'];
            } else {
                throw new Exception('Произошла неизвестная ошибка.');
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}