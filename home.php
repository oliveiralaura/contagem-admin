<?php
   
   session_start();
    require_once('startup/connectBD.php');
    include('cadastro/usercadastro.php');
    
        
    if (!isset($_SESSION['matricula'])) {
        header("Location: login.php");
        exit();
    }

    $nome_admin = $_SESSION['nome_admin'];

    $sql_usuarios = "SELECT * from contagem_hj_aluno;";
    $result_usuarios = $mysqli->query($sql_usuarios);

    if (mysqli_num_rows($result_usuarios) > 0) {
        while ($user = mysqli_fetch_array($result_usuarios)) {
            $dados_usuarios[] = array(
                'total' => $user['total'],
                'qtd' => $user['qtd'],
                'turma' => $user['turma'],
                'responsavel' => $user['responsavel']
            );
        }
    } else {
        echo 'Nenhum registro de usuários';
        exit;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home</title>
</head>
<body id="body-home">
    <main class="main-home" id="main-home">  
        <nav id="nav-home">
            <img src="images/logo.png" alt="logo" class="img-home"><h3>Controle de Almoço </h3>
            <form action="logout.php" method="post" id="form-logout">
                <input type="hidden" name="logout" value="true">
                <a href="#" onclick="document.getElementById('form-logout').submit();">Sair</a>
            </form>


        </nav>
        <div id="div-home">
        <p>Bem vindo, <?php echo $nome_admin; ?> </p>
            <p>
                <?php
                setlocale(LC_ALL, 'pt_BR');
                echo strftime('%e de %B de %Y');
                ?>
            </p>
        </div>

        <div id="div-form">
        <?php foreach ($dados_usuarios as $retorno): ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Total: <?php echo $retorno['total']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Quantidade: <?php echo $retorno['qtd']; ?></h6>
                    <p class="card-text">Turma: <?php echo $retorno['turma']; ?></p>
                    <p class="card-text">Responsável: <?php echo $retorno['responsavel']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    </main>
    <footer></footer>
</body>
</html>