<?php
#mostrar os dados da local
foreach ($Local_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="local" name="local" method="post" action="">
            <!-- dados do usuário -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir[id_local]; ?>" />
            <label for="nome">Endereço de Origem</label>
            <input class="form-control"required type="text" readonly="true" name="origem" id="origem" value="<?php echo $item_excluir[end.origem]; ?>" title="Qual a Origem" maxlength="40"/>
            <label for="cnpj">Endereço de Destino</label>
            <input class="form-control"required id="endereco" readonly="true" name="endereco" type="text" value="<?php echo $item_excluir[endereco]; ?>" title="Qual o Destino?" maxlength="40" />
            
          
            <!-- input oculto para informar o id do local-->
            <input type="hidden" name="dados[id_local][]" value="<?php echo $item_excluir[id_local]; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Excluir</button>
        </form>
    </fieldset>
<?php } ?>
