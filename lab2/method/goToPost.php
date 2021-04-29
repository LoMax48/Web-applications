<?php

require_once '../lib/MyPDO.php';
require_once '../config/config.php';

session_start();

$mypdo = new MyPDO();
$mypdo->getPostInfo($_GET['postName'], $_GET['postAuthor'], $_GET['postTime']);
header("Location: ../pages/aboutPostPage.php");