<?php

$nome = $_POST['e-mail'];
$senha = md5($_POST['password']);
$filename = "../files/arquivo-leitura.csv";


$headers = array();
$date = array();


$file=fopen($filename, "a+"); 
//fwrite($file, implode(",", $headers). "\r\n");


if(isset($senha)){
    //$headers = explode(",", fgets($file));
    $concat = $nome . "," . $senha;
    if ($file){
        for ($i=0; $i < 2; $i++) { 
            $concat = $i . "," . $concat;
            array_push($data, $concat);
            fwrite($file , implode(",", $data)."\r\n");
        }
        
    }
}
fclose($file);

/* fseac
usar funcao que coloca no final antes de rodar o for
colocar o arquivo em memoria, apagar ele reescrever e dps upar de volta"*/
?>