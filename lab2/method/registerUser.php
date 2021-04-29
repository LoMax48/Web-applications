<?php

require_once '../config/config.php';
require_once '../lib/user.php';
require_once '../lib/MyPDO.php';

session_start();

$user = new User($_POST['name'], $_POST['login'], $_POST['pass'], $_POST['flexCheckDefault']);
$mypdo = new MyPDO();

try {
    if ($mypdo->validateRegistrationData($user)) {
        $mypdo->registerUser($user);
        $_SESSION['username'] = $user->getLogin();
    }
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['loginTemp'] = $_POST['login'];
    $_SESSION['nameTemp'] = $_POST['name'];
    header("Location: ../pages/registrationPage.php");
}