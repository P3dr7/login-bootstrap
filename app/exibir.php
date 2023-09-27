<?php
//captura os cookies
$emailLogin = $_COOKIE['email'];
$identi = $_COOKIE['identi'];
// usuários cadastrados
$filename = "../files/arquivo-leitura.csv";
$userFound = false;
$nome = "";
$userId = null; // Variável para armazenar o ID do usuário encontrado

if (file_exists($filename)) {
    $file = fopen($filename, "r");
    $headers = explode(",", trim(fgets($file))); // Removendo nova linha do cabeçalho

    $data = array();
    while ($row = fgets($file)) {
        $rowData = explode(",", $row);
        $linha = array();
        for ($i = 0; $i < count($headers); $i++) {
            $linha[$headers[$i]] = trim($rowData[$i]); // Removendo nova linha dos dados
        }
        array_push($data, $linha);
    }
    fclose($file);

    foreach ($data as $userData) {
        if($userData['Email'] == $emailLogin && $userData['ID'] == $identi){
            $nome = $userData['Nome'];
            $userId = $userData['ID']; // Capturando o ID do usuário encontrado
            $userFound = true;
            break;
        }
    }
}
//print_r($userData);
// CEP
$enderecoDoUsuario = array(); // Armazena os dados do endereço do usuário

$filenamec = "../files/cep.csv";
$datac = array();
if (file_exists($filenamec)) {
    $filec = fopen($filenamec, "r");
    $headersc = fgetcsv($filec); // Obtendo os cabeçalhos

    while ($rowDatac = fgetcsv($filec)) {
        if ($rowDatac[0] == $userId) { // Supondo que o ID do endereço seja a primeira coluna
            for ($i = 0; $i < count($headersc); $i++) {
                if (isset($rowDatac[$i])) {
                    $enderecoDoUsuario[$headersc[$i]] = trim($rowDatac[$i]); // Armazenando os dados do endereço
                }
            }
            break;
        }
    }
    fclose($filec);
}

//echo $nome;
//print_r($enderecoDoUsuario); // Exibindo os dados do endereço do usuário

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login Feito</title>
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="w-100 m-auto form-container">
        <!-- Envolver todos os elementos acima do botão -->
        <div id="elementsAboveButton">
            <div class="d-grid gap-2 container-fluid row justify-content-md-center">
                <div class="col-md-auto text-center">
                    <h1 class="h3 mb-3 fw-normal">Bem-vindo <?=$nome;?></h1>
                    <p class="gap-1 p-2 border border-primary rounded">Usuário <ins class="text-primary"><?=$nome;?></ins> logado com sucesso</p>
                    <p class="gap-1 p-2 border border-primary rounded">Cadastrado com o email:<ins class="text-primary"><br><?=$emailLogin;?></ins></p>
                    <p class="p-2 border border-primary rounded-top border-bottom-0">Sua Localidade:</p>
                    <table class="table table-bordered border-primary">
                        <thead>
                            <tr>
                                <th scope="col">CEP</th>
                                <th scope="col">Logradouro</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Localidade</th>
                                <th scope="col">UF</th>
                                <th scope="col">IBGE</th>
                                <th scope="col">DDD</th>
                                <th scope="col">Siafi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$enderecoDoUsuario['cep'];?></td>
                                <td><?=$enderecoDoUsuario['logradouro'];?></td>
                                <td><?=$enderecoDoUsuario['bairro'];?></td>
                                <td><?=$enderecoDoUsuario['localidade'];?></td>
                                <td><?=$enderecoDoUsuario['uf'];?></td>
                                <td><?=$enderecoDoUsuario['ibge'];?></td>
                                <td><?=$enderecoDoUsuario['ddd'];?></td>
                                <td><?=$enderecoDoUsuario['siafi'];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="../index.html" class="d-flex btn btn-outline-danger justify-content-center align-items-center" id="dynamicButton">Sair</a>
    </main>
<script>
    window.onload = function() {
    const elementsAbove = document.getElementById('elementsAboveButton');
    const button = document.getElementById('dynamicButton');
    button.style.width = elementsAbove.offsetHeight + 'px';
};
</script>

</body>

</html>