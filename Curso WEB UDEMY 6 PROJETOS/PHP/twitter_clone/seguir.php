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


$id_usuario = $_SESSION['id_usuario'];
$id_usuario_seguir = $_POST['seguir_id_usuario'];


if($id_usuario_seguir == ''  ||  $id_usuario == '') {
	exit();
}

$objDb = new Db();

$objDb->connect();

$stmt = $objDb->query("INSERT INTO usuarios_seguidores(id_usuario, seguindo_id_usuario) 
	VALUES(:ID_USUARIO, :ID_USUARIO_SEGUIR)", array(':ID_USUARIO'=>$id_usuario, ':ID_USUARIO_SEGUIR'=>$id_usuario_seguir));

if($stmt->execute())
	echo "Usuario seguido com sucesso!";
else
	echo "Erro ao tentar seguir!";

$objDb->disconnect();

?>