<html>
<head>
  <title>Algoritmo de Busca em Profundidade</title>
</head>

<body>

<form action="" method="post" enctype="multipart/form-data">    
  <input type="file" name="arquivo">
  <input type="submit" name="enviar" value="Enviar">
</form>

<?php
class Graph {
    public $_len = 0;
    public $_g = array();
    public $_visited = array();
 
    public function _initVisited(){
        for ($i = 0; $i < $this->_len; $i++) {
            $this->_visited[$i] = 0;
        }
    }
 
    public function depthFirst($vertex){
        $this->_visited[$vertex] = 1;
 
        echo $vertex . "\n";
 
        for ($i = 0; $i < $this->_len; $i++) {
            if ($this->_g[$vertex][$i] == 1 && !$this->_visited[$i]) {
                $this->depthFirst($i);
            }
        }
    }
}
 
$g = new Graph();

    if(isset($_POST['enviar'])){
      if(isset($_FILES['arquivo'])){

        $dir = 'txt/';
        $nome = $_FILES['arquivo']['name'];
        
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$nome);

        $arq = fopen($dir.$nome, "r");

        $num = explode(" ", fgets($arq, 4096));       

        while (!feof ($arq)){
          $i = 0;
          $linha[]= explode(" ", fgets($arq, 4096));
          $i++;          
        }  

        fclose ($arq);
      
        $g->_g = $linha;
        $g->_len = count($g->_g);
        $g->_initVisited();

        echo '<pre>';
        print_r($num[0]);
        echo '</pre>';

        $numero = (int) $num[0];
        $g->depthFirst($numero);
                     

      }
    }

?>