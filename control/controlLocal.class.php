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
 * Classe de controle da local
 * @author Jonathan Rodrigues (jonathan407@gmail.com)
 * @version 1.0.0
 */
class ControlLocal extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos local cadastrados e invocar o método consultarlocal no model
     * @access public 
     * @param Int $id id do local
     * @param String $nome nome do local
     * @return Array dados do local
     */
    function consultarLocal($dados) {

        #extração de dados do local
        $id = $dados[id_local][0];
        $origem = $dados[origem][0];
        $endereco = new modelLocal();
        return $local = $objLocal->consultarLocal($id);
    }

    /**
     * Método utilizado validar os dados dos local cadastrados e invocar o método inserirLocal no model
     * @access public 
     * @param Array $dados com os dados do local
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirLocal($dados) {
        echo 'InserirLocal';
        #extração de dados do local
        $endereco = $dados[endereco][0];
        $origem = $dados[origem][0];
        $id_local = $dados[id_local][0];
//         echo " <script type='text/javascript'>
//	alert('Inserido com Sucesso!');
//	window.location='contato.html';
//</script>";
        #invocar métódo  e passar parâmetros
        $objLocal = new modelLocal();

        #tratar a data de nascimento
      //  $dtNascimento = $this->dataAmericano($dtNascimento);

        #se for válido invocar o método de iserir
        if ($objLocal->inserirLocal($endereco, $origem, $id_local) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=local&menu=consultar");
            echo 'Inserido com sucesso!';
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
           // header("location: ../view/modulo.php?modulo=local&menu=consultar");
            echo 'Erro ao inserir!';
        }
    }

    /**
     * Método utilizado validar os dados dos local e invocar o método alterarLocal no model
     * @access public 
     * @param Int $id id do local
     * @param String $origem local de origem
     * @param String $endereco endereco do lugar
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarLocal($dados) {
        #extração de dados do local
        $id_local = $dados[id_local][0];
        $endereco = $dados[endereco][0];
        $origem = $dados[origem][0];
        
        #invocar métódo  e passar parâmetros
        $objLocal = new modelLocal();
        if ($objLocal->alterarLocal($id_local, $endereco, $origem) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            echo 'Alterado com sucesso!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=local&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            echo 'Erro ao alterar!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=local&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos local e invocar o método excluirLocal no model
     * @access public 
     * @param Int $dados id do local
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirLocal($dados) {

        #extração de dados do local
        $id = $dados[id_local][0];
        
        #invocar métódo  e passar parâmetros
        $objLocal = new modelLocal();

        #invocar métódo  e passar parâmetros
        if ($objLocal->excluirLocal($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=local&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=local&menu=consultar");
        }
    }

}
