<?php

$nome = $_POST['nome'];
$senha = md5($_POST['password']);
$filename = "../files/arquivo-leitura.csv";
$file=fopen($filename, "w+"); 
$headers = fgets($file);

/* fseac
usar funcao que coloca no final antes de rodar o for
colocar o arquivo em memoria, apagar ele reescrever e dps upar de volta"*/
?>