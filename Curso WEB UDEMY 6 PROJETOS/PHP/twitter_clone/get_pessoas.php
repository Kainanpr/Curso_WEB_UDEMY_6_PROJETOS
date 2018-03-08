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
$nome_pessoa = $_POST['nome-pessoa'];

$objDb = new Db();

$objDb->connect();

$resultados = $objDb->select("SELECT * FROM usuarios WHERE usuario LIKE :USUARIO AND id <> :ID_USUARIO", array(':USUARIO'=>'%'.$nome_pessoa.'%', ':ID_USUARIO'=>$id_usuario));

$seguindo = $objDb->select("SELECT seguindo_id_usuario FROM usuarios_seguidores AS us 
	INNER JOIN usuarios AS u ON us.id_usuario = u.id 
		WHERE u.id = :ID_USUARIO;", array(':ID_USUARIO'=>$id_usuario));

$objDb->disconnect();

if(count($resultados) > 0) {

	foreach ($resultados as $pessoa) {

		$encontrei = false;

		echo '<div class="list-group-item" style="margin-bottom: 10px;">';
			echo '<strong>@'.$pessoa['usuario'].'</strong> <small> - '.$pessoa['email'].' </small>';	
			echo '<p class="list-group-item-text pull-right">';

				foreach ($seguindo as $pessoaSeguida) {
					
					if($pessoaSeguida['seguindo_id_usuario'] === $pessoa['id']) {
						$encontrei = true;
						break;
					}
					
				}

				if($encontrei) 
					echo '<button type="button" style="outline: none" class="btn btn-primary btn-deixar-seguir" data-id_usuario="'.$pessoa['id'].'">Deixar de seguir</button>';
				
				else
					echo '<button type="button" style="outline: none" class="btn btn-default btn-seguir" data-id_usuario="'.$pessoa['id'].'">Seguir</button>';

				

			echo '</p>';
			echo '<div class="clearfix"></div>';
		echo '</div>';
		
	}

}

else {

	echo 'Nenhum usuário encontrado!';

}



?>