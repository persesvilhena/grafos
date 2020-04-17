<html>
<head>
  <title>Algoritmo de Prim</title>
</head>

<body>

<form action="" method="post" enctype="multipart/form-data">    
  Tamanho da Matriz: <input type="text" name="tamanho">
  <input type="submit" name="ok" value="OK">
</form>        

<hr>

					
<?php 

$INT_MAX = 0x7FFFFFFF;

function MinKey($key, $set, $verticesCount){
  global $INT_MAX;
  $min = $INT_MAX;
  $minIndex = 0;

  for ($v = 0; $v < $verticesCount; ++$v)
  {
    if ($set[$v] == false && $key[$v] < $min)
    {
      $min = $key[$v];
      $minIndex = $v;
    }
  }

  return $minIndex;
}

function PrintResult($parent, $graph, $verticesCount){
  echo "<pre>" . "Aresta     Peso" . "</pre>";
  for ($i = 1; $i < $verticesCount; ++$i)
    echo "<pre>" . $parent[$i] . " - " . $i . "    " . $graph[$i][$parent[$i]] . "</pre>";
}

function Prim($graph, $verticesCount){
  global $INT_MAX;
  $parent = array();
  $key = array();
  $mstSet = array();

  for ($i = 0; $i < $verticesCount; ++$i)
  {
    $key[$i] = $INT_MAX;
    $mstSet[$i] = false;
  }

  $key[0] = 0;
  $parent[0] = -1;

  for ($count = 0; $count < $verticesCount - 1; ++$count)
  {
    $u = MinKey($key, $mstSet, $verticesCount);
    $mstSet[$u] = true;

    for ($v = 0; $v < $verticesCount; ++$v)
    {
      if ($graph[$u][$v] && $mstSet[$v] == false && $graph[$u][$v] < $key[$v])
      {
        $parent[$v] = $u;
        $key[$v] = $graph[$u][$v];
      }
    }
  }

  PrintResult($parent, $graph, $verticesCount);
}

if (isset($_POST['ok'])) {
	$tamanho = $_POST['tamanho'];	
	echo "
  <form action=\"\" method=\"post\">
  <table>
  <input type=\"hidden\" value=\"" . $tamanho . "\" name=\"tam\">
  <h4>Valores da Matriz</h4><br>";                        
	for ($i=0; $i <$tamanho ; $i++) { 
		echo "<tr>";
		for ($j=0; $j < $tamanho ; $j++) { 
      echo "<td><input type=\"text\" name=\"" . $i.$j  . "\"></td>";
		}
		echo "</tr>";
	}
  echo "
  </table>
	<input type=\"submit\" name=\"enviar\">
  </form>";

}      

if (isset($_POST['enviar'])) {
	
	$tamanho = $_POST['tam'];

	for ($i=0; $i <  $tamanho; $i++) { 
		for ($j=0; $j <  $tamanho ; $j++) { 
			$graph[$i][$j] = $_POST[$i.$j];
		}
	}

	echo 'Árvore Minima do Grafo<br>';
	Prim($graph, $tamanho);
}




