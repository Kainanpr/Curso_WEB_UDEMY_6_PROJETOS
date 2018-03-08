<?php

function calculaDesconto($valorTotal, $desconto) {
	$valorDesconto = $valorTotal * ($desconto / 100);
	$valorTotalComDesconto = $valorTotal - $valorDesconto;

	return $valorTotalComDesconto;
}

?>



