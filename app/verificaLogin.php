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
        $id = $userData['ID'];
        $nome = $userData['Nome'];
        $userFound = true;
        break;
    }
}

if ($userFound) {
    header("Location: exibir.php?ident=$id");
    header("Location: exibir.php?email=$emailLogin");

} else {
    echo "Email ou senha inválidos";
}

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
    <div class="d-grid gap-2 container-fluid row justify-content-md-center">      
        <div class="col-md-auto text-center">
            <h1 class="h3 mb-3 fw-normal">Bem-vindo <?=$nome;?></h1>
            <p class="gap-1 p-2 border border-primary rounded">Usuário <ins class="text-primary"><?=$id;?></ins> logado com sucesso</p>
            <p class="gap-1 p-2 border border-primary rounded">Cadastrado com o email:<ins class="text-primary"><br><?=$emailLogin;?></ins></p>
            <a href="index.html" class="btn btn-outline-danger mt-1 w-100 py-2">Sair</a>
        </div>
    </div>
    </main>
</body>
</html>