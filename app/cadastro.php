<?php


$nome = $_POST['e-mail'];
$senha = md5($_POST['password']);
$filename = "../files/arquivo-leitura.csv";
// Abra o arquivo CSV para leitura e escrita
$file = fopen($filename, "a+");
if ($file === false) {
    die("Não foi possível abrir o arquivo.");
}

// Bloqueie o arquivo para evitar problemas de concorrência
if (flock($file, LOCK_EX)) {
    // Conte o número de linhas existentes no arquivo
    $lineCount = 0;
    while (fgets($file)) {
        $lineCount++;
    }

    // Incrementar o contador de linhas (o primeiro campo, neste caso, ID)
    $lineCount++;

    // Crie o novo registro com o ID incrementado e os dados fornecidos
    $newRecord = [($lineCount-1), $nome, $senha];

    // Escreva o novo registro no arquivo CSV
    fputcsv($file, $newRecord);

    // Solte o bloqueio do arquivo
    flock($file, LOCK_UN);

    // Feche o arquivo
    fclose($file);

    echo "O novo registro foi adicionado ao CSV com sucesso.";
} else {
    echo "Não foi possível bloquear o arquivo para escrita.";
}
?>