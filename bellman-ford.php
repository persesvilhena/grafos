<?php
$INT_MAX = 0x7FFFFFFF;

class aresta{
	public $origem;
	public $destino;
	public $peso;
}
class grafo{
	public $verticesCount;
	public $arestasCount;
	public $aresta;
}






function criargrafo($verticesCount, $arestasCount){
	$grafo = new grafo();
	$grafo->verticesCount = $verticesCount;
	$grafo->arestasCount = $arestasCount;
	$grafo->aresta = array();
	
	for ($i = 0; $i < $grafo->arestasCount; ++$i){
		$grafo->aresta[$i] = new aresta();
	}

	return $grafo;
}





function imprimir($distancia, $count){
	echo "
	<table border=\"1\">
		<tr>
			<td>Vertice</td>
			<td>Distancia da origem</td>
		</tr>
	";

	for($i = 0; $i < $count; ++$i){
		echo "
		<tr>
			<td>" . $i . "</td>
			<td>" . $distancia[$i] . "</td>
		</tr>";
	}
	echo "</table>";
}





function BellmanFord($grafo, $origem){
	global $INT_MAX;
	$verticesCount = $grafo->verticesCount;
	$arestasCount = $grafo->arestasCount;
	$distancia = array();

	for ($i = 0; $i < $verticesCount; ++$i){
		$distancia[$i] = $INT_MAX;
	}

	$distancia[$origem] = 0;

	for ($i = 1; $i <= $verticesCount - 1; ++$i)
	{
		for ($j = 0; $j < $arestasCount; ++$j)
		{
			$u = $grafo->aresta[$j]->origem;
			$v = $grafo->aresta[$j]->destino;
			$peso = $grafo->aresta[$j]->peso;

			if ($distancia[$u] != $INT_MAX && $distancia[$u] + $peso < $distancia[$v]){
				$distancia[$v] = $distancia[$u] + $peso;
			}
		}
	}

	for ($i = 0; $i < $arestasCount; ++$i)
	{
		$u = $grafo->aresta[$i]->origem;
		$v = $grafo->aresta[$i]->destino;
		$peso = $grafo->aresta[$i]->peso;

		if ($distancia[$u] != $INT_MAX && $distancia[$u] + $peso < $distancia[$v]){
			echo "Grafo com ciclo de peso negativo";
		}
	}

	imprimir($distancia, $verticesCount);
}


////////inicializa o grafo
$verticesCount = 5;
$arestasCount = 8;
$grafo = criargrafo($verticesCount, $arestasCount);



/////////////define as arestas
// aresta 0-1
$grafo->aresta[0]->origem = 0;
$grafo->aresta[0]->destino = 1;
$grafo->aresta[0]->peso = -1;

// aresta 0-2
$grafo->aresta[1]->origem = 0;
$grafo->aresta[1]->destino = 2;
$grafo->aresta[1]->peso = 4;

// aresta 1-2
$grafo->aresta[2]->origem = 1;
$grafo->aresta[2]->destino = 2;
$grafo->aresta[2]->peso = 3;

// aresta 1-3
$grafo->aresta[3]->origem = 1;
$grafo->aresta[3]->destino = 3;
$grafo->aresta[3]->peso = 2;

// aresta 1-4
$grafo->aresta[4]->origem = 1;
$grafo->aresta[4]->destino = 4;
$grafo->aresta[4]->peso = 2;

// aresta 3-2
$grafo->aresta[5]->origem = 3;
$grafo->aresta[5]->destino = 2;
$grafo->aresta[5]->peso = 5;

// aresta 3-1
$grafo->aresta[6]->origem = 3;
$grafo->aresta[6]->destino = 1;
$grafo->aresta[6]->peso = 1;

// aresta 4-3
$grafo->aresta[7]->origem = 4;
$grafo->aresta[7]->destino = 3;
$grafo->aresta[7]->peso = -3;



////chama a funcao passando o grafo
BellmanFord($grafo, 0);

?>