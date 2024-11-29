<?php

include_once './config/config.php';
include_once './classes/Usuario.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoUsuario = new Usuario($db);
    $nomeUsu = $_POST['nome'];
    $sexoUsu = $_POST['sexo'];
    $foneUsu = $_POST['fone'];
    $emailUsu = $_POST['email'];
    $senhaUsu = $_POST['senha'];
    $novoUsuario->criar($nomeUsu, $sexoUsu, $foneUsu, $emailUsu, $senhaUsu);
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="telaCadUsu">

    <div id="addUsu">
        <h1>Adicionar Usuário</h1>
        <form method="POST">
            <label for="nome">Nome:</label><br>
            <input class="inputText" type="text" name="nome" required>
            <br><br>
            <label>Sexo:</label><br>
            <label for="masculino">
                <input class="btnRadio" type="radio" id="masculino" name="sexo" value="M" required> Masculino
            </label>
            <label for="feminino">
                <input class="btnRadio" type="radio" id="feminino" name="sexo" value="F" required> Feminino
            </label>
            <br><br>
            <label for="fone">Fone:</label><br>
            <input class="inputText" type="text" name="fone" required>
            <br><br>
            <label for="email">Email:</label><br>
            <input class="inputText" type="email" name="email" required>
            <br><br>
            <label for="senha">Senha:</label><br>
            <input class="inputText" type="password" name="senha" required>
            <br><br>
            <input id="cad" type="submit" value="Adicionar">
            <button id="btnSair" onclick="location.href='lobby.php'">Voltar</button>
        </form>
    </div>
</body>

</html>