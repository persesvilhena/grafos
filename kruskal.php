<html>
<head>
  <title>Algoritmo de kruskal</title>
</head>

<body>

<form action="" method="post" enctype="multipart/form-data">    
  <input type="file" name="arquivo">
  <input type="submit" name="enviar" value="Enviar">
</form>

<?php
class Edge{
	public $Source;
	public $Destination;
	public $Weight;
}

class Graph{
	public $VerticesCount;
	public $EdgesCount;
	public $_edge = array();
}

class Subset{
	public $Parent;
	public $Rank;
}

function CreateGraph($verticesCount, $edgesCoun){
	$graph = new Graph();
	$graph->VerticesCount = $verticesCount;
	$graph->EdgesCount = $edgesCoun;
	$graph->_edge = array();
	for ($i = 0; $i < $graph->EdgesCount; ++$i)
		$graph->_edge[$i] = new Edge();
	return $graph;
}

function Find($subsets, $i){
	if ($subsets[$i]->Parent != $i)
		$subsets[$i]->Parent = Find($subsets, $subsets[$i]->Parent);
	return $subsets[$i]->Parent;
}

function Union($subsets, $x, $y){
	$xroot = Find($subsets, $x);
	$yroot = Find($subsets, $y);
	if ($subsets[$xroot]->Rank < $subsets[$yroot]->Rank)
		$subsets[$xroot]->Parent = $yroot;
	else if ($subsets[$xroot]->Rank > $subsets[$yroot]->Rank)
		$subsets[$yroot]->Parent = $xroot;
	else
	{
		$subsets[$yroot]->Parent = $xroot;
		++$subsets[$xroot]->Rank;
	}
}

function CompareEdges($a, $b){
	return $a->Weight > $b->Weight;
}

function PrintResult($result, $e){
	for ($i = 0; $i < $e; ++$i)
		echo $result[$i]->Source . " " . $result[$i]->Destination . " (" . $result[$i]->Weight . ")<br/>";
}

function Kruskal($graph){
	$verticesCount = $graph->VerticesCount;
	$result = array();
	$i = 0;
	$e = 0;
	
	usort($graph->_edge, "CompareEdges");

	$subsets = array();

	for ($v = 0; $v < $verticesCount; ++$v)
	{
		$subsets[$v] = new Subset();
		$subsets[$v]->Parent = $v;
		$subsets[$v]->Rank = 0;
	}

	while ($e < $verticesCount - 1)
	{
		$nextEdge = $graph->_edge[$i++];
		$x = Find($subsets, $nextEdge->Source);
		$y = Find($subsets, $nextEdge->Destination);

		if ($x != $y)
		{
			$result[$e++] = $nextEdge;
			Union($subsets, $x, $y);
		}
	}
	PrintResult($result, $e);
}

    if(isset($_POST['enviar'])){
      if(isset($_FILES['arquivo'])){

        echo 'Árvore Minima do Grafo<br>';

        $dir = 'txt/';
        $nome = $_FILES['arquivo']['name'];
        
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$nome);

        $arq = fopen($dir.$nome, "r");

        $num[] = explode(" ", fgets($arq, 4096));       
     	  $verticesCount = $num[0][0];
     	  $edgesCount = $num[0][1];    
     

        for ($x=0; $x < $verticesCount; $x++) { 
           $vertices[$x] =  explode(" ", fgets($arq, 4096));
        }

        while (!feof ($arq)){
          $i = 0;
          $linha[$i][]= explode(" ", fgets($arq, 4096));
          $i++;          
        }  

        fclose ($arq);
      
        $graph = CreateGraph($verticesCount, $edgesCount);

        for ($i= 0; $i < $edgesCount; $i++) { 
            
            $graph->_edge[$i]->Source = $linha[0][$i][0];
            $graph->_edge[$i]->Destination = $linha[0][$i][1];
            $graph->_edge[$i]->Weight = $linha[0][$i][2];
        }

   	    Kruskal($graph);               

      }
    }

?>

</body>
</html>