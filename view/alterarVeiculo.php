<?php

#mostrar os dados do usuário
foreach ($veiculo_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do local -->
            <label for="id_usuario">Código</label>
            <input class="form-control" name="dados[id_veiculo][]" type="text" readonly="true" id="id_veiculo" value="<?php echo $item_alterar[id_veiculo]; ?>"
            <label for="empresa">Empresa</label>
            <input class="form-control" required id="empresa" name="dados[empresa][]" type="text" value="<?php echo $item_alterar[empresa]; ?>" title="Qual a emrpesa reponsável pelo veiculo" maxlength="40">
            <label for="marca">Marca do Veiculo</label>
            <input class="form-control" id="marca" name="dados[marca][]" type="text" value="<?php echo $item_alterar[marca]; ?>" title="Qual a marca do veiculo" maxlength="40">
            <label for="modelo">Modelo do Veiculo</label>
            <input class="form-control" id="modelo" name="dados[modelo][]" type="text" value="<?php echo $item_alterar[modelo]; ?>" title="Qual o modelo do veiculo" maxlength="40">
            <label for="categoria">Categoria do Veiculo</label>
            <input class="form-control" id="categoria" name="dados[categoria][]" type="text" value="<?php echo $item_alterar[categoria]; ?>" title="Qual a categoria do veiculo" maxlength="40">
            <label for="descricao">Descrição</label>
            <input class="form-control" id="descricao" name="dados[descricao][]" type="text" value="<?php echo $item_alterar[descricao]; ?>" title="Descrição do veiculo" maxlength="40">
            </br>
            <!-- input oculto para informar o id do usuário-->
            <input type="hidden" name="dados[id_local][]" value="<?php echo $item_alterar[id_local]; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>