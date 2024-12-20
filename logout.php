<?php
//Se nao existir SESSION faça SESSION START
if(!isset($_SESSION)) {
    session_start();
}
//Se existir uma SESSION deslogue 
session_destroy();

header("Location: telalogin.php");