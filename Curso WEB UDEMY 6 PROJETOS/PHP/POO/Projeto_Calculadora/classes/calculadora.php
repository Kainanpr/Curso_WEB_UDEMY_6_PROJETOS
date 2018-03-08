<?php

class Calculadora {
	//Atributos
	private $total;
	private $numero1;
	private $numero2;

	//Metodo construtor
	public function __construct($numero1, $numero2) {
		$this->total = 0;
		$this->numero1 = $numero1;
		$this->numero2 = $numero2;
	}

	//Metodos getter e setter
	public function setNumero1($numero1) {
		$this->numero1 = $numero1;
	}

	public function getNumero1() {
		return $this->numero1;
	}

	public function setNumero2($numero2) {
		$this->numero2 = $numero2;
	}

	public function getNumero2() {
		return $this->numero2;
	}

	public function getTotal() {
		return $this->total;
	}

	//Metodos meus
	public function somar() {
		$this->total = $this->numero1 + $this->numero2;
	}

	public function subtrair() {
		$this->total = $this->numero1 - $this->numero2;
	}

	public function multiplicar() {
		$this->total = $this->numero1 * $this->numero2;
	}

	public function dividir() {
		$this->total = $this->numero1 / $this->numero2;
	}

}//Fim da classe


?>