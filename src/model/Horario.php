<?php

class Horario extends Model {

    //Método que retorna um array com todos os horários do médico passado como parâmetro pelo id. Está ordenado por ordem de data.
    public static function listAllFromMedico($id_medico)
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM horario WHERE id_medico = :id_medico ORDER by data_horario", array(
            'id_medico' => $id_medico
        ));

        return $data;
    }

    //Método que retorna um array com todos os horários do banco de dados que estão com o horario_agendado = 0, ou seja, DISPONÍVEIS. Ordenado por data.
    public static function listAllDisponible()
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM horario WHERE horario_agendado = 0 ORDER by data_horario");

        return $data;
    }

    //Método que retorna um array com todos os horários do banco de dados que estão com o horario_agendado = 1, ou seja, OCUPADOS ou NÃO DISPONÍVEIS. Ordenado por data.
    public static function listAllUnavailable()
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM horario WHERE horario_agendado = 1 ORDER by data_horario");

        return $data;
    }

    //Método que retorna um array com todos os horários do banco de dados, independente da condição, ordenados por data.
    public static function listAll()
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM horario ORDER by data_horario");

        return $data;
    }

    //Método que salva nos parâmetros desta classe o horario corresponde ao do id passado.
    //Lembrando que os parâmetros são gerados dinamicamente pela classe Model, a qual esta extende.
    public function getHorario($id)
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM horario WHERE id = :id", array(
            ':id' => $id
        ));

        $this->setData($data[0]);

    }

    //Método que salvará o $horario_marcado passado como argumento com o corresponde $id_medico no banco de dados.
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

    //Método que atualizará o horário corresponde aos parâmetros desta classe no banco de dados.
    public function update()
    {
        $sql = new Sql();

        $results = $sql->query(
        "UPDATE horario
        SET
        id_medico = :id_medico,
        data_horario = :data_horario,
        horario_agendado = :horario_agendado,
        data_alteracao = CURRENT_TIMESTAMP(6)
        WHERE id = :id",
        array(
            ':id' => $this->getid(),
            ':id_medico' => $this->getid_medico(),
            ':data_horario' => $this->getdata_horario(),
            ':horario_agendado' => $this->gethorario_agendado()
        ));

        $results = $sql->select("SELECT * FROM horario WHERE id = :id", array(':id' => $this->getid()));


        $this->setData($results[0]);
    }

    //Método que deleterá o corresponde horário aos parâmetros desta classe no banco de dados.
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

    //Método que analisa se determinada data está após o momento presente ou antes.
    public static function isAfterNow($datahorario)
    {
        $now = new DateTime('now');

        $data = new DateTime($datahorario);

        $difference = (date_diff($now, $data));

        if ($difference->invert == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}

?>