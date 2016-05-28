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
 * Classe de controle da itinerario
 * @author Jonathan Rodrigues (jonathan407@gmail.com)
 * @version 1.0.0
 */
class controlItinerario extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos itinerario cadastrados e invocar o método consultaritinerario no model
     * @access public 
     * @param Int $id id do itinerario
     * @param String $nome nome do itinerario
     * @return Array dados do itinerario
     */
    function consultarItinerario($dados) {

        #extração de dados do itinerario
        $rota = $dados[rota][0];
        $id_itinerario = $dados[id_itinerario][0];
        $objItinerario = new modelItinerario();
        return $listaItinerario = $objItinerario->consultarItinerario($id_itinerario, $rota);
    }

    /**
     * Método utilizado validar os dados dos itinerario cadastrados e invocar o método inseriritinerario no model
     * @access public 
     * @param Array $dados com os dados do itinerario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirItinerario($dados) {
        echo 'inserirItinerario';
        #extração de dados do itinerario
        $rota = $dados[rota][0];
        $empresa = $dados[empresa][0];
        $origem = $dados[origem][0];
        $destino = $dados[destino][0];
//         echo " <script type='text/javascript'>
//	alert('Inserido com Sucesso!');
//	window.location='contato.html';d
//</script>";
        #invocar métódo  e passar parâmetros
        $objItinerario = new modelItinerario();

        #tratar a data de nascimento
      //  $dtNascimento = $this->dataAmericano($dtNascimento);

        #se for válido invocar o método de iserir
        if ($objItinerario->inserirItinerario($rota, $empresa, $origem, $endereco) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=itinerario&menu=consultar");
            echo 'Inserido com sucesso!';
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
           // header("location: ../view/modulo.php?modulo=itinerario&menu=consultar");
            echo 'Erro ao inserir!';
        }
    }

    /**
     * Método utilizado validar os dados dos itinerario e invocar o método alterarItinerario no model
     * @access public 
     * @param Int $id id do itinerario
     * @param String $nome nome do itinerario
     * @param String $email E-mail do itinerario
     * @param String $telefone telefone do itinerario
     * @param String $senha do itinerario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarItinerario($dados) {
        #extração de dados do itinerario
        $id_itinerario = $dados[id_itinerario][0];
        $rota = $dados[rota][0];
        $empresa = $dados[empresa][0];
        $origem = $dados[origem][0];
        $endereco = $dados[endereco][0];
        

        #invocar métódo  e passar parâmetros
        $objItinerario = new modelItinerario();
        if ($objItinerario->alterarItinerario($id_itinerario, $rota, $empresa, $origem, $endereco) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            echo 'Alterado com sucesso!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=itinerario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            echo 'Erro ao alterar!';
            #redirecionar
            header("location: ../view/modulo.php?modulo=itinerario&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos Itinerario e invocar o método excluirItinerario no model
     * @access public 
     * @param Int $id id do Itinerario
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirItinerario($dados) {

        #extração de dados do itinerario
        $id = $dados[id_itinerario][0];
        
        #invocar métódo  e passar parâmetros
        $objItinerario = new modelItinerario();

        #invocar métódo  e passar parâmetros
        if ($objItinerario->excluirItinerario($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=itinerario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=itinerario&menu=consultar");
        }
    }

}
