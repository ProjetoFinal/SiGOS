<?php

session_start();

if( $_SESSION['nivel'] != "estoquista"){
	header("Location: ../function/logout.php");
}

//include_once("auth.php");