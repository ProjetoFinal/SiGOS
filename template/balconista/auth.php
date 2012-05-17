<?php

session_start();

if( $_SESSION['nivel'] != "balconista"){
	header("Location: ../function/logout.php");
}