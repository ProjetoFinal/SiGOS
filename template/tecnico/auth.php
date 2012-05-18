<?php

session_start();

if( $_SESSION['nivel'] != "tecnico"){
	header("Location: ../function/logout.php");
}

//include_once("auth.php");