<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#carrega as classes automaticamente
include_once '../view/autoload.php';

if (!empty($_POST["dados"])) {
    $dados = $_POST["dados"];

    $login = $dados[email][0];
    $senha = $dados[senha][0];

    $objUsuario = new modelUsuario();


    $result = $objUsuario->fazerLogin($login, $senha);

    if (count($result) > 0) {
        $_SESSION['email'];
        $_SESSION['senha'];

        header('location:../view/principal.php');
    } else {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:../index.html');
       
    }
} else {
    echo 'Ocorreu um Erro!';
    echo " <script type='text/javascript'>
	alert('Ocorreu um Erro!);
        </script>";
}