<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';
include_once './classes/Noticia.php';


// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

// INSTANCIAÇÃO DE OBJ
$notiDb = new Noticia($db);
$usuario = new Usuario($db);



// Obter dados das notícias
$dadosNoticias = $notiDb->ler();
$usuarioDb = $usuario->ler();


// Processar exclusão de noticia
if (isset($_GET['deletarNoti'])) {
    $idNoti = $_GET['deletarNoti'];
    $notiDb->deletarNoti($idNoti);
    header('Location: gerenciarNoticias.php');
    exit();
}
// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];


// Função para determinar a saudação
function saudacao()
{
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } elseif ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Notícias</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="gerNoti">
    <h1><?php echo saudacao() . ", " . $nome_usuario; ?>!</h1>
    <!-- <a href="registrar.php">Adicionar Usuário</a> -->
    
    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Data da Notícia</th>
            <th>Conteúdo</th>
            <th>Imagem</th>
        </tr>
        <?php while ($row = $dadosNoticias->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $row['pk_id_noticia']; ?></td>
                <td><?php echo $row['titulo_noticia']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['data_noticia']; ?></td>
                <td><?php echo $row['noticia']; ?></td>
                <td><?php echo $row['foto']; ?></td>
                <td>
                    <a href="editarNoti.php?id=<?php echo $row['pk_id_noticia']; ?>">Editar</a>
                    <a href="deletarNoti.php?id=<?php echo $row['pk_id_noticia']; ?>">Deletar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <button id="btnSair" onclick="location.href='lobby.php'">Sair</button>
</body>

</html> 