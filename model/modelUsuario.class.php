<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em 01/01/2015
 * Classe de CRUD com PDO para manter usuário
 * @author Jonathan Santos Rodrigues
 * @version 1.0.0
 */
class modelUsuario extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $senha;

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

    public function getTelefone() {
        return $this->telefone;
    }

    public function getSenha() {
        return $this->senha;
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

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
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
     * @param Int $id id do usuário
     * @param String $nome nome do usuário
     * @return Array dados do usuário
     */
    public function consultarUsuario($id_usuario, $nome) {

        #setar os valores
        $this->setId($id_usuario);
        $this->setNome($nome);
       
        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_usuario where true";

        #verificar se foi passado algum valor de $id_usuario    
        if ($this->getId() != null) {
            $sql.= " and id_usuario = :id_usuario";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getNome() != null) {
            $sql.= " and nome LIKE :nome ";
        }

        #executa consulta e constroi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_usuario   
            if ($this->getId() != null) {
                $query->bindValue(':id_usuario', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome 
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            }

            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    
    public function fazerLogin($email, $senha) {

        #setar os valores
        $this->setEmail($email);
        $this->setSenha($senha);
        echo 'Nome:'.$this->getEmail();
        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_usuario where true";

        #verificar se foi passado algum valor de $id_usuario    
        if ($this->getEmail() != null) {
            $sql.= " and email = :email";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getSenha() != null) {
            $sql.= " and senha LIKE :senha ";
        }

        #executa consulta e constroi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

           #verificar se foi passado algum valor de $nome 
            if ($this->getEmail() != null) {
                $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            }
            
             #verificar se foi passado algum valor de senha   
            if ($this->getSenha() != null) {
                $query->bindValue(':senha', $this->getSenha(), PDO::PARAM_INT);
            }

            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

    /**
     * Método utilizado para inserir um usuário
     * @access public 
     * @param String $nome nome do usuário
     * @param String $email email do usuario
     * @param String $telefone telefone do usuário
     * * @param String $senha senha do usuário
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirUsuario($nome, $email, $telefone, $senha) {

        #setar os dados
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setSenha($senha);
        echo $this->getTelefone();

        #montar a consulta
        $sql = "INSERT INTO tb_usuario (id_usuario, nome, email, telefone, senha) "
                . "VALUES (null,:nome,:email,:telefone,:senha)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
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
     * Método utilizado para alterar um usuário
     * @access public 
     * @param Int $id id do usuário
     * @param String $nome nome do usuário
     * @param String $email E-mail do usuário
     * @param String $telefone telefone do usuário
     * @param String $senha senha do usuário
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarUsuario($id_usuario, $nome, $email, $telefone, $senha) {

        #setar os dados
        $this->setId($id_usuario);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setSenha($senha);
      
        #montar a consulta
        $sql = "UPDATE tb_usuario SET nome = :nome, email = :email, telefone = :telefone , senha = :senha WHERE id_usuario = :id_usuario";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_usuario', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
           
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
     * @param Int $id id do usuário
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    public function excluirUsuario($id_usuario) {

        #setar os dados
        $this->setId($id_usuario);

        #montar a consulta
        $sql = "DELETE FROM tb_usuario WHERE id_usuario=:id_usuario";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_usuario', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
