<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em 01/01/2015
 * Classe de CRUD com PDO para manter usuário
 * @author Jonathan Santos Rodrigues
 * @version 1.0.0
 */
class modelLocal extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $origem;
    private $endereco;

    /**
     * Métodos get e sets das classes
     */
    public function getId() {
        return $this->id;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getOrigem() {
        return $this->origem;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEndereco($endereco) {
        $this->nome = $endereco;
    }

    public function setOrigem($origem) {
        $this->email = $origem;
    }

    /**
     * método mágico para não permitir clonar a classe
     */
    public function __clone() { }

    /**
     * Método utilizado para consultar os usuários cadastrados
     * @access public 
     * @param Int $id id da empresa
     * @param String $nome nome da empresa
     * @return Array dados da empresa
     */
    public function consultarLocal($id_local, $origem, $endereco) {

        #setar valores
        $this->setId($id_local);
        $this->setEndereco($endereco);
        $this->setOrigem ($origem);

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_local where true";

        #verificar se foi passado algum valor de $id
        if ($this->getId() != null) {
            $sql.="and id_local = :id_local";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getEndereco() != null) {
            $sql.= " and nome LIKE :nome ";
        }

        #execulta a consulta e constroi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_local
            if ($this->getId() != null) {
                $query->bindValue(':id_empresa', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $endereco
            if ($this->getEndereco() != NULL) {
                $this->setEndereco("%" . $endereco . "%");
                $query->bindValue(':nome', $this->getEndereco(), PDO::PARAM_STR);
            }
           
            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

     /**
     * Método utilizado para inserir um usuário
     * @access public 
     * @param String $endereco endereço do local
     * @param String $origem local de origem
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirLocal($endereco, $origem) {

        #setar os dados
        $this->setEndereco($endereco);
        $this->setOrigem($origem);
        
        #montar a consulta
        $sql = "INSERT INTO tb_local (id_local, endereco, origem) "
                . "VALUES (null,:endereco,:origem)";
        
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $query->bindValue(':origem', $this->getOrigem(), PDO::PARAM_STR);
            $query->execute();
            return true;
            echo 'Gravou!' ;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'não gravou!';
            return false;
        }
    }

    
    /**
     * Método utilizado para alterar uma empresa
     * @access public 
     * @param Int $id_local id da local
     * @param String $endereco enderecço do local
     * @param String $origem local de origem
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarLocal($id_local, $endereco, $origem) {

        #setar os dados
        $this->setId($id_local);
        $this->setNome($endereco);
        $this->setCnpj($origem);
        
        #montar a consulta
        $sql = "UPDATE tb_empresa SET endereco = :endereco, origem = :origem WHERE id_local = :id_local";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_local', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $query->bindValue(':origem', $this->getOrigem(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para excluir um usuário cadastrado
     * @access public 
     * @param Int $id_local id do local
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    public function excluirLocal($id_local) {

        #setar os dados
        $this->setId($id_local);

        #montar a consulta
        $sql = "DELETE FROM tb_empresa WHERE id_local=:id_local";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_local', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
