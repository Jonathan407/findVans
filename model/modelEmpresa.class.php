<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em 01/01/2015
 * Classe de CRUD com PDO para manter usuário
 * @author Jonathan Santos Rodrigues
 * @version 1.0.0
 */
class modelEmpresa extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $nome;
    private $cnpj;
    private $email;
    private $telefone;
    private $endereco;

    /**
     * Métodos get e sets das classes
     */
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    /**
     * método mágico para não permitir clonar a classe
     */
    public function __clone() {
        ;
    }

    /**
     * Método utilizado para consultar os usuários cadastrados
     * @access public 
     * @param Int $id id da empresa
     * @param String $nome nome da empresa
     * @return Array dados da empresa
     */
    public function consultarEmpresa($id_empresa, $nome) {

        #setar valores
        $this->setId($id_empresa);
        $this->setNome($nome);

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_empresa where true";

        #verificar se foi passado algum valor de $id
        if ($this->getId() != null) {
            $sql.=" and id_empresa = :id_empresa";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getNome() != null) {
            $sql.= " and nome LIKE :nome ";
        }

        #execulta a consulta e constroi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_empresa
            if ($this->getId() != null) {
                $query->bindValue(':id_empresa', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome
            if ($this->getNome() != NULL) {
                $this->setNome("%" . $nome . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
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
     * @param String $nome nome da empresa
     * @param String $cnpj cnpj da empresa
     * @param String $email email da empresa
     * @param String $telefone telefone da empresa
     * * @param String $endereco endereco da empresa
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirEmpresa($nome, $cnpj, $email, $telefone, $endereco) {

        #setar os dados
        $this->setNome($nome);
        $this->setCnpj($cnpj);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setEndereco($endereco);

        #montar a consulta
        $sql = "INSERT INTO tb_empresa (id_empresa, nome, cnpj, email, telefone, endereco) "
                . "VALUES (null,:nome,:cnpj,:email,:telefone,:endereco)";
        
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cnpj', $this->getCnpj(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $query->execute();
            return true;
            echo 'gravou!';
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'não gravou!';
            return false;
        }
    }

    
    /**
     * Método utilizado para alterar uma empresa
     * @access public 
     * @param Int $id id da empresa
     * @param String $nome nome da empresa
     * @param String $cnpj Cnpj da empresa
     * @param String $email E-mail da empresa
     * @param String $telefone telefone da empresa
     * @param String $endereco da empresa
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarEmpresa($id_empresa, $nome, $cnpj, $email, $telefone, $endereco) {

        #setar os dados
        $this->setId($id_empresa);
        $this->setNome($nome);
        $this->setCnpj($cnpj);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setEndereco($endereco);

        #montar a consulta
        $sql = "UPDATE tb_empresa SET nome = :nome, cnpj = :cnpj, email = :email, telefone = :telefone , endereco = :endereco WHERE id_empresa = :id_empresa";

        #realizar a blidagem dos dados
        try {
            echo 'Alterou';
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_empresa', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cnpj', $this->getCnpj(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            echo "query".query;
            $query->execute();
            return true;
        } catch (PDOException $e) {
             echo 'Erro ao alterar';
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para excluir um usuário cadastrado
     * @access public 
     * @param Int $id id do usuário
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    public function excluirEmpresa($id_empresa) {

        #setar os dados
        $this->setId($id_empresa);

        #montar a consulta
        $sql = "DELETE FROM tb_empresa WHERE id_empresa=:id_empresa";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_empresa', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
