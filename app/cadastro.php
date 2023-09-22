<?php

$nome = $_POST['e-mail'];
$senha = md5($_POST['password']);
$filename = "../files/arquivo-leitura.csv";
$file=fopen($filename, "a+"); 
$headers = fgets($file);


if(isset($senha)){
    //$headers = explode(",", fgets($file));
    $concat = $nome . "," . $senha;
    $data = fgets($file);
    if ($file){
        //Verifica todas as linhas do arquivo
        while (($lineFile = fgetcsv($file)) !== FALSE){
            $dataFile[] = $lineFile; // Armazena cada linha em uma matriz
        }
    
        // Conta a quantidade de colunas do array na posição 0 
        
        $numColumns = count($dataFile[0]);
    
        // Imprime a quantidade colunas. 
        echo $numColumns;
       
        for ($i=0; $i < $numColumns; $i++) { 
            $concat = $i. "," . $concat;

        }
        fwrite($file , $concat."\r\n");
        
    }  
}
fclose($file);
/* fseac
usar funcao que coloca no final antes de rodar o for
colocar o arquivo em memoria, apagar ele reescrever e dps upar de volta"*/
?>