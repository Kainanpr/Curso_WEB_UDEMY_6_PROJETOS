<?php

//Junta elementos de um array em uma string conforme o delimitador "/"
$string = "20/10/2020";
$retorno = explode("/", $string);

var_export($retorno);

$nova_string = implode("/", $retorno);

echo '<br><br>' . $nova_string;



?>