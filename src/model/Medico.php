<?php

include_once('Model.php');

class Medico extends Model {

    public static function listAll()
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM medico");

        return $data;
    }

    public function getMedico($id)
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM medico WHERE id = :id", array(
            ':id' => $id
        ));

        $this->setData($data[0]);

    }

    public function save()
    {
        $sql = new Sql();

        $results = $sql->query("INSERT INTO medico (email, nome, senha, data_criacao) VALUES (:email, :nome, :senha, CURRENT_TIMESTAMP)", array(
            ':email' => $this->getemail(),
            ':nome' => $this->getnome(),
            ':senha' => $this->getsenha(),
        ));

        $results = $sql->select("SELECT * FROM medico WHERE id = LAST_INSERT_ID()");

        $this->setData($results[0]);
    }

}

?>