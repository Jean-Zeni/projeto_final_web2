<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
include_once './config/config.php';
include_once './classes/Noticia.php';

$noti = new Noticia($db);

if (isset($_GET['id'])) {
    $idNoti = $_GET['id'];
    $noti->deletarNoti($idNoti);
    header('Location: gerenciarNoticias.php');
    exit();
}
?>
