
<?php
require_once("cadastro/cadastra.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Cardápio</title>
</head>
<body>
    <div>
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="date" name="dia" id="dia">
            <input type="file" name="arquivo" id="arquivo">
            <input type="submit" value="enviar" id="envia" name="envia">
        </form>
    </div>
</body>
</html>

