<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<title>Mensagens divertidas</title>
	</head>

	<body>

		<?php
			
			$mensagens_divertidas['a'] = "Estou fazendo as contas aqui e este mês não tem jetito, vou ter que gastar mais.";

			$mensagens_divertidas['b'] = "As 3 coisas que as mulheres mais gosta...";

			$mensagens_divertidas[2] = "Estou tão carente que o churrasqueiro chegou atrazado."; 

			$mensagens_divertidas[3] = "O casamento é muito top meu amiguinho.";

			var_dump($mensagens_divertidas);

			echo "<br><br>";

			print_r($mensagens_divertidas);

			echo "<br><br>";

			echo $mensagens_divertidas[3];

			echo "<br><br>";

			echo $mensagens_divertidas['a'];

			echo "<br><br><hr><br><br>";

			echo "Criando vetor de outra maneira";

			$outras_mensagens = array(
				'a' => "mensagem para A", 
				'b' => "mensagem para B", 
				 3 => "mensagem para 3", 
				 4 => "mensagem para 4");

			echo "<br><br>";

			var_dump($outras_mensagens);


		?>

		
	</body>
</html>