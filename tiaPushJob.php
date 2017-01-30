<?php

$usersTia		=	json_decode($_POST["userTia"]);
$usersSenha		=	json_decode($_POST["userPass"]);
$usersUnidade	=	json_decode($_POST["userUnidade"]);

include_once "tiaLogin.php";

$tiaLogin = new tiaLogin();
header('Content-type: application/json');
echo($tiaLogin->tiaMultiLoginWithTiaPassUnidadeTipo($usersTia, $usersSenha, $usersUnidade, 1));

?>