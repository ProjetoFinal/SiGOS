<?php
session_start();

$_SESSION['login'] == "";
$_SESSION['senha'] == "";
$_SESSION['nome'] == "";
$_SESSION['idusuario'] == "";
$_SESSION['nivel'] == "";

session_destroy();

header("Location: ../../index.php");