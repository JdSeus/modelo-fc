<?php

Route::set('index.php', function() {
    $_REQUEST['medicos'] = Medico::listAll();
    Home::createView('listagem-medicos-horarios');
});

Route::set('cadastro-medico', function() {
    $_REQUEST['medicos'] = Medico::listAll();
    Home::createView('cadastro-medico');
});

?>