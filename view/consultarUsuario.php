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
$objce = new ControlUsuario;

#verfica o o botão 'consultar' foi acionado
if (isset($_POST["consultar"])) {
    #passa o id e nome para consultar
    $empresas = $objce->consultarUsuario($_POST["dados"]);
} else {
    #mostrar todos os usuários
    $usuarios = $objce->consultarUsuario($_POST["dados"]);
}

#verificar se o botão "alterar" foi acionado
if (isset($_POST["alterar"])) {
    #passa os novos dados do usuário para o controle realizar a alteração
    $objce->alterarUsuario($_POST["dados"]);
    #mostrar dados do usuários selecionado depois de alterado
    $usuarios = $objce->consultarUsuario(null);
}

#verificar se o botão "excluir" foi acionado
if (isset($_POST["excluir"])) {
    #passa o id do usuario para o controle realizar a exclusão
    $objce->excluirUsuario($_POST["dados"]);
}
?>

<html lang="pt-br">
    <?php
        #Cabeçalho
        $objce->header();
    ?>
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
                            <input type="text" class="form-control" placeholder="código" name="dados[id_usuario][]">
                            <label for="nome" class="control-label">Nome</label>
                            <input type="text" class="form-control" placeholder="nome" name="dados[nome][]">
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
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Senha</th>
                                    <th>Alterar</th>
                                    <th>Excluir</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        #foreach para listar os dados do usuario
                                        foreach ($usuarios as $item) {
                                            echo "<tr>";
                                            echo "<td> {$item[id_usuario]} </td>";
                                            echo "<td> {$item[nome]} </td>";
                                            echo "<td> {$item[email]} </td>";
                                            echo "<td> {$item[telefone]} </td>";
                                            echo "<td> {$item[senha]} </td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Alterar'><button class='btn btn-primary btn-xs' data-title='Alterar' data-toggle='modal' data-target='#alterar{$item[id_usuario]}'><span class='glyphicon glyphicon-pencil'></span></button></p></td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Excluir'><button class='btn btn-danger btn-xs' data-title='Delete' data-toggle='modal' data-target='#excluir{$item[id_usuario]}'><span class='glyphicon glyphicon-trash'></span></button></p></td>";
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
            foreach ($usuarios as $item) {
                ?>
                <!-- modal de alterar -->
                <div class="modal fade" id="alterar<?php echo $item[id_usuario] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Alterar Usuário</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #pegar o valor do id do usuário
                                $dados[id_usuario][0] = $item[id_usuario];

                                #método para selecionar o usuário desejado
                                $usuarios_alterar = $objce->consultarUsuario($dados);

                                #inclui a view alterar usuário
                                include './alterarUsuario.php';
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
            foreach ($usuarios as $item) {
                ?>
                <!-- modal de exluir -->
                <div class="modal fade" id="excluir<?php echo $item[id_usuario] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Excluir Usuário</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #pegar o valor do id do usuário
                                $dados[id_usuario][0] = $item[id_usuario];

                                #método para selecionar o usuário desejado
                                $usuarios_excluir = $objce->consultarUsuario($dados);
                                #inclui a view alterar usuário
                                include 'excluirUsuario.php';
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
