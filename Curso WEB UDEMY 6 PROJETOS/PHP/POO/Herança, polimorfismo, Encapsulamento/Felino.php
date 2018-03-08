<?php

//Superclasse
abstract class Felino {
	private $mamifero = 'Sim';

	public function getMamifero() {
		return $this->mamifero;
	}

	public abstract function correr();

	public function __toString() {
		return "Mamifero: " . $this->getMamifero();
	}

}


?>
