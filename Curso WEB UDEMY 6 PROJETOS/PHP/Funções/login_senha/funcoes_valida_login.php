<?php

function valida_login($login, $senha) {
	//OBS(COMUM): Validar direto em um banco de dados
	$login_bd = 'kainanxd';
	$senha_bd = '33682235';

	if($login == $login_bd && $senha == $senha_bd)
		return true;

	return false;
}

?>