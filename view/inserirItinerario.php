<?php
#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#carrega as classes automaticamente
include_once 'autoload.php';

#cria o objeto de controle
$objci = new controlItinerario();


#verfica o o botão 'Inserir' foi acionado
if (isset($_POST["inserir"])) {
    #passa o array de dados para inserir o usuário
    $objci->inserirItinerario($_POST["dados"]);
}
?>

<html lang="pt-br">
    <head>
        <!-- define a codificação do HTML -->
        <meta charset="utf-8">

        <!-- define a o titulo do HMTL -->
        <title>Sistema Find Vans</title>

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
            $objci->menu();
            #$objci->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Cadastrar Itinerario</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="rota">Rota</label>
                            <input class="form-control" required id="rota" name="dados[rota][]" type="text"  title="Digite a rota" maxlength="40">
                            <label for="empresa">Empresa</label>
                            <input class="form-control" id="empresa" name="dados[empresa][]" type="text"  title="Digite a empresa" maxlength="40">
                            <label for="origem">Origem</label>
                            <input class="form-control" id="origem" name="dados[origem][]" type="text"  title="Digite a Origem" maxlength="40">
                            <label for="destino">Destino</label>
                            <input class="form-control" id="destino" name="dados[destino][]" type="text"  title="Digite o distino" maxlength="40">
                            </br>
                            <button type="submit" name="inserir" class="btn btn-danger" style="width: 100%;"><span class="glyphicon bg-success"></span>Inserir</button>
                        </div>
                    </form>
                </fieldset> 
            </div>
        </div>
    </body>
</html>
