<?php

include_once './config/config.php';
include_once './classes/Noticia.php';
include_once './classes/Usuario.php';

$noticiasBanco = new Noticia($db);
$usuarioBanco = new Usuario($db);


$dadosNoticia = $noticiasBanco->ler();
$dadosUsuario = $usuarioBanco->ler();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header>
        <h1>Portal de Notícias</h1>

        <a href="./login.php">Login</a>

        <img src="" alt="a">
    </header>

    <main>

<!--========================================================================================= -->

<?php while ($row = $dadosNoticia->fetch(PDO::FETCH_ASSOC)) : ?>

    <!-- AQUI FICARÃO OS CARDS DE NOTÍCIAS -->
        <div id="cardNoticia">
            <!-- IMG NOTICIA -->
            <img id="imgNoticia" src="<?php echo $row['foto']?>" alt="Imagem da notícia"> 

            <!-- TITLE NOTICIA -->
            <p id="titleNoticia"><?php echo $row['titulo_noticia']?></p>

            <!-- NOTICIA -->
            <p><?php echo $row['noticia']?></p>

            <!-- AUTOR DA NOTICIA -->
             <p id="autorNoticia"><?php echo $row['nome']?></p>
        </div>

        <?php endwhile; ?>

<!-- ======================================================================================== -->
    </main>


    <footer>

        <!-- PARA COLOCAR AS IMAGENS DO RODAPÉ -->
        <a href=""><img src="" alt=""></a>

    </footer>

</body>
</html>