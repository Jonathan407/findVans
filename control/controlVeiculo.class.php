<?php
#iniciar_sessao
session_start();

#carregar as classes dinamicamente
include_once 'autoload.php';

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 01/01/2015
 * Classe de controle da veiculo
 * @author Jonathan Rodrigues (jonathan407@gmail.com)
 * @version 1.0.0
 */
class ControlVeiculo extends ControlGeral {

  
    function consultarVeiculo($dados) {

        #extração de dados do veiculo
        $nome = $dados[nome][0];
        $id = $dados[id_veiculo][0];
        $objVeiculo = new modelVeiculo();
        return $listaVeiculo = $objVeiculo->consultarVeiculo($id, $nome);
    }

    
    function inserirVeiculo($dados) {
        echo 'InserirVeiculo';
        
        $id_veiculo = $dados[id_veiculo][0];
        $id_empresa = $dados[id_empresa][0];
        $marca = $dados[marca][0];
        $modelo = $dados[modelo][0];
        $categoria = $dados[categoria][0];
        $descricao = $dados[descricao][0];
//         echo " <script type='text/javascript'>
//	alert('Inserido com Sucesso!');
//	window.location='contato.html';
//      </script>";
        #invocar métódo  e passar parâmetros
        $objVeiculo = new modelVeiculo();

        #tratar a data de nascimento
      //  $dtNascimento = $this->dataAmericano($dtNascimento);

        #se for válido invocar o método de iserir
        if ($objVeiculo->inserirVeiculo($id_veiculo, $id_empresa, $marca, $modelo, $categoria, $descricao) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
            echo 'Inserido com sucesso!';
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
           // header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
            echo 'Erro ao inserir!';
        }
    }

   
    function alterarVeiculo($dados) {
        #extração de dados do veiculo
        $id_veiculo = $dados[id_veiculo][0];
        $id_empresa = $dados[id_empresa][0];
        $marca = $dados[marca][0];
        $modelo = $dados[modelo][0];
        $categoria = $dados[categoria][0];
        $descricao = $dados[descricao][0];
        

        #invocar métódo  e passar parâmetros
        $objVeiculo = new modelVeiculo();
        if ($objVeiculo->alterarVeiculo($id_veiculo, $responsavel, $marca, $modelo, $categoria, $descricao) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            echo 'Alterado com sucesso!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            echo 'Erro ao alterar!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
        }
    }

    
    function excluirVeiculo($dados) {

        #extração de dados do veiculo
        $id = $dados[id_veicudlo][0];
        
        #invocar métódo  e passar parâmetros
        $objVeiculo = new modelVeiculo();

        #invocar métódo  e passar parâmetros
        if ($objVeiculo->excluirVeiculo($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
        }
    }

}
