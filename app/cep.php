<?php

$filename = "../files/cep.csv";

// Verifica se o arquivo já existe
$fileExists = file_exists($filename);

$file = fopen($filename, "a");

$cep = $_GET['message'];

// Busca os dados do CEP no serviço viacep
$endereco = array();
$link = "https://viacep.com.br/ws/$cep/json/";
$ch = curl_init($link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);
$endereco = json_decode($response, true);

// Remove a chave 'gia' e 'Complemento' do array como ele e nulo
unset($endereco['gia']);
unset($endereco['complemento']);

// Se o arquivo não existir ou estiver vazio, escreve os cabeçalhos
if (!$fileExists || filesize($filename) == 0) {
    fputcsv($file, array_keys($endereco));
}

// Insere os dados no arquivo CSV
fputcsv($file, $endereco);

// Fecha o arquivo
fclose($file);
header('Location: exibir.php');
?>
