<?php

class Pessoa {
	//Atributos
	private $nome;
	private $altura;

	function __construct($nome, $altura) {
		$this->nome = $nome;
		$this->altura = $altura;
	}

	//Métodos acessores
	public function setNome($nome) {
		$this->nome = $nome;
	} 

	public function getNome() {
		return $this->nome;
	}

	public function setAltura($altura) {
		$this->altura = $altura;
	} 

	public function getAltura() {
		return $this->altura;
	}

	//Metodos Mágicos
	public function __toString() {
		return "Nome: {$this->getNome()} <br>
				Altura: {$this->getAltura()}";
	}

}


?>