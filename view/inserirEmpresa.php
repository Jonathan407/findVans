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
$objcc = new ControlEmpresa();


#verfica o o botão 'Inserir' foi acionado
if (isset($_POST["inserir"])) {
    #passa o array de dados para inserir o usuário
    $objcc->inserirEmpresa($_POST["dados"]);
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
                    <legend>Cadastrar Empresa</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" required type="text" name="dados[nome][]" id="nome" />
                            <label for="cnpj">Cnpj</label>
                            <input class="form-control" required id="cnpj" name="dados[cnpj][]" type="text" title="Digite seu CNPJ"/>
                            <label for="cpf">E-mail</label>
                            <input class="form-control" required id="cpf" name="dados[email][]" type="text"  title="Digite seu E-mail" maxlength="58" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            <label for="telefone">Telefone</label>
                            <input class="form-control" id="telefone" name="dados[telefone][]" type="text"  title="Digite seu telefone" maxlength="14">
                            <label for="endereco">Endereco</label>
                            <input class="form-control" id="endereco" name="dados[endereco][]" type="text"  title="Digite sua Endereço" maxlength="180">
                            </br>
                            <button type="submit" name="inserir" class="btn btn-danger" style="width: 100%;"><span class="glyphicon bg-success"></span>Inserir</button>
                        </div>
                    </form>
                </fieldset> 
            </div>
    </body>
</html>
