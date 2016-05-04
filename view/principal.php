<?php
#iniciar_sessao
session_start();

#carrega as classes automaticamente
include_once 'autoload.php';

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#cria o objeto de controle
$objcg = new ControlGeral();
?>

<html lang="pt-br">
    <head>
        <!-- define a codificação do HTML -->
        <meta charset="utf-8">

        <!-- define a o titulo do HMTL -->
        <title>Find Vans</title>

        <!-- Link para o CSS do bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Link para o CSS do bootstrap (menu) -->
        <link href="../bootstrap/css/navbar.css" rel="stylesheet">

    </head>
    <body>

        <!-- Link para o JQuery do bootstrap -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>

        <div class="container">
            <!-- inserir o menu -->
            <?php
            #mostrar o menu
            $objcg->menu();
            ?> 
        </div>
    </body>
</html>
