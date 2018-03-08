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

$texto_tweet = $_POST['texto-tweet'];
$id_usuario = $_SESSION['id_usuario'];


if($texto_tweet == ''  ||  $id_usuario == '') {
	exit();
}

$objDb = new Db();

$objDb->connect();

$stmt = $objDb->query("INSERT INTO tweet(id_usuario, tweet) VALUES (:ID_USUARIO, :TWEET)", array(':ID_USUARIO'=>$id_usuario, ':TWEET'=>$texto_tweet));

if($stmt->execute())
	echo "Tweet registrado com sucesso!";
else
	echo "Erro ao registrar o tweet!";

$objDb->disconnect();

?>