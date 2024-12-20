<?php
//Para iniciar a sessão faça isso
if(!isset($_SESSION)) {
    session_start();
}
//Se nao iniciar um sessão faça isso
if(!isset($_SESSION['id'])) {
    die("<strong>Você não pode acessar esta página porque não está logado.<p><a href=\"telalogin.php\">Entrar</a></p></strong>");
}


?>