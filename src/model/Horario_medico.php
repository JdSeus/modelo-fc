<?php

class Horario_medico extends Model {

    public static function listAll($id_medico)
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM horario WHERE id_medico = :id_medico ORDER by data_horario", array(
            'id_medico' => $id_medico
        ));

        return $data;
    }

    public function getHorario($id)
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM horario WHERE id = :id", array(
            ':id' => $id
        ));

        $this->setData($data[0]);

    }

    public function save($id_medico, $horario_marcado)
    {
        $sql = new Sql();


        $results = $sql->query("INSERT INTO horario (id_medico, data_horario, horario_agendado, data_criacao) VALUES (:id_medico, :data_horario, 0, CURRENT_TIMESTAMP(6))", array(
            ':id_medico' => $id_medico,
            ':data_horario' => $horario_marcado
        ));

        $results = $sql->select("SELECT * FROM horario WHERE id = LAST_INSERT_ID()");

        print_r($results);
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
        DELETE FROM horario
        WHERE id = :id
        ",
        array (
            ':id' => $this->getid()
        )
        );
    }

}

?>