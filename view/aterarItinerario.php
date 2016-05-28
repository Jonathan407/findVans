<?php

#mostrar os dados do usuário
foreach ($empresas_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do usuario -->
            <label for="id_usuario">Código</label>
            <input class="form-control" name="dados[id_itinerario][]" type="text" readonly="true" id="id_itinerario" value="<?php echo $item_alterar[id_itinerario]; ?>" />
            <label for="rota">Rota</label>
            <input class="form-control" required type="text" name="dados[rota][]" id="rota" value="<?php echo $item_alterar[rota]; ?>"/>
            <label for="empresa">Empresa</label>
            <input class="form-control" required id="empresa" name="dados[empresa][]" type="text" value="<?php echo $item_alterar[empresa]; ?>" title="Digite a empresa" maxlength="58">
            <label for="origem">Origem</label>
            <input class="form-control" id="origem" name="dados[origem][]" type="text" value="<?php echo $item_alterar[origem]; ?>" title="Digite a origem do usuário" maxlength="24">
            <label for="destino">Destino</label>
            <input class="form-control" id="destino" name="dados[destino][]" type="text" value="<?php echo $item_alterar[destino]; ?>" title="Digite o destino do usuário" maxlength="24">
            </br>
            <!-- input oculto para informar o id do usuário-->
            <input type="hidden" name="dados[id_itinerario][]" value="<?php echo $item_alterar[id_itinerario]; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>
