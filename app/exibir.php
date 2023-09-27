<?php
$emailLogin = $_GET['email'];
//usuairos cadastrados 
$filename = "../files/arquivo-leitura.csv";
if(file_exists($filename)){
    $file = fopen($filename, "r");

    $headers = explode(",", trim(fgets($file))); // Removendo nova linha do cabeçalho

    $data = array();

    while($row = fgets($file)){
        $rowData = explode(",", $row);
        $linha = array();
        for ($i=0; $i < count($headers); $i++) { 
            $linha[$headers[$i]] = trim($rowData[$i]); // Removendo nova linha dos dados
        }

        array_push($data, $linha);
        print_r($data);
    }   
    foreach ($data as $userData) {
        if ($userData['Email'] == $emailLogin /*&& $userData['id'] == $id*/) {
            $nome = $userData['Nome'];
            $userFound = true;
            break;
        }
}
echo $nome;
//CEP

$filenamec = "../files/cep.csv";

if (file_exists($filenamec)) {
    $filec = fopen($filenamec, "r");

    // Obtendo os cabeçalhos
    $headersc = fgetcsv($filec);

    $datac = array();

    while ($rowDatac = fgetcsv($filec)) {
        $linhac = array();
        for ($i = 0; $i < count($headersc); $i++) {
            // Certificando-se de que existe um valor correspondente no rowDatac
            if (isset($rowDatac[$i])) {
                $linhac[$headersc[$i]] = trim($rowDatac[$i]); // Removendo espaços em branco
            }
        }

        array_push($datac, $linhac);
    }
}

//Verifica os logins 
$enderecosCorrespondentes = array(); // Array para armazenar endereços correspondentes

if (file_exists($filename) && file_exists($filenamec)) {
    // Convertendo os dados dos usuários em um array
    $users = array();
    while ($row = fgetcsv($file)) {
        $users[] = $row[0]; // Assumindo que o ID do usuário é a primeira coluna
    }

    // Verificando os endereços e comparando com os IDs dos usuários
    while ($rowDatac = fgetcsv($filec)) {
        $idEndereco = $rowDatac[0]; // Assumindo que o ID do endereço é a primeira coluna
        if (in_array($idEndereco, $users)) {
            $enderecosCorrespondentes[] = $rowDatac;
        }
    }
    
    fclose($file);
    fclose($filec);
}
print_r($enderecosCorrespondentes);
}
/*$filenamec = "../files/cep.csv";
$filenameUsers = "../files/arquivo-leitura.csv"; // Suponho que esse seja o arquivo dos usuários

$enderecosCorrespondentes = array(); // Array para armazenar endereços correspondentes

if (file_exists($filenameUsers) && file_exists($filenamec)) {
    $fileUsers = fopen($filenameUsers, "r");
    $filec = fopen($filenamec, "r");

    // Ignorando os cabeçalhos para simplificar (você pode adaptar conforme necessário)
    $headersUsers = fgetcsv($fileUsers);
    $headersc = fgetcsv($filec);

    // Convertendo os dados dos usuários em um array
    $users = array();
    while ($row = fgetcsv($fileUsers)) {
        $users[] = $row[0]; // Assumindo que o ID do usuário é a primeira coluna
    }

    // Verificando os endereços e comparando com os IDs dos usuários
    while ($rowDatac = fgetcsv($filec)) {
        $idEndereco = $rowDatac[0]; // Assumindo que o ID do endereço é a primeira coluna
        if (in_array($idEndereco, $users)) {
            $enderecosCorrespondentes[] = $rowDatac;
        }
    }
    
    fclose($fileUsers);
    fclose($filec);
}

print_r($enderecosCorrespondentes); // Exibindo os endereços correspondentes para verificação
*/

?>

<!--CEP-->
<br/>
<table border="1">
    <!-- Cabeçalhos da Tabela -->
    <tr>
        <?php foreach($headersc as $headerc): ?>
            <th><?php echo $headerc; ?></th>
        <?php endforeach; ?>
    </tr>

    <!-- Dados -->
    <?php foreach($datac as $rowcep): ?>  
        <tr>
            <?php foreach($rowcep as $valuecep): ?>
                <td><?php echo $valuecep; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<!--<!DOCTYPE html>
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
            <p class="gap-1 p-2 border border-primary rounded">Usuário <ins class="text-primary"><?=$nome;?></ins> logado com sucesso</p>
            <p class="gap-1 p-2 border border-primary rounded">Cadastrado com o email:<ins class="text-primary"><br><?=$emailLogin;?></ins></p>
            <a href="index.html" class="btn btn-outline-danger mt-1 w-100 py-2">Sair</a>
        </div>
    </div>
    </main>
    </body>
</html>-->