<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of open
 *
 * @author Jonathan
 */
#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#carrega as classes automaticamente
include_once '../view/autoload.php';

class controlLogin {

    function autentica($dados) {
        
        $email = $dados[email][0];
        $senha = $dados[senha][0];

        $objUsuario = new modelUsuario();


        $result = $objUsuario->fazerLogin($email, $senha);

        if (count($result) > 0) {
            $_SESSION['email'];
            $_SESSION['senha'];

            header('location:../view/principal.php');
        } else {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('location:../index.html');
        }
    }

}
