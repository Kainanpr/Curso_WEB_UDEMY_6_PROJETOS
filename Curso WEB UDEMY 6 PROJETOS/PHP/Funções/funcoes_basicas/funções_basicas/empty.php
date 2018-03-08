<?php

//Nesses cassos a função empty retorna true -> '', 0, '0', false, null, array();

$valor = '0';

if(empty($valor))
	echo 'A variavel está vazia';
else
	echo 'A variavel não esta vazia';

?>
