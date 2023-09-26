<?php
//Variáveis
$emailLogin = $_POST['e-mail'];
$senhaLogin = $_POST['password'];
$filename = "../files/arquivo-leitura.csv";
$data = array();

//transforma os dados do arquivo em um array 
if(file_exists($filename)) {
    $file = fopen($filename,"r");

    //Le o cabeçalho
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
        $nome = $userData['Nome'];
        $userFound = true;
        break;
    }
}

/*if ($userFound) {
    echo $nome . "<br>" . $emailLogin;
} else {
    echo "Email ou senha inválidos";
}*/

?>
<br>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Formulario de Login</title>
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="w-100 m-auto form-container">  
        <div class="d-grid gap-2 ">      
            <h1 class="h3 d-flex mb-3 fw-normal justify-content-center align-items-center">Bem-vindo <?=$nome;?></h1>
            <p class="d-flex gap-1 p-2 border border-primary rounded justify-content-center m-auto">Usuário <ins class="text-primary"><?=$nome;?></ins> logado com sucesso</p>
            <p class="d-flex gap-1 p-2 border border-primary rounded justify-content-center m-auto">Cadastrado com o email:<ins class="text-primary"><?=$emailLogin;?></ins></p>
            <div class="d-flex justify-content-center align-items-center">
                <a href="index.html" class="btn btn-outline-danger mt-3 w-50">Sair</a>
            </div>
        </div>
    </main>
</body>
</html>