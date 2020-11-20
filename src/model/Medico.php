<?php

class Medico extends Model {

    public static function listAll()
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM medico");

        return $data;
    }

    public static function criptoPassword($password)
    {
        return md5($password);
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

        $results = $sql->query("INSERT INTO medico (email, nome, senha, data_criacao) VALUES (:email, :nome, :senha, CURRENT_TIMESTAMP(6))", array(
            ':email' => $this->getemail(),
            ':nome' => $this->getnome(),
            ':senha' => $this->getsenha(),
        ));

        $results = $sql->select("SELECT * FROM medico WHERE id = LAST_INSERT_ID()");

        $this->setData($results[0]);
    }

    public function update()
    {
        $sql = new Sql();

        $results = $sql->query(
        "UPDATE medico
        SET
        nome = :nome,
        senha = :senha,
        data_alteracao = CURRENT_TIMESTAMP(6)
        WHERE id = :id",
        array(
            ':nome' => $this->getnome(),
            ':senha' => $this->getsenha(),
            ':id' => $this->getid()
        ));

        $results = $sql->select("SELECT * FROM medico WHERE id = :id", array(':id' => $this->getid()));

        $this->setData($results[0]);
    }

    public function delete()
    {
        $sql = new Sql();

        $results = $sql->query(
        "
        DELETE FROM medico
        WHERE id = :id
        ",
        array (
            ':id' => $this->getid()
        )
        );
    }

}

?>