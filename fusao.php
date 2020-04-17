<html>
<head>

	<title>Algoritmo de fusão</title>
</head>
<body>


<form method="post" action="">
Quantidade de vertices: <input type="text" name="qtde">
<button type="submit" name="enviar">Enviar</button>
</form>

<?php

function simplifica(){
	global $matriz;
	$x = 0;
	$y = 0;
	while(isset($matriz[$x][$y])){
		while(isset($matriz[$x][$y])){
			if(($matriz[$x][$y]) == 0 || $x == $y){
				$matriz[$x][$y] = 0;
			}else{
				$matriz[$x][$y] = 1;
			}
			$y++;
		}
		$x++;
		$y = 0;
	}
}

function imprimir(){
	global $matriz;
	$x = 0;
	$y = 0;
	echo "<table border=\"1\">";
	while(isset($matriz[$x][$y])){
		echo "<tr>";
		while(isset($matriz[$x][$y])){
			echo "<td>" . $matriz[$x][$y] . "</td>";
			$y++;
		}
		echo "</tr>";
		$x++;
		$y = 0;
	}
	echo "</table>";
}

function somatorio($pa, $pb){
	global $matriz;
	$x = 0;
	$y = 0;
	while(isset($matriz[$x][$y])){
		$matriz[$x][$pa] = $matriz[$x][$pa] + $matriz[$x][$pb];
		$x++;
	}
	$x = 0;
	while(isset($matriz[$x][$y])){
		$matriz[$pa][$y] = $matriz[$pa][$y] + $matriz[$pb][$y];
		$y++;
	}

}

function limpa_matriz($val){
	global $matriz;
	$x = $val;
	$y = 0;
	while(isset($matriz[$x][$y])){
		while(isset($matriz[$x][$y])){
			if(isset($matriz[$x + 1][$y])){
				$matriz[$x][$y] = $matriz[$x + 1][$y];
			}else{
				$matriz[$x][$y] = null;
			}
			
			$x++;
		}
		$x = $val;
		$y++;
	}

	$x = 0;
	$y = $val;
	while(isset($matriz[$x][$y])){
		while(isset($matriz[$x][$y])){
			if(isset($matriz[$x][$y + 1])){
				$matriz[$x][$y] = $matriz[$x][$y + 1];
			}else{
				$matriz[$x][$y] = null;
			}
			
			$y++;
		}
		$y = $val;
		$x++;
	}

}

function modulo_fusao(){
	imprimir();
	simplifica();
	imprimir();
	global $matriz;
	$x = 0;
	$y = 0;
	while(isset($matriz[$x][$y])){
		
		if($matriz[$x][$y] > 0){
			$pa = $x;
			$pb = $y;
			break;
		}
		$y++;

		if(!isset($matriz[$x][$y])){
			$x++;
			$y = 0;
		}
	}
	if(isset($pa)){
		somatorio($pa, $pb);
		imprimir();
		limpa_matriz($pb);
	}
	
	imprimir();

}
function calcula_valor(){
	global $matriz;
	$x = 0;
	$y = 0;
	$valor = 0;
	while(isset($matriz[$x][$y])){
		$valor = $valor + $matriz[$x][$y];

		$y++;

		if(!isset($matriz[$x][$y])){
			$x++;
			$y = 0;
		}
	}
	return $valor;
}
function fusao(){
	global $matriz;
	while(calcula_valor() != 0){
		modulo_fusao();
	}
}


if(isset($_POST["enviar"])) {
	$qtde = $_POST["qtde"];
	echo "<form method=\"post\" action=\"\"><table>";
	for($x=0; $x<$qtde; $x++){
		echo "<tr>";
		for($y=0; $y<$qtde; $y++){
			echo "<td><input type\"text\" name=\"" . $x . $y . "\"></td>";
		}
		echo "</tr>";
	}
	echo "</table><input type=\"hidden\" name=\"qtde\" value=\"" . $qtde . "\"><input type=\"submit\" name=\"enviar_matriz\"></form>";
}


if(isset($_POST["enviar_matriz"])) {
	$qtde = $_POST["qtde"];
	for($x=0; $x<$qtde; $x++){
		for($y=0; $y<$qtde; $y++){
			$matriz[$x][$y] = $_POST[$x . $y];
		}
	}
	//var_dump($matriz);
	//imprimir();
	//simplifica();
	//imprimir();
	fusao();
	
	/*echo "<table>";
	for($x=0; $x<$qtde; $x++){
		echo "<tr>";
		for($y=0; $y<$qtde; $y++){
			echo "<td>" . $_POST[$x . $y] . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";*/
}


?>

</body>
</html>