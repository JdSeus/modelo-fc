<?php

/*
* É recomendado que todo o carregamente seja feito apartir desse arquivo.
*/
    include_once("model/Sql.php");
    include_once("model/Model.php");

    $dado = new Sql();

    $agora = SUNFUNCS_RET_TIMESTAMP;
    
    /*$dado->query("INSERT INTO medico (email, nome, senha) VALUES (:EMAIL, :NOME, :SENHA)", 
    array(
      ":EMAIL" => "a@a.com",  
      ":NOME" => "alex",
      ":SENHA" => "senha1"
    ));
    */

    /*$results = $dado->select("SELECT * FROM medico ORDER BY id");

    echo json_encode($results);*/

    /*
    $teste = new Model();

    $data = array(
      'nome' => 'Alex',
      'fruta' => 'Abacaxi',
      'carro' => 'gol',
      'peso' => '85',
    );

    $teste->setData($data);

    $teste->getValues();

    print_r($teste);
    */
    
?>