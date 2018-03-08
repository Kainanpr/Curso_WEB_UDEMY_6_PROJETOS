<?php

session_start();

require_once "db.class.php";

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$objDb = new Db();

$objDb->connect();

$resultados = $objDb->select("SELECT id, usuario, email FROM usuarios WHERE usuario = :USUARIO AND senha = :SENHA", array(':USUARIO'=>$usuario, ':SENHA'=>$senha));

$objDb->disconnect();



if(isset($resultados[0])) {

	$usuarioAtenticado = $resultados[0];

	$_SESSION['usuario'] = $usuarioAtenticado['usuario'];
	$_SESSION['email'] = $usuarioAtenticado['email'];
	$_SESSION['id_usuario'] = $usuarioAtenticado['id'];
	$_SESSION["sessiontime"] = time() + 3600;

	header('Location: home.php');
}

else {
	header('Location: index.php?erro=1');
}


?>