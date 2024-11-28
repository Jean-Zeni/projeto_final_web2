<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';


$usuario = new Usuario($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Processar login
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if ($dados_usuario = $usuario->login($email, $senha)) {
            $_SESSION['usuario_id'] = $dados_usuario['id'];
            header('Location: lobby.php');
            // ANTIGO REDIRECIONAMENTO gerenciador.php
            exit();
        } else {
            $mensagem_erro = "Credenciais inválidas!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="telaLogin">

<div class="container">


<div class="box">
    <h1>Login</h1>

    <form method="POST">
        <label for="email">Email:</label><br>
        <input class="campoTexto" type="email" name="email">
        <br><br>
        <label for="senha">Senha:</label><br>
        <input class="campoTexto" type="password" name="senha">
        <br><br>
        <input id="btnLogin" type="submit" name="login" value="Login">
    </form>
    <button id="btnSair" onclick="location:href='index.php'">Voltar</button>
    <!-- botao de cima nao funciona -->

</div>

    
</body>
</html>