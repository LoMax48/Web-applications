<?php

require_once '../config/config.php';
require_once '../lib/MyPDO.php';

session_start();

$mypdo = new MyPDO();

try {
    if ($mypdo->validatePostData($_POST['name'], $_POST['description'], $_SESSION['username'])) {
        $mypdo->addPost($_POST['name'], $_POST['description'], $_SESSION['username'], 'temp/' . $_FILES['userfile']['name']);
        $_SESSION['postName'] = $_POST['name'];
        $_SESSION['postDescription'] = $_POST['description'];
        $_SESSION['postAuthor'] = $_SESSION['username'];
        $_SESSION['postTime'] = date("Y-m-d H:i:s", time());
        $_SESSION['postFilePath'] = 'temp/' . $_FILES['userfile']['name'];
        header("Location: ../pages/aboutPostPage.php");
    }
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['postNameTemp'] = $_POST['name'];
    $_SESSION['postDescriptionTemp'] = $_POST['description'];
    header("Location: ../pages/addPostPage.php");
}