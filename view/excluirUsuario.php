<?php
#mostrar os dados do usuário
foreach ($usuarios_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="usuario" name="usuario" method="post" action="">
            <!-- dados do usuário -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir[id_usuario]; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control"required type="text" readonly="true" name="nome" id="nome" value="<?php echo $item_excluir[nome]; ?>"/>
            <label for="cpf">Email</label>
            <input class="form-control"required id="email" readonly="true" name="email" type="text" value="<?php echo $item_excluir[email]; ?>" title="Qual seu E-mail?" maxlength="89" >
            <label for="dtNascimento">Telefone</label>
            <input class="form-control"required id="telefone" readonly="true" name="telefone" value="<?php echo $item_excluir[telefone]; ?>" type="date" title="Digite seu telefone: " maxlength="14">
          
            <!-- input oculto para informar o id do usuário-->
            <input type="hidden" name="dados[id_usuario][]" value="<?php echo $item_excluir[id_usuario]; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Excluir</button>
        </form>
    </fieldset>
<?php } ?>
