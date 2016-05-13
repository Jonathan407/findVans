<?php

#mostrar os dados do usuário
foreach ($local_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do local -->
            <label for="id_usuario">Código</label>
            <input class="form-control" name="dados[id_local][]" type="text" readonly="true" id="id_local" value="<?php echo $item_alterar[id_local]; ?>"
            <label for="endereco">Endereço de Destino</label>
            <input class="form-control" required id="endereco" name="dados[endereco][]" type="text" value="<?php echo $item_alterar[endereco]; ?>" title="Qual a Origem" maxlength="40">
            <label for="end.destino">Endereço de Origem</label>
            <input class="form-control" id="origem" name="dados[origem][]" type="text" value="<?php echo $item_alterar[origem]; ?>" title="Qual o Destino" maxlength="40">
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