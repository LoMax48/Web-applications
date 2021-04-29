<?php

require_once '../config/config.php';
require_once '../lib/MyPDO.php';

session_start();

$mypdo = new MyPDO();

try {
    $mypdo->loginUser($_GET['login'], $_GET['pass']);
    $_SESSION['username'] = $_GET['login'];
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['loginTemp'] = $_GET['login'];
    header("Location: ../pages/loginPage.php");
}