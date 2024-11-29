<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticia.php';
include_once './classes/Usuario.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
$usuario = new Usuario($db);


function saudacao()
{
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } else if ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}


// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];

$dados = $usuario->ler();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="lobby">
    
<header>
    <h1>MENU</h1>
</header>

<h1><?php echo saudacao() . ", " . $nome_usuario . " o que deseja?"; ?></h1>

<main>
    <button onclick="location.href='cadastrarNoticias.php'"> Cadastrar Nova Noticia </button>
    <button onclick="location.href='cadastrarUsuario.php'"> Cadastrar Novo Usuario </button>
    <button onclick="location.href='gerenciarNoticias.php'"> Gerenciar Noticias </button>
    <button onclick="location.href='portalUsuarios.php'"> Gerenciar Usuarios </button>
    <button onclick="location.href='login.php'"> Voltar </button>
    <a id="btnLogout" href="logout.php">Fazer logout</a>
    
</main>

</body>
</html>