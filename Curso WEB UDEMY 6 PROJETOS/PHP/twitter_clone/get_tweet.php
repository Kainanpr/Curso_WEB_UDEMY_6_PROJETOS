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

$objDb = new Db();

$objDb->connect();

$resultados = $objDb->select("SELECT usuario, tweet, DATE_FORMAT(data_inclusao, '%d %b %Y %T') AS data_inclusao FROM usuarios AS u INNER JOIN tweet AS t ON u.id = t.id_usuario WHERE u.id = :ID_USUARIO OR t.id_usuario IN (SELECT seguindo_id_usuario FROM usuarios_seguidores WHERE id_usuario = :ID_USUARIO2) ORDER BY data_inclusao DESC", array(':ID_USUARIO'=>$id_usuario, ':ID_USUARIO2'=>$id_usuario));


if(count($resultados) > 0) {

	foreach ($resultados as $tweet) {
	
		echo '<div class="list-group-item" style="margin-bottom: 10px;">';
			echo '<a id="apagar-tweet" href="#" class="pull-right" style="padding: 10px;">X</a>';
			echo '<h4 class="list-group-item-heading"> '.$tweet['usuario'].' <small> - '.$tweet['data_inclusao'].'</small></h4>';
			echo '<p class="list-group-item-text">'.$tweet['tweet'].'</p>';		
		echo '</div>';
		
	}

}

else {

	echo 'Nenhum tweet inserido!';

}

$objDb->disconnect();

?>