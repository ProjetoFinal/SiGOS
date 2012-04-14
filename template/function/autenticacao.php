<?php
session_start();

//Verifica se existe uma sessao criada permitindo o usuario masnter-se logado
if( empty( $_SESSION['login'] )){
    session_destroy();
    header("Location: index.php");
}
