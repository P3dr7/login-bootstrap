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
    setcookie("identi", $id, time() + 3600, "/");  // Define um cookie por 1 hora
    setcookie("email", $emailLogin, time() + 3600, "/");  // Define um cookie por 1 hora
    header('Location: ./exibir.php');

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
    <title>ERROR</title>
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="w-100 m-auto form-container align-items-center">  
        <div class="d-grid gap-2 container-fluid justify-content-md-center">      
            <div class="text-center">
                <h1 class="h2 fw-bold border border-3 m-2 p-4 border-danger rounded text-danger w-100">Email ou senha inválidos</h1>
                <a href="../index.html" class="btn btn-outline-warning mt-1 w-50 py-2">Ir para Login</a>
            </div>
        </div>
    </main>
</body>
</html>