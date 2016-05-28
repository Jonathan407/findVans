<?php
#carrega as classes automaticamente
include_once 'autoload.php';

#verifica qual modulo e qual e qual menu é o escolhido
$modulo = $_GET["modulo"];
$menu = $_GET["menu"];

switch ($modulo) {
    #modulo usuário
    case 'usuario':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarUsuario.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirUsuario.php';
                break;
        }
        break;

    case 'empresa':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarEmpresa.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirEmpresa.php';
                break;
        }
        break;
    
     case 'itinerario':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarItinerario.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirItinerario.php';
                break;
        }
        break;

    default:
        #menu padrão
        include 'principal.php';
        break;
}
