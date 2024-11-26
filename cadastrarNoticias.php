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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noticiaNova = new Noticia($db);
    $tituloNoticia = $_POST['tituloNoticia'];
    $fkIdAutor = $_POST['autor'];
    $dataNoticia = $_POST['dataNoticia'];
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
             die("Apenas arquivos JPG ou PNG são permitidos.");
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

    $noticiaNova->criar( $tituloNoticia, $fkIdAutor, $dataNoticia, $noticia, $destino);
    echo"Salvo com sucesso!!!";
    header('Location: cadastrarNoticias.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Nova Notícia</title>
</head>

<body>

    <div class="container">
        <h1>Adicionar Usuário</h1>
        <form method="POST" action="cadastrarNoticias.php" enctype="multipart/form-data">

            <label for="tituloNoticia">Título:</label>
            <input type="text" name="tituloNoticia" id="tituloNoticia" required>
            <br>
            <label for="selectAutor">Selecionar autor:</label>
            <select name="autor" id="autor" required>
                <option value="">Seleção</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?php echo $usuario['id']; ?>">
                        <?php echo htmlspecialchars($usuario['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <label for="dataPublicacao">Data de publicação</label>
            <input type="date" name="dataNoticia" required><br>
            <textArea name="noticia" rows="5" cols="15" required></textArea><br>
            <input type="file" name="foto" accept=".jpg, .png, .jpeg"><br>
            <input type="submit" value="Publicar">

        </form>

    </div>
</body>

</html>