<?php

class Medico extends Model {

	//Método que retorna um array com todos os médicos do banco de dados.
    public static function listAll()
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM medico");

        return $data;
    }

    //Método que criptografa uma password usando md5.
    public static function criptoPassword($password)
    {
        return md5($password);
    }

	//Método que recupera um médico do banco de dados e atribui seus valores para os parâmetros do Model.
    public function getMedico($id)
    {
        $sql = new Sql();

        $data = $sql->select("SELECT * FROM medico WHERE id = :id", array(
            ':id' => $id
        ));

        $this->setData($data[0]);

    }

    //Método que salvará as informações desse Medico no banco de dados.
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

    //Método que atualizará o médico no banco de dados com os valores atuais dos parâmetros.
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

    //Método que deleta um médico do banco de dados.
    //As referências não pediram um sistema de exclusão, então não chega a ser utilizado.
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