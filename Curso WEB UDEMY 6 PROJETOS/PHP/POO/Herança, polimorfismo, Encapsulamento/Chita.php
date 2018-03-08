<?php

require_once "Felino.php";

//SubClasse
class Chita extends Felino {

	public function correr() {
		return "Chita correndo";
	}

	public function __toString() {
		return parent::__toString() . 
			   "<br>Corrida: " . $this->correr();
	}

}

?>