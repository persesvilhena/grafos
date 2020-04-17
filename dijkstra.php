<html>
<head>
  <title>Algoritmo de dijkstra</title>
</head>

<body>

<form action="" method="post">
	<table>
		<tr>
			<td>Quantidade de vertices:</td>
			<td><input type="text" name="vertices"></td>
		</tr>
		<tr>
			<td>Quantidade de arestas:</td>
			<td><input type="text" name="arestas"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="enviar" value="Enviar"></td>
		</tr>
	</table>
</form>
<hr>
<?php
    if(isset($_POST['enviar'])){
    	echo "<form action=\"\" method=\"post\"><input type=\"hidden\" name=\"qtde_vertice\" value=\"" . $_POST['vertices'] . "\"><input type=\"hidden\" name=\"qtde_aresta\" value=\"" . $_POST['arestas'] . "\">";
    	for($x=0;$x<$_POST['vertices'];$x++){
    		echo "Vertice " . $x . ": <input type=\"text\" name=\"ver" . $x . "\"><br>";
    	}
    	for($x=0;$x<$_POST['arestas'];$x++){
    		echo "Arestas " . $x . ": <input type=\"text\" name=\"x" . $x . "\"> ate <input type=\"text\" name=\"y" . $x . "\"> com peso <input type=\"text\" name=\"peso" . $x . "\"><br>";
    	}
    	echo "<br><input type=\"submit\" name=\"enviar1\" value=\"Enviar\"></form>";
    }

    if(isset($_POST['enviar1'])){
    	for($x=0;$x<$_POST['qtde_vertice'];$x++){
    		for($y=0;$y<$_POST['qtde_vertice'];$y++){
    			$matriz[$_POST['ver' . $x]][$_POST['ver' . $y]] = null;
    		}
    		$ultimo = $_POST['ver' . $x];
    	}
    	for($x=0;$x<$_POST['qtde_vertice'];$x++){
    		for($y=0;$y<$_POST['qtde_vertice'];$y++){
    			for($z=0;$z<$_POST['qtde_aresta'];$z++){
    				if(($_POST['ver' . $x] == $_POST['x' . $z] && $_POST['ver' . $y] == $_POST['y' . $z]) ||  ($_POST['ver' . $y] == $_POST['x' . $z] && $_POST['ver' . $x] == $_POST['y' . $z])){
    					$matriz[$_POST['ver' . $x]][$_POST['ver' . $y]] = $_POST['peso' . $z];
    				}
    			}
    		}
    	}

		echo "<pre>";
		var_dump($matriz);
		echo "</pre>";

		$vertice = $_POST['ver0'];
		echo $vertice;
		while($vertice != $ultimo){
			$menor = 9999999999999;
    		for($y=0;$y<$_POST['qtde_vertice'];$y++){
    			if($matriz[$_POST[$vertice]][$_POST['ver' . $y]] != null){
    				if($matriz[$_POST[$vertice]][$_POST['ver' . $y]] < $menor){
    					$menor = $matriz[$_POST[$vertice]][$_POST['ver' . $y]];
    				}
    			}
    		}
    		echo $menor . "<br>";
    		for($y=0;$y<$_POST['qtde_vertice'];$y++){
    			if($matriz[$_POST[$vertice]][$_POST['ver' . $y]] != null){
    				if($matriz[$_POST[$vertice]][$_POST['ver' . $y]] != $menor){
    					$matriz[$_POST[$vertice]][$_POST['ver' . $y]] = null;
    					$matriz[$_POST['ver' . $y]][$_POST[$vertice]] = null;
    				}
    			}
    		}
    		for($y=0;$y<$_POST['qtde_vertice'];$y++){
    			if($matriz[$_POST[$vertice]][$_POST['ver' . $y]] != null){
    				$vertice = $_POST['ver' . $y];
    				echo "carrrrrraaaaaaaaaaaaaaiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii";
    			}
    		}
    		echo "<hr>" . $vertice;
    	}
    	echo $ultimo;
    	echo "<hr>novo:<pre>";
		var_dump($matriz);
		echo "</pre>";

		//////////////////////// DESISTI, TO CANSADO, VAI DAR NAO
    }

?>

</body>
</html>