<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em 01/01/2015
 * Classe de CRUD com PDO para manter usuário
 * @author Jonathan Santos Rodrigues
 * @version 1.0.0
 */
class modelVeiculo extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $responsavel;
    private $marca;
    private $modelo;
    private $categoria;
    private $descricao;

    /**
     * Métodos get e sets das classes
     */
    public function getId() {
        return $this->id;
    }

    public function getResponsavel() {
        return $this->responsavel;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setResponsavel($resposanvel) {
        $this->responsavel = $resposanvel;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    /**
     * método mágico para não permitir clonar a classe
     */
    public function __clone() {
        
    }

    public function consultarVeciculo($id, $responsavel) {

        #setar valores
        $this->setId($id);
        $this->setResponsavel($responsavel);

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_veiculo where true";

        #verificar se foi passado algum valor de $id
        if ($this->getId() != null) {
            $sql.="and id = :id_veiculo";
        }

         
        if ($this->getResponsavel() != null) {
            $sql.= " and responsavel LIKE :responsavel ";
        }

        #execulta a consulta e constroi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_veiculo
            if ($this->getId() != null) {
                $query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome
            if ($this->getResponsavel() != NULL) {
                $this->setResponsavel("%" . $responsavel . "%");
                $query->bindValue(':responsanvel', $this->getResponsavel(), PDO::PARAM_STR);
            }

            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

 
    function inserirVeiculo($resposnavel, $marca, $modelo, $categoria, $descricao) {

        #setar os dados
        $this->setResponsavel($resposnavel);
        $this->setMarca($marca);
        $this->setModelo($modelo);
        $this->setCategoria($categoria);
        $this->setDescricao($descricao);

        #montar a consulta
        $sql = "INSERT INTO tb_veiculo (id, resposanvel, marca, modelo, categoria, descricao) "
                . "VALUES (null,:responsavel,:marca,:modelo,:categoria,:descricao)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':resposanvel', $this->getResponsavel(), PDO::PARAM_STR);
            $query->bindValue(':marca', $this->getMarca(), PDO::PARAM_STR);
            $query->bindValue(':modelo', $this->getModelo(), PDO::PARAM_STR);
            $query->bindValue(':categoria', $this->getCategoria(), PDO::PARAM_STR);
            $query->bindValue(':descricao', $this->getDescricao(), PDO::PARAM_STR);
            $query->execute();
            return true;
            echo 'gravou!';
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'não gravou!';
            return false;
        }
    }

    public function alterarVeiculo($id, $resposnavel, $marca, $modelo, $categoria, $descricao) {

        #setar os dados
        $this->setId($id);
        $this->setResponsavel($resposnavel);
        $this->setMarca($marca);
        $this->setModelo($modelo);
        $this->setCategoria($categoria);
        $this->setDescricao($descricao);

        #montar a consulta
        $sql = "UPDATE tb_veiculo SET id = :id, responsavel = :responsavel, marca = :marca, modelo = :modelo, categoria = :categoria , descricao = :descricao WHERE id = :id";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':responsavel', $this->getResponsavel(), PDO::PARAM_STR);
            $query->bindValue(':marca', $this->getCnpj(), PDO::PARAM_STR);
            $query->bindValue(':modelo', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':categoria', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':descricao', $this->getEndereco(), PDO::PARAM_STR);

            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function excluirVeiculo($id) {

        #setar os dados
        $this->setId($id);

        #montar a consulta
        $sql = "DELETE FROM tb_veiculo WHERE id_veiculo = :id_veiculo";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
