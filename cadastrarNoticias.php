<?php
include_once './config/config.php';
include_once './classes/Noticia.php';

include_once './classes/Usuario.php';

session_start();

try {
    $usuario = new Usuario($db);
    $usuarios = $usuario->listartodos();
} catch (Exception $e) {
    die("Erro:" . $e->getMessage());
}

// $noticia = new Noticia($db);
// $dadosNoticia = $noticia->ler('data_noticia');
// $fkIdAutor = $dados_usuario['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noticiaNova = new Noticia($db);
    $tituloNoticia = $_POST['tituloNoticia'];
    // $fkIdAutor = $_POST['autor'];

    date_default_timezone_set('America/Sao_Paulo');

    $data = date('Y-m-d H:i:s');

    $dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
    $fkIdAutor = $dados_usuario['id'];

    $noticia = $_POST['noticia'];
    $foto = $_FILES['foto'];

    // Validações do upload da imagem
    $nomeImagem = "";
    if ($foto['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
        $tamanhoMaximo = 10 * 1024 * 1024; // 10 MB

        // Validar tipo de arquivo
        $tiposPermitidos = ['jpg', 'jpeg', 'png'];
        if (!in_array($extensao, $tiposPermitidos)) {
            die("Apenas arquivos JPG, JPEG ou PNG são permitidos.");
        }

        // Validar tamanho do arquivo
        if ($foto['size'] > $tamanhoMaximo) {
            die("O tamanho do arquivo não pode exceder 10 MB.");
        }

        // Gerar nome único para o arquivo
        $nomeImagem = uniqid() . "." . $extensao;
        $destino = "uploads/" . $nomeImagem;

        // Mover o arquivo para o diretório
        if (!move_uploaded_file($foto['tmp_name'], $destino)) {
            die("Erro ao salvar a imagem.");
        }
    } else if ($foto['error'] !== UPLOAD_ERR_NO_FILE) {
        die("Erro ao fazer upload da imagem.");
    }

    $noticiaNova->criar($tituloNoticia, $fkIdAutor, $data, $noticia, $destino);
    echo "Salvo com sucesso!!!";
    header('Location: cadastrarNoticias.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Notícia</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="telaCadNoti">

    <div class="container">
        <h1>Publicar Nova Notícia</h1>
        <form method="POST" action="cadastrarNoticias.php" enctype="multipart/form-data">

            <label for="tituloNoticia">Título:</label><br>
            <input type="text" name="tituloNoticia" id="tituloNoticia" required>
            <br><br>

            <label for="noticia">Notícia:</label><br>
            <textArea id="noti" name="noticia" rows="5" cols="15" required></textArea><br><br>

            <input id="escolherImg" type="file" name="foto" accept=".jpg, .png, .jpeg"><br>

            <input id="publicar" type="submit" value="Publicar">

            <button id="btnSair" onclick="location.href='lobby.php'">Voltar</button>

        </form>

    </div>
</body>

</html>