<?php

session_start();

if( $_SESSION['nivel'] != "gerente"){
	header("Location: ../function/logout.php");
}

//include_once("auth.php");