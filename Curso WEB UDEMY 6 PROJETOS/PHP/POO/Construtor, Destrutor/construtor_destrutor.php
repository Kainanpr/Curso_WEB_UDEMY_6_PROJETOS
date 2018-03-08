<?php

Class Pessoa {
	//Atributos
	private $nome;

	//Metodo Construtor
	public function __construct($nome) {
		$this->nome = $nome;
	}

	//Get e Set
	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

	//Metodos meus
	public function correr() {
		return $this->nome . " está correndo...";
	}

	//Metodos Magicos
	public function __toString() {
		return $this->nome;
	}

	public function __destruct() {
		echo "<br><br>Objeto removido<br><br>";
	}
}


$pessoa = new Pessoa("Kainan"); 

echo $pessoa;

echo "<br><br>";

echo $pessoa->correr();

?>