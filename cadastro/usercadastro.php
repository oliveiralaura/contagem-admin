<?php

require_once('startup/connectBD.php');


function cadastra($mysqli, $nome, $matricula, $senha, $senha_repetida){
    if(!empty($nome) && !empty($matricula) && !empty($senha) && !empty($senha_repetida)){

        if ($senha === $senha_repetida) {
            // $senha_hash = sha1($senha);
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $query = "INSERT INTO admins (id_admin, nome_admin, matricula_admin, senha_admin) VALUES (null, '$nome', '$matricula', '$senha_hash')";

            if($mysqli->query($query)) {
                header("Location: login.php");
            } else {
                echo "Erro ao inserir registro: " . $mysqli->error;
            }
        } else {
            echo "As senhas não coincidem!";
        }
    }
}

function verificaLogin($mysqli){
    if(isset($_POST['matricula-login']) && isset($_POST['inputPassword6'])) {
        $matricula = $_POST['matricula-login'];
        $senha = $_POST['inputPassword6'];

        $query = "SELECT * FROM admins WHERE matricula_admin='$matricula'";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome_admin = $row['nome_admin'];
            $senha_hash = $row['senha_admin'];

            if (password_verify($senha, $senha_hash)) {
                // A senha é válida
                session_start();
                $_SESSION['matricula'] = $matricula;
                $_SESSION['nome_admin'] = $nome_admin;


                header("Location: home.php?login=success");
                
                exit(); 
            } else {
                // A senha é inválida
                echo "Matrícula ou senha incorretas.";
            }
        } else {
            echo "Matrícula não encontrada.";
        }
    }
}

?>