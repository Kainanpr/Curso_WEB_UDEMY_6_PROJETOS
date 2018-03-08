<?php

require_once "db.class.php";


//Superglobais $_POST[] ou $_GET[]
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);


$objDb = new Db();

$objDb->connect();


$usuario_existe = false;
$email_existe = false;


//Verificar se o usuario ja existe
$resultados = $objDb->select("SELECT * FROM usuarios WHERE usuario = :USUARIO", array(':USUARIO'=>$usuario));

if(count($resultados)>0) {

	$usuario_existe = true;

} 

//Verificar se o email ja existe
$resultados = $objDb->select("SELECT * FROM usuarios WHERE email = :EMAIL", array(':EMAIL'=>$email));

if(count($resultados)>0) {

	$email_existe = true;

}


if($usuario_existe || $email_existe) {

	$retorno_get = '';

	if($usuario_existe) {
		$retorno_get .= "erro_usuario=1&";
	}

	if($email_existe) {
		$retorno_get .= "erro_email=1&";
	}

	header('Location: inscrevase.php?' . $retorno_get);
	exit;
}


$stmt = $objDb->query("INSERT INTO usuarios(usuario, email, senha) VALUES (:USUARIO, :EMAIL, :SENHA)", array(':USUARIO'=>$usuario, ':EMAIL'=>$email, ':SENHA'=>$senha));
	

if($stmt->execute())
	echo "Usuário registrado com sucesso!";
else
	echo "Erro ao registrar o usuário!";

$objDb->disconnect();

?>