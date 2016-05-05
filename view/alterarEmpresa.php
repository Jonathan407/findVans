<?php

#mostrar os dados do empresas
foreach ($empresas_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do empresa -->
            <label for="id_empresa">Código</label>
            <input class="form-control" name="dados[id_empresa][]" type="text" readonly="true" id="id_empresa" value="<?php echo $item_alterar[id_empresa]; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control" required type="text" name="dados[nome][]" id="nome" value="<?php echo $item_alterar[nome]; ?>"/>
            <label for="email">CNPJ</label>
            <input class="form-control" required id="cnpj" name="dados[cnpj][]" type="text" value="<?php echo $item_alterar[cnpj]; ?>" title="Digite seu CNPJ" maxlength="30">
            <label for="email">E-mail</label>
            <input class="form-control" required id="email" name="dados[email][]" type="text" value="<?php echo $item_alterar[email]; ?>" title="Digite seu E-mail" maxlength="58" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" name="dados[telefone][]" type="text" value="<?php echo $item_alterar[telefone]; ?>" title="Digite seu telefone" maxlength="14">
            <label for="senha">Endereco</label>
            <input class="form-control" id="endereco" name="dados[endereco][]" type="text" value="<?php echo $item_alterar[endereco]; ?>" title="Digite seu Endereço" maxlength="200">
            </br>
            <!-- input oculto para informar o id do usuário-->
            <input type="hidden" name="dados[id_empresa][]" value="<?php echo $item_alterar[id_empresa]; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>
