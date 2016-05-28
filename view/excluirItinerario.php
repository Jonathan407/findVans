<?php
#mostrar os dados da empresa
foreach ($empresas_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="itinerario" name="itinerario" method="post" action="">
            <!-- dados do usuário -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir[id_empresa]; ?>" />
            <label for="rota">Rota</label>
            <input class="form-control"required type="text" readonly="true" name="nome" id="rota" value="<?php echo $item_excluir[rota]; ?>"/>
            <label for="empresa">Empresa</label>
            <input class="form-control"required id="empresa" readonly="true" name="empresa" type="text" value="<?php echo $item_excluir[empresa]; ?>" title="Qual a empresa?" maxlength="20" >
            <label for="destino">Destino</label>
            <input class="form-control"required id="destino" readonly="true" name="destino" type="text" value="<?php echo $item_excluir[destino]; ?>" title="Qual o destino?" maxlength="89" >
            <label for="origem">Origem</label>
            <input class="form-control"required id="origem" readonly="true" name="origem" value="<?php echo $item_excluir[origem]; ?>" type="date" title="Digite origem: " maxlength="14">
                      
            <!-- input oculto para informar o id do usuário-->
            <input type="hidden" name="dados[id_itinerario][]" value="<?php echo $item_excluir[id_itinerario]; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Excluir</button>
        </form>
    </fieldset>
<?php } ?>
