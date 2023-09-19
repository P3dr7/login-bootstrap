<?php

$nome = $_POST['nome'];
$senha = md5($_POST['password']);
$filename = "../files/arquivo-leitura.csv";
$file=fopen($filename, "w+"); 
$headers = fgets($file);



?>