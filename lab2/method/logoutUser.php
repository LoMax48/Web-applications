<?php

require_once '../config/config.php';
require_once '../lib/MyPDO.php';

session_start();

$mypdo = new MyPDO();

$mypdo->logoutUser();
header("Location: ../index.php");