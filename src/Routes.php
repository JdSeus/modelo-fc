<?php

//Rota para o index.
Route::set('index.php', function() {
    Home::createHome();
});

Route::set('change-horario-post', function() {
    //Condição para só ser possível vir aqui se for pelo index.php.
    if (!empty($_POST))
    {
        print_r($_POST);

        $id = $_POST['horario_id'];

        $controller = new Home();
        $controller->changeHorario($id);

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

        $controller = new CadastroMedico();
        $controller->makeNewCadastro($name, $email, $password);

        //Se não ocorreu nenhum erro, é redirecionado para a pagina inicial.
        if ($controller->geterro() == null)
        {
            header("Location: index.php");
            exit;
        }
        //Se ocorreu um erro, retorna para o cadastro-medico e mostra o erro.
        else
        {
            //Definição do que será enviado no postAndGo.
            $params = array(
                "erro" => $controller->geterro()
            );

            Route::postAndGo("cadastro-medico",$params); 
            exit; 
        }
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
        Controller::createView('editar-cadastro-medico');

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

        $controller = new EditarCadastro();
        $controller->updateCadastro($name, $pastpassword, $newpassword, $id);

        $erro = $controller->geterro();

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
            exit; 
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

Route::set('adicionar-remover-horario', function() {
    //Condição para só ser possível vir aqui se for pelo formulário do index.
    if (!empty($_POST))
    {
        Home::createView('adicionar-remover-horario');
    }
    //Caso alguém tente acessar direto, vai ser redirecionado.
    else
    {
        header("Location: index.php");
        exit;
    }

});

Route::set('adicionar-horario-post', function() {
    //Condição para só ser possível vir aqui se for pelo formulário do adicionar-remover-horario.
    if (!empty($_POST))
    {
        $name = $_POST['form-name'];
        $hr = $_POST['form-horario'];
        $id_medico = $_POST['id_medico'];
    
        $horario = new Horario();
        $horario->save($id_medico, $hr);

        $params = array(
            "id_medico" => $id_medico
        );

        Route::postAndGo("adicionar-remover-horario",$params);
        exit; 
    }
    //Caso alguém tente acessar direto, vai ser redirecionado.
    else
    {
        header("Location: index.php");
        exit;
    }

});

Route::set('remover-horario-post', function() {
    //Condição para só ser possível vir aqui se for pelo formulário do adicionar-remover-horario.
    if (!empty($_POST))
    {
        $id_horario = $_POST["id_horario"];
        $id_medico = $_POST["id_medico"];

        $horario = new Horario();
        $horario->getHorario($id_horario);
        $horario->delete();

        $params = array(
            "id_medico" => $id_medico
        );

        Route::postAndGo("adicionar-remover-horario",$params);
        exit; 

    }
    //Caso alguém tente acessar direto, vai ser redirecionado.
    else
    {
        header("Location: index.php");
        exit;
    }

});


?>