
                  
            <form action="" method="post" enctype="multipart/form-data">    
                  <input type="file" name="arquivo">
                  <input type="submit" name="enviar" value="Enviar">
            </form>

    <?php

    if(isset($_POST['enviar'])){
      if(isset($_FILES['arquivo'])){
        $dir = 'txt/';
        $nome = $_FILES['arquivo']['name'];
        
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$nome);

        $arq = fopen($dir.$nome, "r");

        $num = (int) fgets($arq, 4096);
        $num++;
        echo $num;

        while (!feof ($arq)){
          $i = 0;
          $linha[$i][]= explode(" ", fgets($arq, 4096));
          $i++;
          
        }
        echo '<pre>';
        print_r($linha);
        echo '</pre>';

        fclose ($arq);

        for ($i= 0; $i < $num-1; $i++) { 
          for ($j= 0; $j < $num-1; $j++) { 
            $n[] = (int) $linha[0][$i][$j];            
          }
        }

        var_dump($n);
        

      }else{
        echo "Não foi possivel carregar o arquivo!";
      }
    }


    ?>

