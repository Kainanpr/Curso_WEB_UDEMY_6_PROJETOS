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
				$('#btn-tweet').click( function() {


					if($('#texto-tweet').val().length > 0) {
						
						$.ajax({
							url: 'inclui_tweet.php',
							method: 'post',
							data: $('#form-tweet').serialize(),
							success: function(data) {
								$('#texto-tweet').val('');
								//alert(data);
								atualizaTweet();
							}
						});


					}
				});

				function atualizaTweet() {
					//carregar os tweets
					$.ajax({
							url: 'get_tweet.php',
							method: 'post',
							success: function(data) {
								$('#tweets').html(data);
								//alert(data);
							}
					});

					$.ajax({
							url: 'get_qtdTweets.php',
							method: 'post',
							success: function(data) {
								$('#qtd-tweets').html(data);
							}
					});

					$.ajax({
							url: 'get_qtdSeguidores.php',
							method: 'post',
							success: function(data) {
								$('#qtd-seguidores').html(data);
							}
					});
				}

				atualizaTweet();

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
			    					<p>TWEETS</p>  
			    					<span id="qtd-tweets"></span>
			    				</div>
			    				<div class="col-md-6">
			    					<p>SEGUIDORES</p>  
			    					<span id="qtd-seguidores"><span>
			    				</div>
			    			</div>
		    			</div>
		    		</div>
		    	</div>

		    	<div class="col-md-6">
		    		<div class="panel panel-default">
		    			<div class="panel-body">
		    				<form id="form-tweet" class="input-group">
		    					<input type="text" id="texto-tweet" name="texto-tweet" class="form-control" placeholder="O que está acontecendo agora?" maxlength="140">
		    					<span class="input-group-btn">
		    						<button id="btn-tweet" class="btn btn-default" type="button">Tweet</button>
		    					</span>
		    				</form>
		    			</div>
		    		</div>

		    		<div id="tweets" class="list-group">
		    		</div>
				</div>

				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-body">
							<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
						</div>
					</div>
				</div>
			</div>

		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	</body>
</html>