<?php

foreach ($veiculo_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="veiculo" name="veiculo" method="post" action="">
            <!-- dados do usuário -->
            <label for="codigo" class="control-label">Código</label>
            <input type="text" class="form-control" placeholder="código" name="dados[id_veiculo][]">
            <label for="responsavel" class="control-label">Empresa Resposável</label>
            <input type="text" class="form-control" placeholder="responsavel" name="dados[responsavel][]">
            <label for="marca" class="control-label">Marca</label>
            <input type="text" class="form-control" placeholder="marca" name="dados[marca][]">
            <label for="modelo" class="control-label">Modelo</label>
            <input type="text" class="form-control" placeholder="modelo" name="dados[modelo][]">
            <label for="categoria" class="control-label">Categoria</label>
            <input type="text" class="form-control" placeholder="categoria" name="dados[categoria][]">
            <label for="descricao" class="control-label">Descrição</label>
            <input type="text" class="form-control" placeholder="descricao" name="dados[descricao][]">
            <!-- input oculto para informar o id do veiculo-->
            <input type="hidden" name="dados[id_veiculo][]" value="<?php echo $item_excluir[id_veiculo]; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Excluir</button>
        </form>
    </fieldset>
<?php } ?>
