<?php
include("startup/connectBD.php");


function cadastra($mysqli){
    if(isset($_POST['envia']) && isset($_FILES['arquivo']['name']) && !empty($_POST['dia'])){
        
        $diretorio = "uploads/";
    
        $dataCardapio = $_POST['dia'];
        $nomeArquivo = $_FILES['arquivo']['name'];
        $tempName = $_FILES['arquivo']['tmp_name'];
        $caminhoArquivo = $diretorio . $nomeArquivo;
        
        if (is_uploaded_file($tempName)) { // Verifica se o arquivo foi enviado corretamente
            if (move_uploaded_file($tempName, $caminhoArquivo)) {
                $stmt = $mysqli->prepare("INSERT INTO cardapios(id_cardapio, data_cardapio, image_cardapio) VALUES (null, ?, ?)");
                $stmt->bind_param('ss', $dataCardapio, $nomeArquivo);
                if ($stmt->execute()) {
                    echo "Registro inserido com sucesso!<br>";
                } else {
                    echo "Erro ao inserir registro: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Erro ao fazer upload do arquivo.";
            }
        } else {
            echo "Erro ao enviar o arquivo.";
        }
    }
}


if(isset($_POST['envia'])){
    cadastra($mysqli);
}
?>
