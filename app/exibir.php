<?php
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
    }
    fclose($file);

}
//CEP

$filenamec = "../files/cep.csv";

if(file_exists($filenamec)){
    $filec = fopen($filenamec, "r");

    $headersc = explode(",", trim(fgets($filec))); // Removendo nova linha do cabeçalho

    $datac = array();

    while($rowc = fgets($filec)){
        $rowDatac = explode(",", $rowc);
        $linhac = array();
        for ($i=0; $i < count($headersc); $i++) { 
            $linhac[$headersc[$i]] = trim($rowDatac[$i]); // Removendo nova linha dos dados
        }

        array_push($datac, $linhac);
    }
    fclose($filec);
}
?>
<!--Cadastros-->
<table border="1">
    <!-- Cabeçalhos da Tabela -->
    <tr>
        <?php foreach($headers as $header): ?>
            <th><?php echo $header; ?></th>
        <?php endforeach; ?>
    </tr>

    <!-- Dados -->
    <?php foreach($data as $row): ?>  
        <tr>
            <?php foreach($row as $value): ?>
                <td><?php echo $value; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<br/>
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