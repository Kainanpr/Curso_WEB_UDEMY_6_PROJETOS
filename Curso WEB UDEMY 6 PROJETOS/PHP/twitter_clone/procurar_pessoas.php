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



//Quantidade de seguidores
$resultado = $objDb->select("SELECT count(*) AS qtdSeguidores FROM usuarios_seguidores AS us WHERE seguindo_id_usuario = :ID_USUARIO;", array(':ID_USUARIO'=>$id_usuario));

$qtdSeguidores = $resultado[0]['qtdSeguidores'];

$objDb->disconnect();

?>

<!DOCTYPE html>
<html lang="pt-br">
  	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<script type="text/javascript">
			
			$(document).ready( function() {

				//associar o evento de click ao botão
				$('#btn-procurar-pessoa').click( function() {


					if($('#nome-pessoa').val().length > 0) {
						
						carregarSeguindo = function() {
							$.ajax({
								url: 'get_pessoas.php',
								method: 'post',
								data: $('#form-procurar-pessoa').serialize(),
								success: function(data) {

									$('#pessoa').html(data);

									$(".btn-seguir").click( function() {
										var id_usuario_seguir = $(this).data('id_usuario');

										$.ajax({
											url: 'seguir.php',
											method: 'post',
											data: { seguir_id_usuario: id_usuario_seguir },
											success: function(data) {
												alert(data);
												carregarSeguindo();
											}
										});

									});

									$(".btn-deixar-seguir").click( function() {
										var id_usuario_deixar_seguir = $(this).data('id_usuario');

										$.ajax({
											url: 'deixar_seguir.php',
											method: 'post',
											data: { deixar_seguir_id_usuario: id_usuario_deixar_seguir },
											success: function(data) {
												alert(data);
												carregarSeguindo();
											}
										});

									});

									
								}
							});
						}	
						carregarSeguindo();

					}
				});

				

			});

		</script>
	
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	          	<li><a href="home.php">Home</a></li>
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	    	<div class="row">
		    	<div class="col-md-3">
		    		<div class="panel panel-default">
		    			<div class="panel-body">
		    				<h4><?= $_SESSION['usuario'] ?></h4>

		    				<hr />

		    				<div class="row">
			    				<div class="col-md-6">
			    					TWEETS <br /> <?= $qtdTweets ?>
			    				</div>
			    				<div class="col-md-6">
			    					SEGUIDORES <br /> <?= $qtdSeguidores ?>
			    				</div>
			    			</div>
		    			</div>
		    		</div>
		    	</div>

		    	<div class="col-md-6">
		    		<div class="panel panel-default">
		    			<div class="panel-body">
		    				<form id="form-procurar-pessoa" class="input-group">
		    					<input type="text" id="nome-pessoa" name="nome-pessoa" class="form-control" placeholder="Quem você está procurando?" maxlength="140">
		    					<span class="input-group-btn">
		    						<button id="btn-procurar-pessoa" class="btn btn-default" type="button">Procurar</button>
		    					</span>
		    				</form>
		    			</div>
		    		</div>

		    		<div id="pessoa" class="list-group">
		    		</div>
				</div>

				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-body">
						</div>
					</div>
				</div>
			</div>

		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	</body>
</html>