<?php

//AutoLoad para o requerimento das classes que estão no /model, /controller e /view.
spl_autoload_register(function ($class_name) {
    if (file_exists('./model/'. $class_name . '.php')) {
        require_once('./model/'. $class_name . '.php');
    } else if (file_exists('./controller/'. $class_name . '.php')) {
        require_once('./controller/'. $class_name . '.php');
    } else if (file_exists('./view/'. $class_name . '.php')) {
        require_once('./view/'. $class_name . '.php');
    }
});

//Requerimento do arquivo de configuração.
require_once("config.php");

//Requerimento do arquivo de funções.
require_once("functions.php");

//Requerimento do arquivo de rotas. Fundamental para o funcionamento do teste;
require_once("Routes.php");

?>