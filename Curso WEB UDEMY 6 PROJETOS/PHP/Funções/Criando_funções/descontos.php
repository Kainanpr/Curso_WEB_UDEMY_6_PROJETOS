<?php

require_once('funcoes_descontos.php');

$valorTotal = 800.0;
$desconto = 10;

$valorTotalComDesconto = calculaDesconto($valorTotal, $desconto) ;

?>

Valor Total: R$ <?php echo $valorTotal ?> <br>
Valor Desconto: <?php echo $desconto ?>% <br>
Valor total com desconto: R$ <?php echo $valorTotalComDesconto?>
