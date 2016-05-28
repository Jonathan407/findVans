<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

class modelItinerario extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id_itinerario;
    private $rota;
    private $empresa;
    private $origem;
    private $destino;

    /**
     * Métodos get e sets das classes
     */
    public function getId_itinerario() {
        return $this->id_itinerario;
    }

    public function getRota() {
        return $this->rota;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function getOrigem() {
        return $this->origem;
    }

    public function getDestino() {
        return $this->destino;
    }

    public function setId_itinerario($id_itinerario) {
        $this->id = $id_itinerario;
    }

    public function setRota($rota) {
        $this->nome = $rota;
    }

    public function setEmpresa($empresa) {
        $this->email = $empresa;
    }

    public function setOrigem($origem) {
        $this->cnpj = $origem;
    }

    public function setDestino($destino) {
        $this->telefone = $destino;
    }

    public function __clone() {
        ;
    }

  
    public function consultarItinerario($id_itinerario, $rota) {

        #setar valores
        $this->setId_itinerario($id_itinerario);
        $this->setRota($rota);

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_itinerario where true";

        #verificar se foi passado algum valor de $id
        if ($this->getId_itinerario() != null) {
            $sql.="and id_itinerario = :id_itinerario";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getRota() != null) {
            $sql.= " and nome LIKE :nome ";
        }

        #execulta a consulta e constroi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            if ($this->getId() != null) {
                $query->bindValue(':id_itinerario', $this->getId_itinerario(), PDO::PARAM_INT);
            }

            if ($this->getRota() != NULL) {
                $this->setRota("%" . $rota . "%");
                $query->bindValue(':rota', $this->getRota(), PDO::PARAM_STR);
            }
           
            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

    function inserirItinerario($rota, $empresa, $origem, $destino) {

        #setar os dados
        $this->setNome($rota);
        $this->setCnpj($empresa);
        $this->setEmail($destino);
        $this->setTelefone($origem);

        #montar a consulta
        $sql = "INSERT INTO tb_itinerario (id_itinerario, rota, empresa, destino, origem) "
                . "VALUES (null,:rota,:empresa,:destino,:origem,)";
        
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':rota', $this->getRota(), PDO::PARAM_STR);
            $query->bindValue(':empresa', $this->getEmpresa(), PDO::PARAM_STR);
            $query->bindValue(':origem', $this->getOrigem(), PDO::PARAM_STR);
            $query->bindValue(':destino', $this->getDestino(), PDO::PARAM_STR);
            $query->execute();
            return true;
            echo 'gravou!';
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'não gravou!';
            return false;
        }
    }

   
    public function alterarItinerario($id_itinerario, $rota, $empresa, $origem, $destino) {

        #setar os dados
        $this->setId($id_empresa);
        $this->setNome($nome);
        $this->setCnpj($cnpj);
        $this->setEmail($email);
        $this->setTelefone($telefone);

        #montar a consulta
        $sql = "UPDATE tb_itinerario SET rota = :rota, empresa = :empresa, destino = :destino, origem = :origem WHERE id_itinerario = :id_itinerario";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_itinerario', $this->getId_itinerario(), PDO::PARAM_INT);
            $query->bindValue(':rota', $this->getRota(), PDO::PARAM_STR);
            $query->bindValue(':empresa', $this->getEmpresa(), PDO::PARAM_STR);
            $query->bindValue(':origem', $this->getOrigem(), PDO::PARAM_STR);
            $query->bindValue(':destino', $this->getDestino(), PDO::PARAM_STR);

            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

   
    public function excluirItinerario($id_itinerario) {

        #setar os dados
        $this->setId($id_itinerario);

        #montar a consulta
        $sql = "DELETE FROM tb_itinerario WHERE id_itinerario=:id_itinerario";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_itinerario', $this->getId_itinerario(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
