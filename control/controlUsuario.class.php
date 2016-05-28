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
 * Classe de controle do usuário
 * @author Jonathan Rodrigues (jonathan407@gmail.com)
 * @version 1.0.0
 */
class ControlUsuario extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos usuário cadastrados e invocar o método consultarUsuario no model
     * @access public 
     * @param Int $id id do usuário
     * @param String $nome nome do usuário
     * @return Array dados do usuário
     */
    function consultarUsuario($dados) {

        #extração de dados do usuário
        $nome = $dados[nome][0];
        $id = $dados[id_usuario][0];
        $objUsuario = new modelUsuario();
        return $listaUsuario = $objUsuario->consultarUsuario($id, $nome);
    }

    /**
     * Método utilizado validar os dados dos usuários cadastrados e invocar o método inserirUsuario no model
     * @access public 
     * @param Array $dados com os dados do usuário
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirUsuario($dados) {
        echo 'InserirUsuario';
        #extração de dados do usuário
        $nome = $dados[nome][0];
        $email = $dados[email][0];
        $telefone = $dados[telefone][0];
        $senha = $dados[senha][0];
//         echo " <script type='text/javascript'>
//	alert('Inserido com Sucesso!');
//	window.location='contato.html';
//</script>";
        #invocar métódo  e passar parâmetros
        $objUsuario = new modelUsuario();

        #tratar a data de nascimento
        //  $dtNascimento = $this->dataAmericano($dtNascimento);
        #se for válido invocar o método de iserir
        if ($objUsuario->inserirUsuario($nome, $email, $telefone, $senha) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        }
    }

    /**
     * Método utilizado validar os dados dos usuários e invocar o método alterarUsuario no model
     * @access public 
     * @param Int $id id do usuário
     * @param String $nome nome do usuário
     * @param String $email E-mail do usuário
     * @param String $telefone telefone do usuário
     * @param String $senha do usuário
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarUsuario($dados) {
        #extração de dados do usuário
        $id_usuario = $dados[id_usuario][0];
        $nome = $dados[nome][0];
        $email = $dados[email][0];
        $telefone = $dados[telefone][0];
        $senha = $dados[senha][0];


        #invocar métódo  e passar parâmetros
        $objUsuario = new modelUsuario();
        if ($objUsuario->alterarUsuario($id_usuario, $nome, $email, $telefone, $senha) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            echo 'Alterado com sucesso!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            echo 'Erro ao alterar!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos usuários e invocar o método excluirUsuário no model
     * @access public 
     * @param Int $id id do usuário
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirUsuario($dados) {

        #extração de dados do usuário
        $id = $dados[id_usuario][0];

        #invocar métódo  e passar parâmetros
        $objUsuario = new modelUsuario();

        #invocar métódo  e passar parâmetros
        if ($objUsuario->excluirUsuario($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        }
    }

}
