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
$objce = new ControlVeiculo();

#verfica o o botão 'consultar' foi acionado
if (isset($_POST["consultar"])) {
    #passa o id e nome para consultar
    $veiculo = $objce->consultarVeiculo($_POST["dados"]);
} else {
    #mostrar todos os usuários
    $veiculo = $objce->consultarVeiculo($_POST["dados"]);
}

#verificar se o botão "alterar" foi acionado
if (isset($_POST["alterar"])) {
    #passa os novos dados do usuário para o controle realizar a alteração
    $objce->alterarVeiculo($_POST["dados"]);
    #mostrar dados do usuários selecionado depois de alterado
    $veiculo = $objce->consultarVeiculo(null);
}

#verificar se o botão "excluir" foi acionado
if (isset($_POST["excluir"])) {
    #passa o id do veiculo para o controle realizar a exclusão
    $objce->excluirVeiculo($_POST["dados"]);
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
        <script src="http://maps.googleapis.com/maps/api/js"></script>

        <div class="container">
            <!-- inserir o menu -->
            <?php
            #mostrar o menu para o ator
            $objce->menu();

            #mostra  as mensagens para o ator
            $objce->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Dados da Consulta</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="codigo" class="control-label">Código</label>
                            <input type="text" class="form-control" placeholder="código" name="dados[id_veiculo][]">
                            <label for="id_empresa" class="control-label">Empresa Resposável</label>
                            <input type="text" class="form-control" placeholder="responsavel" name="dados[responsavel][]">
                            <label for="marca" class="control-label">Marca</label>
                            <input type="text" class="form-control" placeholder="marca" name="dados[marca][]">
                            <label for="modelo" class="control-label">Modelo</label>
                            <input type="text" class="form-control" placeholder="modelo" name="dados[modelo][]">
                            <label for="categoria" class="control-label">Categoria</label>
                            <input type="text" class="form-control" placeholder="categoria" name="dados[categoria][]">
                            <label for="descricao" class="control-label">Descrição</label>
                            <input type="text" class="form-control" placeholder="descricao" name="dados[descricao][]">
                        </div>
                        <button type="submit" class="btn btn-primary" name="consultar" style="width: 100%;">Consultar</button>
                    </form>
                </fieldset> 
            </div>

            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                    <th>Código</th>
                                    <th>Empresa Responsável</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Catrgoria</th>
                                    <th>Descrição</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        #foreach para listar os dados do veiculo
                                        foreach ($veiculo as $item) {
                                            echo "<tr>";
                                            echo "<td> {$item[id_veiculo]} </td>";
                                            echo "<td> {$item[marca]} </td>";
                                            echo "<td> {$item[modelo]} </td>";
                                            echo "<td> {$item[categoria]} </td>";
                                            echo "<td> {$item[descricao]} </td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Alterar'><button class='btn btn-primary btn-xs' data-title='Alterar' data-toggle='modal' data-target='#alterar{$item[id_veiculo]}'><span class='glyphicon glyphicon-pencil'></span></button></p></td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Excluir'><button class='btn btn-danger btn-xs' data-title='Delete' data-toggle='modal' data-target='#excluir{$item[id_veiculo]}'><span class='glyphicon glyphicon-trash'></span></button></p></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            #foreach para listar os dados do usuário e definica cada modal para alterar
            foreach ($veiculo as $item) {
                ?>
                <!-- modal de alterar -->
                <div class="modal fade" id="alterar<?php echo $item[id_veiculo] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Alterar Veiculo</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #pegar o valor do id do veiculo
                                $dados[id_veiculo][0] = $item[id_veiculo];

                                #método para selecionar o veiculo desejado
                                $veiculo_alterar = $objce->consultarVeiculo($dados);

                                #inclui a view alterar veiuculo
                                include './alterarVeiculo.php';
                                ?>       

                            </div>
                        </div>
                    </div>
                </div> 
                <?php
            }
            ?>

            <?php
            #foreach para listar os dados do usuário e definica cada modal para alterar
            foreach ($veiculo as $item) {
                ?>
                <!-- modal de exluir -->
                <div class="modal fade" id="excluir<?php echo $item[id_veiculo] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Excluir Veiculo</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #pegar o valor do id do usuário
                                $dados[id_veiculo][0] = $item[id_veiculo];

                                #método para selecionar o usuário desejado
                                $veiculo_excluir = $objce->consultarVeiculo($dados);
                                #inclui a view alterar usuário
                                include 'excluirVeiculo.php';
                                ?>       
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?> 

            <!-- Script -->
            <script>
                $(document).ready(function () {
                    $("#mytable #checkall").click(function () {
                        if ($("#mytable #checkall").is(':checked')) {
                            $("#mytable input[type=checkbox]").each(function () {
                                $(this).prop("checked", true);
                            });

                        } else {
                            $("#mytable input[type=checkbox]").each(function () {
                                $(this).prop("checked", false);
                            });
                        }
                    });

                    $("[data-toggle=tooltip]").tooltip();
                });
            </script>
    </body>
</html>
