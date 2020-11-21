<?php

Route::set('index.php', function() {
   // print_r($_POST);
    $_REQUEST['medicos'] = Medico::listAll();
    Home::createView('listagem-medicos-horarios');
});

Route::set('cadastro-medico', function() {
    CadastroMedico::createView('cadastro-medico');
});

Route::set('cadastro-medico-post', function() {

    $name = $_POST['form-name'];  
    $email = $_POST['form-email'];  
    $password = $_POST['form-password'];  

    $cadastro = new CadastroMedico();
    $cadastro->makeNewCadastro($name, $email, $password);

    header("Location: index.php");
    exit;

});

Route::set("editar-cadastro-medico", function() {

    print_r($_POST);
    if (!empty($_POST))
    {
        $idmedico = $_POST['id'];

        $medico = new Medico();
        $medico->getMedico($idmedico);

        $_REQUEST['medico'] = $medico;
        Home::createView('editar-cadastro-medico');

    }
    else
    {
        header("Location: index.php");
        exit;
    }
    
});

Route::set('editar-cadastro-medico-post', function() {
    
    print_r($_POST);
    if (!empty($_POST)) 
    {
        $name = $_POST['form-name'];
        $pastpassword = $_POST['form-past-password'];
        $newpassword = $_POST['form-new-password'];
        $id = $_POST['id'];

        $atualizarCadastro = new EditarCadastro();
        $atualizarCadastro->updateCadastro($name, $pastpassword, $newpassword, $id);

        if ($atualizarCadastro->geterro() !== null)
        {
            echo "<br>";
            //echo $atualizarCadastro->geterro();
           // header("Location: editar-cadastro-medico");
            //exit;
        }
        else
        {
            header("Location: index.php");
            exit;
        }
    }
    else
    {
        header("Location: index.php");
        exit;
    }



});


?>