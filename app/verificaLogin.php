<?php
//Variaveis
$emailLogin = $_POST['e-mail'];
$senhaLogin = $_POST['password'];
$filename = "../files/arquivo-leitura.csv";
$data = array();

//transforma os dados do arquivo em um array 
if(file_exists($filename)) {
    $file = fopen($filename,"r");

    //Le o cabecalho
    $headers = fgetcsv($file);
    
    //le o resto das linhas
    while ($row = fgetcsv($file)) {
        if (count($headers) == count($row)) {
            $data[] = array_combine($headers, $row); // Combina cabeçalhos e valores
        } else {
            // Para depuração: imprime os dados problemáticos
            echo "Erro na linha: ";
            print_r($row);
            echo "<br>";
        }
    }
    fclose($file);
}else{
    die ("Por favor cadastre-se Primeiro");
}
// Verifica dados 
$userFound = false;
//roda os dados da tabela como array comparando cada campo
foreach ($data as $userData) {
    if ($userData['Email'] == $emailLogin && $userData['Senha(md5)'] == md5($senhaLogin)) {
        $userFound = true;
        break;
    }
}

if ($userFound) {
    echo "Usuário logado com sucesso";
} else {
    echo "Email ou senha inválidos";
}


?>