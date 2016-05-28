<?php

#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#carrega as classes automaticamente
include_once 'autoload.php';


$objlg = new controlLogin();

#verificar se foi informado os dados
if (isset($_POST["logar"])) {
    #passa o id do empresa para o controle realizar a exclusão
    echo 'Autenticando...';
       $objlg->autentica($_POST["dados"]);
}

?>

<html>
    <head>
        <title>Sistema FindVans</title>
        <!-- Link do Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <meta charset="UTF-8">
        <style> 
            body{
                background: yellow;
                padding-top: 10%;
                padding-bottom: 40px;
            }
            form_login{
                width: 26%;
                max-width: 330px;
                padding: 15px;
                margin:9% auto 4% auto;
                position: relative;
            }

        </style>
    </head>

    <body>
        <div class="container">
            <!--            <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <p></p>
                            </div> /.container-fluid 
                        </nav>-->
            <div id="form_login" >

                <div  class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <h1>Login</h1>
                    
                        <form  action="" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="dados[email][]" id="email" placeholder="Email"  required title="Digite seu E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" name="dados[senha][]" id="senha" placeholder="Senha"  required title="Digite sua Senha">
                            </div>
                            <button type="submit" name="logar" class="btn btn-primary btn-lg">Entrar</button>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- Link do JQuery e seus plugins -->
        <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>
