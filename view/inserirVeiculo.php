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
$objcc = new ControlVeiculo();


#verfica o o botão 'Inserir' foi acionado
if (isset($_POST["inserir"])) {
    #passa o array de dados para inserir o usuário
    $objcc->inserirVeiculo($_POST["dados"]);
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
            $objcc->menu();
            #$objcc->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Cadastrar Veiculo</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="responsavel">Empresa Responsável</label>
                            <input class="form-control" required type="text" name="dados[responsavel][]" id="responsavel" />
                            <label for="marca">Marca do Veiculo</label>
                            <input class="form-control" required id="marca" name="dados[marca][]" type="text"  title="Digite a marca do veiculo" maxlength="115">
                            <label for="modelo">Modelo do Veiculo</label>
                            <input class="form-control" id="modelo" name="dados[modelo][]" type="text"  title="Digite o modelo do veiculo" maxlength="115">
                            <label for="categoria">Categoria do Veiculo</label>
                            <input class="form-control" id="categoria" name="dados[categoria][]" type="text"  title="Digite a categoria do veiculo" maxlength="120">
                             <label for="descricao">Descrição do Veiculo</label>
                             <input class="form-control" id="descricao" name="dados[descricao][]" type="text"  title="Digite a descrição do veiculo" maxlength="130">
                            </br>
                            <button type="submit" name="inserir" class="btn btn-danger" style="width: 100%;"><span class="glyphicon bg-success"></span> Inserir </button>
                        </div>
                    </form>
                </fieldset> 
            </div>
    </body>
</html>
