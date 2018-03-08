<?php

//verifica se uma variavel é ARRAY
$array = array("Manga", "Melão");
$retorno = is_array($array);

if($retorno)
	echo "É um array";
else
	echo "Não é um array";

?>