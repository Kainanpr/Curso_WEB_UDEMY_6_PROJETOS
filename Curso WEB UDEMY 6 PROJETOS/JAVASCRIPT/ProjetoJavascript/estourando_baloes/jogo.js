var timerId = null; //Variavel que armazena a chamda da função time out;

function iniciarJogo() {
	alert("Jogo iniciado!");

	var url = window.location.search;

	var nivelJogo = url.replace("?", "");

	var tempoSegundos = 0;


	if(nivelJogo == 1)        //1 facil -> 120 segundos
		tempoSegundos = 120;
	else if(nivelJogo == 2)   //2 normal -> 60 segundos
		tempoSegundos = 60;
	else                      //3 dificil -> 30 segundos
		tempoSegundos = 30;

	//inserindo segundos no span
	document.getElementById("cronometro").innerHTML = tempoSegundos;

	//Quantidade de balões
	var qtdBaloes = 5;

	criaBaloes(qtdBaloes);

	//Imprimir qtde baloes inteiros
	document.getElementById("baloes-inteiros").innerHTML = qtdBaloes;
	document.getElementById("baloes-estourados").innerHTML = 0;

	contagemTempo(tempoSegundos + 1)

}

function contagemTempo(segundos) {
	segundos--;

	if(segundos == -1) {
		clearTimeout(timerId);//Para a execucao da funcao do setTimeout
		gameOver();
		return false;
	}

	document.getElementById("cronometro").innerHTML = segundos;

	timeId = setTimeout("contagemTempo("+segundos+")", 1000)

}

function gameOver() {
	alert("Fim de jogo, você não conseguiu estourar todos os balões a tempo!")
}

function criaBaloes(qtdBaloes) {

	for(var i=1; i<=qtdBaloes; i++) {
		var balao = document.createElement("img");

		balao.src = "imagens/balao_azul_pequeno.png";
		balao.style.margin = "10px";
		balao.onclick = function() { estourar(this); }

		balao.id = "b" + i;

		document.getElementById("cenario").appendChild(balao);
	}

}

function estourar(e) {
	var idBalao = e.id;

	e.onclick = "";

	document.getElementById(idBalao).src = "imagens/balao_azul_pequeno_estourado.png";

	pontuacao(-1);
	
}

function pontuacao(acao) {
	var baloesInteiros = document.getElementById("baloes-inteiros").innerHTML;
	var baloesEstourados = document.getElementById("baloes-estourados").innerHTML;


	

	baloesInteiros = parseInt(baloesInteiros);
	baloesEstourados = parseInt(baloesEstourados);

	baloesInteiros = baloesInteiros + acao;
	baloesEstourados = baloesEstourados - acao;

	document.getElementById("baloes-inteiros").innerHTML = baloesInteiros;
	document.getElementById("baloes-estourados").innerHTML = baloesEstourados;

	situacaoJogo(baloesInteiros);

}

function situacaoJogo(baloesInteiros) {
	if(baloesInteiros == 0) {
		alert("Parabéns, você conseguiu estourar todos os balões a tempo!");
		clearTimeout(timerId);
	}
}

