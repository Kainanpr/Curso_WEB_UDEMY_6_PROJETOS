<?php

session_start();

require_once "db.class.php";

if(isset($_SESSION['usuario'])) {

	if ( isset( $_SESSION["sessiontime"] ) ) { 

		if ($_SESSION["sessiontime"] < time() ) { 

			session_unset();
			//Redireciona para login
			header('Location: index.php');

		} else {
			//Seta mais tempo 60 segundos
			$_SESSION["sessiontime"] = time() + 3600;
		}

	} else {

		session_unset();
		//Redireciona para login
		header('Location: index.php');

	}
}

else {
	header('Location: index.php?erro=1');
}

//Quantidade de tweets
$id_usuario = $_SESSION['id_usuario'];

$objDb = new Db();

$objDb->connect();

$resultado = $objDb->select("SELECT count(*) AS qtdTweets FROM tweet WHERE id_usuario = :ID_USUARIO;", array(':ID_USUARIO'=>$id_usuario));

$qtdTweets = $resultado[0]['qtdTweets'];

$objDb->disconnect();

echo $qtdTweets;

?>