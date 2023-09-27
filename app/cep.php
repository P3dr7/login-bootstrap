<?php
//seta cookies
setcookie('nome',$_POST['nome'], time() + 3600, "/");
setcookie('password',$_POST['password'], time() + 3600, "/");
setcookie('e-mail',$_POST['e-mail'], time() + 3600, "/");

$filename = "../files/cep.csv";
$verificaL = false;
// Verifica se o arquivo já existe
$fileExists = file_exists($filename);

$file = fopen($filename, "a");

$cep = $_POST['CEP'];

// Busca os dados do CEP no serviço viacep
$endereco = array();
$link = "https://viacep.com.br/ws/$cep/json/";
$ch = curl_init($link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);
$endereco = json_decode($response, true);

// Remove a chave 'gia' e 'Complemento' do array, pois eles são nulos
unset($endereco['gia']);
unset($endereco['complemento']);

// Se o array $endereco tiver apenas 1 elemento, exibe um aviso e encerra a execução
if (count($endereco) == 1) {
    die("Ocorreu um erro ao buscar os dados do CEP.");
}
// Se o arquivo não existir ou estiver vazio, escreve os cabeçalhos
if (!$fileExists || filesize($filename) == 0) {
    fputcsv($file, array_merge(array('ID'), array_keys($endereco)));
    $endereco = array_merge(array(1), $endereco);
} else {
    // Determina o próximo ID contando o número de linhas no arquivo
    $currentLines = count(file($filename));
    $endereco = array_merge(array($currentLines), $endereco);
}

// Insere os dados no arquivo CSV
fputcsv($file, $endereco);
if(fputcsv($file, $endereco)){;
$verificaL = true;
}
// Fecha o arquivo
fclose($file);
header('Location: cadastro.php');
setcookie("verCep", $verificaL, time() + 3600, "/")
?>
