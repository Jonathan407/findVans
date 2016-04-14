<?php
#mostrar os dados da empresa
foreach ($empresas_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="empresa" name="empresa" method="post" action="">
            <!-- dados da empresa -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir[id_empresa]; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control"required type="text" readonly="true" name="nome" id="nome" value="<?php echo $item_excluir[nome]; ?>"/>
            <label for="cnpj">Cnpj</label>
            <input class="form-control"required id="cnpj" readonly="true" name="cnpj" type="text" value="<?php echo $item_excluir[cnpj]; ?>" title="Qual seu CNPJ?" maxlength="20" >
            <label for="cpf">Email</label>
            <input class="form-control"required id="email" readonly="true" name="email" type="text" value="<?php echo $item_excluir[email]; ?>" title="Qual seu E-mail?" maxlength="89" >
            <label for="dtNascimento">Telefone</label>
            <input class="form-control"required id="telefone" readonly="true" name="telefone" value="<?php echo $item_excluir[telefone]; ?>" type="date" title="Digite seu telefone: " maxlength="14">
            <label for="endereco">Endereço</label>
            <input class="form-control"required id="endereco" readonly="true" name="endereco" value="<?php echo $item_excluir[endereco]; ?>" type="date" title="Digite seu Endereço: " maxlength="200">
            
          
            <!-- input oculto para informar o id da empresa-->
            <input type="hidden" name="dados[id_empresa][]" value="<?php echo $item_excluir[id_empresa]; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Excluir</button>
        </form>
    </fieldset>
<?php } ?>
