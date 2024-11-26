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
    <title>Adicionar Usuário</title>
</head>

<body>
    <h1>Adicionar Usuário</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <br><br>
        <label>Sexo:</label>
        <label for="masculino">
            <input type="radio" id="masculino" name="sexo" value="M" required> Masculino
        </label>
        <label for="feminino">
            <input type="radio" id="feminino" name="sexo" value="F" required> Feminino
        </label>
        <br><br>
        <label for="fone">Fone:</label>
        <input type="text" name="fone" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <br><br>
        <input type="submit" value="Adicionar">
    </form>
</body>

</html>