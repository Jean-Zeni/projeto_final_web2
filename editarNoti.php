<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
include_once './config/config.php';
include_once './classes/Noticia.php';
include_once './classes/Usuario.php';


$noti = new Noticia($db);
$usu = new Usuario($db);

try {
    $usuarios = $usu->listartodos();
} catch (Exception $e) {
    die("Erro:" . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['pk_id_noticia'];
    $fkId = $_POST['fk_id_autor'];
    $titulo = $_POST['titulo_noticia'];
    $autor = $_POST['nome'];
    $data = $_POST['data_noticia'];
    $noticia = $_POST['noticia'];
    $imagemNoti = $_FILES['foto'];
    $noti->atualizar($id, $titulo, $autor, $data, $noticia, $imagemNoti);
    header('Location: gerenciarNoticias.php');
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $noti->lerPorId($id);
}

if (isset($_GET['id'])) {
    $idUsu = $_GET['id'];
    $rowUsu = $usu->lerPorId($idUsu);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Notícia</title>
</head>

<body>
    <h1>Editar Notícia</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['pk_id_noticia']; ?>">
        <input type="hidden" name="fkId" value="<?php echo $row['fk_id_autor']; ?>">
        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" value="<?php echo $row['titulo_noticia']; ?>" required>
        <br><br>
        <label for="noticia">Noticia:</label><br>
        <textArea name="noticia" rows="5" cols="15" required><?php echo $row['noticia']?></textArea>
        <br><br>
        <label for="imagemNoti">Imagem:</label>
        <input type="file" name="imagemNoti" value="<?php echo $row['foto']?>" accept=".jpg, .png, .jpeg">
        <br><br>
        <input type="submit" value="Atualizar">
    </form>
</body>

</html>