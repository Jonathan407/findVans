<?php

#mostrar os dados do usuário
foreach ($empresas_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do usuario -->
            <label for="id_usuario">Código</label>
            <input class="form-control" name="dados[id_usuario][]" type="text" readonly="true" id="id_usuario" value="<?php echo $item_alterar[id_usuario]; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control" required type="text" name="dados[nome][]" id="nome" value="<?php echo $item_alterar[nome]; ?>"/>
            <label for="email">E-mail</label>
            <input class="form-control" required id="email" name="dados[email][]" type="text" value="<?php echo $item_alterar[email]; ?>" title="Digite seu E-mail" maxlength="58">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" name="dados[telefone][]" type="text" value="<?php echo $item_alterar[telefone]; ?>" title="Digite seu telefone" maxlength="14">
            <label for="senha">Endereco</label>
            <input class="form-control" id="senha" name="dados[senha][]" type="text" value="<?php echo $item_alterar[senha]; ?>" title="Digite sua senha" maxlength="14">
            </br>
            <!-- input oculto para informar o id do usuário-->
            <input type="hidden" name="dados[id_usuario][]" value="<?php echo $item_alterar[id_usuario]; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>
