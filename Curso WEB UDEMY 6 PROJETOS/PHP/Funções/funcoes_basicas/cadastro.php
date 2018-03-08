<?php


if(isset($_POST['nome']) && empty($_POST['nome'])) {
	echo 'Preencha o nome completo<br><br>';
}

if(isset($_POST['cpf']) && empty($_POST['cpf'])) {
	echo 'Preencha o CPF<br><br>';
}

if(isset($_POST['cpf']) && !is_numeric($_POST['cpf'])) {
	echo 'Digite somente numeros no CPF<br><br>';
}


?>

<form method="post" action="">
	<label>
		Nome completo*:
		<input type="text" name="nome">
	</label>

	<label>
		CPF*:
		<input type="text" name="cpf">
	</label>

	<input type="submit" value="cadastrar">
</form>