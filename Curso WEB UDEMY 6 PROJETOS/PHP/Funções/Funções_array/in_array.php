<?php

//verifica se esta contido no ARRAY
$array = array("Manga", "Melão", "Limão");
$retorno = in_array("Limão", $array);

if($retorno)
	echo "Está no array";
else
	echo "Não está array";

?>