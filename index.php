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
<body id="indexProjeto">
    
    <header>
        <h1 id="title">Portal de Notícias</h1>

        <button id="btnLogin" onclick="location.href='./login.php'">Login</button>

        <img id="imgProjeto" src="./imgsProjeto/treenoticias.png" alt="logo">
    </header>

    <main>

<!--========================================================================================= -->

<?php while ($row = $dadosNoticia->fetch(PDO::FETCH_ASSOC)) : ?>

    <?php
        $dataOriginal = $row['data_noticia'];
        
        $dataFormatada = DateTime::createFromFormat('Y-m-d H:i:s', $dataOriginal);
    ?>

    <!-- AQUI FICARÃO OS CARDS DE NOTÍCIAS -->
        <div id="cardNoticia">
            <!-- IMG NOTICIA -->
            <img id="imgNoticia" src="<?php echo $row['foto']?>" alt="Imagem da notícia"> 

            <!-- TITLE NOTICIA -->
            <p id="conteudoCard"><?php echo $row['titulo_noticia'] . "<br><br>";

            echo $row['noticia'] . "<br><br>";

            echo "Autor: <strong>" . $row['nome'] . "</strong><br><br>Data de Publicação: " . $dataFormatada->format('d/m/Y H:i:s'); ?></p>
        </div>

        <?php endwhile; ?>

<!-- ======================================================================================== -->
    </main>


    <footer id="rodape">

        <!-- PARA COLOCAR AS IMAGENS DO RODAPÉ -->

        <h4>Siga-nos em nossas redes sociais</h4>

        <a href="https://github.com/Jean-Zeni"><img src="./imgsProjeto/github48px.png" alt=""></a>

        <a href=""><img src="./imgsProjeto/fb48px.png" alt=""></a>

        <a href=""><img src="./imgsProjeto/insta48px.png" alt=""></a>

    </footer>

</body>
</html>