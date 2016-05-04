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

if (!empty($_POST)) {

    $login = filter_input(INPUT_POST, "email");
    $senha = filter_input(INPUT_POST, "senha");


    echo 'login:' . $login;

    $objUsuario = new modelUsuario();


    $result = $objUsuario->fazerLogin($login, $senha);

    if (count($result) > 0) {
        echo 'if';
        $_SESSION['email'];
        $_SESSION['senha'];

        foreach ($result as $item) {
            echo "<tr>";
            echo "<td> {$item[id_usuario]} </td>";
            echo "<td> {$item[nome]} </td>";
            echo "<td> {$item[email]} </td>";
            echo "<td> {$item[telefone]} </td>";
            echo "<td> {$item[senha]} </td>";
            echo "</tr>";
        }

//    header('location:../view/principal.php');
    } else {
        echo 'else';
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
//    header('location:index.php');
        echo 'login:' . $login;
    }
} else {
    echo 'Ocorreu um Erro!';
    echo " <script type='text/javascript'>
	alert('Ocorreu um Erro!);
	
</script>";
}