<?php

//Rota para o index.
Route::set('index.php', function() {
    $_REQUEST['medicos'] = Medico::listAll();
    Home::createView('listagem-medicos-horarios');
});

//Rota para a tela de cadastro-medico.
Route::set('cadastro-medico', function() {
    CadastroMedico::createView('cadastro-medico');
});

//Rota que trata o POST que veio do cadastro-medico.
Route::set('cadastro-medico-post', function() {

    //Condição para só ser possível vir aqui se for pelo formulário do cadastro-medico.
    if (!empty($_POST))
    {
        $name = $_POST['form-name'];  
        $email = $_POST['form-email'];  
        $password = $_POST['form-password'];  

        $cadastro = new CadastroMedico();
        $cadastro->makeNewCadastro($name, $email, $password);

        header("Location: index.php");
        exit;
    }
    //Caso alguém tente acessar direto, vai ser redirecionado.
    else
    {
        header("Location: index.php");
        exit;
    }

});

//Rota para a tela de editar-cadastro.
Route::set("editar-cadastro-medico", function() {

    //Condição para só ser possível vir aqui se for pelo formulário do index.
    if (!empty($_POST))
    {
        $idmedico = $_POST['id'];

        $medico = new Medico();
        $medico->getMedico($idmedico);

        $_REQUEST['medico'] = $medico;
        Home::createView('editar-cadastro-medico');

    }
    //Caso alguém tente acessar direto, vai ser redirecionado.
    else
    {
        header("Location: index.php");
        exit;
    }
    
});

//Rota que trata o POST que veio do editar-cadastro-medico.
Route::set('editar-cadastro-medico-post', function() {

    //Condição para só ser possível vir aqui se for pelo formulário do editar-cadastro
    if (!empty($_POST)) 
    {
        $name = $_POST['form-name'];
        $pastpassword = $_POST['form-past-password'];
        $newpassword = $_POST['form-new-password'];
        $id = $_POST['id'];

        $atualizarCadastro = new EditarCadastro();
        $atualizarCadastro->updateCadastro($name, $pastpassword, $newpassword, $id);

        $erro = $atualizarCadastro->geterro();

        //Se houver qualquer erro no atualizarCadastro, o usuário será redirecionado para o editar-cadastro novamente.
        if ($erro !== null)
        {
            //Definição do que será enviado no postAndGo.
            $params = array(
                "erro" => $erro,
                "id" => $id
            );
            //Para poder entrar no editar-cadastro é necessário o indice, por isso foi utilizado o método postAndGo.
            //Além disso, foi mandado o erro pelo post, de modo que o editar-cadastro mostrará o erro que ocorreu.
            Route::postAndGo("editar-cadastro-medico",$params); 
        }
        //Caso o médico tenha sido editado com sucesso, o usuário será mandado para o index.
        else
        {
            header("Location: index.php");
            exit;
        }
    }
    //Caso alguém tente acessar direto, vai ser redirecionado para o index.
    else
    {
        header("Location: index.php");
        exit;
    }
});


?>