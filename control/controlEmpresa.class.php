<?php
#iniciar_sessao
//session_start();

#carregar as classes dinamicamente
include_once 'autoload.php';

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 01/01/2015
 * Classe de controle da empresa
 * @author Jonathan Rodrigues (jonathan407@gmail.com)
 * @version 1.0.0
 */
class ControlEmpresa extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos empresa cadastrados e invocar o método consultarEmpresa no model
     * @access public 
     * @param Int $id id do empresa
     * @param String $nome nome do empresa
     * @return Array dados do empresa
     */
    function consultarEmpresa($dados) {

        #extração de dados do empresa
        $nome = $dados[nome][0];
        $id = $dados[id_empresa][0];
        $objEmpresa = new modelEmpresa();
        return $listaEmpresa = $objEmpresa->consultarEmpresa($id, $nome);
    }
    
    function consultarEmpresas($id, $nome) {

        $objEmpresa = new modelEmpresa();
        return $listaEmpresa = $objEmpresa->consultarEmpresa($id, $nome);
    }

    /**
     * Método utilizado validar os dados dos empresa cadastrados e invocar o método inserirEmpresa no model
     * @access public 
     * @param Array $dados com os dados do empresa
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirEmpresa($dados) {
        echo 'InserirEmpresa';
        #extração de dados do empresa
        $nome = $dados[nome][0];
        $cnpj = $dados[cnpj][0];
        $email = $dados[email][0];
        $telefone = $dados[telefone][0];
        $endereco = $dados[endereco][0];
//         echo " <script type='text/javascript'>
//	alert('Inserido com Sucesso!');
//	window.location='contato.html';
//</script>";
        #invocar métódo  e passar parâmetros
        $objEmpresa = new modelEmpresa();

        #tratar a data de nascimento
      //  $dtNascimento = $this->dataAmericano($dtNascimento);

        #se for válido invocar o método de iserir
        if ($objEmpresa->inserirEmpresa($nome, $cnpj, $email, $telefone, $endereco) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=empresa&menu=consultar");
            echo 'Inserido com sucesso!';
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
           // header("location: ../view/modulo.php?modulo=empresa&menu=consultar");
            echo 'Erro ao inserir!';
        }
    }

    /**
     * Método utilizado validar os dados dos empresas e invocar o método alterarEmpresa no model
     * @access public 
     * @param Int $id id do empresa
     * @param String $nome nome do empresa
     * @param String $email E-mail do empresa
     * @param String $telefone telefone do empresa
     * @param String $empresa do empresa
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarEmpresa($dados) {
        #extração de dados do empresa
        $id_empresa = $dados[id_empresa][0];
        $nome = $dados[nome][0];
        $cnpj = $dados[cnpj][0];
        $email = $dados[email][0];
        $telefone = $dados[telefone][0];
        $endereco = $dados[endereco][0];
        

        #invocar métódo  e passar parâmetros
        $objEmpresa = new modelEmpresa();
        if ($objEmpresa->alterarEmpresa($id_empresa, $nome, $cnpj, $email, $telefone, $endereco) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            echo 'Alterado com sucesso!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=empresa&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            echo 'Erro ao alterar!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=empresa&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos empresas e invocar o método excluirEmpresa no model
     * @access public 
     * @param Int $id id do empresa
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirEmpresa($dados) {
       
        #extração de dados do empresa
        $id = $dados[id_empresa][0];
     
        #invocar métódo  e passar parâmetros
        $objEmpresa = new modelEmpresa();

        #invocar métódo  e passar parâmetros
        if ($objEmpresa->excluirEmpresa($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=empresa&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=empresa&menu=consultar");
        }
    }

}
