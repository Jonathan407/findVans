<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#inclui arquivo da classe de conexão
include_once './modelConexao.class.php';



$bd = new modelConexao();



try {
    $bd->conectar();
    $sql.= "select * from tb_usuario where true";
    $query = $bd->prepare($sql);
    $query->execute();
    echo $query->fetchAll(PDO::FETCH_ASSOC);

    echo 'deu certo!';
} catch (Exception $ex) {
    $ex->getMessage();
    echo 'erro';
}