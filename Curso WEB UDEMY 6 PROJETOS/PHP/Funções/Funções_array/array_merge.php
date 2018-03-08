<?php

//Juntas dois arrays
$array1 = array('Mac', 'Linux');
$array2 = array('Windows');
$array3 = array('Solaris');

$novo_array = array_merge($array1, $array2, $array3);

var_export($novo_array);

?>