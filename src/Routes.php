<?php

Route::set('index.php', function() {
   // print_r($_POST);
    $_REQUEST['medicos'] = Medico::listAll();
    Home::createView('listagem-medicos-horarios');
});

Route::set('cadastro-medico', function() {
    ControllerCadastro::createView('cadastro-medico');
});

Route::set('cadastro-medico-post', function() {

    $name = $_POST['form-name'];  
    $email = $_POST['form-email'];  
    $password = $_POST['form-password'];  

    $cadastro = new ControllerCadastro($name, $email, $password);

});


Route::set('teste', function() {
    ?>
    <!DOCTYPE html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">

        <!-- Meu Estilo -->
        <link rel="stylesheet" href="res/css/facilconsulta.css" type="text/css">
    </head>
    <body>
        <h1>Teste</h1>
    </body>
    <?php
});

?>