<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Primeira Classe</title>
	</head>

	<body>
		<h1>Minha primeira classe</h1>

		<?php

		require_once "classe.php";

		$pessoa = new Pessoa("Kainan", 1.80);

		echo "<p>" . $pessoa->getNome() . "</p>";
		echo "<p>" . $pessoa->getAltura() . "</p>";

		?>

	</body>

</html>