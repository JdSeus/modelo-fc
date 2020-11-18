<?php

class Sql {

    //Informações para realizar a conexão com o banco de dados.
    const DBNAME = "teste_fc";
    const HOSTNAME = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";

    //Se a conexão com o banco de dados for realizada com sucesso, a variável erro receberá o valor 0.
    private $error = 1;

    //variável que receberá o PDO.
    private $conn;

    //Método construtor que realiza a conexão com o banco de dados.
    public function __construct() 
    {
       try {

            $this->conn = new PDO("mysql:dbname=" . Sql::DBNAME . ";host=" . Sql::HOSTNAME, Sql::USERNAME, Sql::PASSWORD);
            $this->error = 0;
        
        }
        catch (PDOException $e) {

            $error = 1;

        }
    }

    //Retorna a informação se a conexão foi realizada com sucesso ou não.
    public function getError()
    {
        return $this->error;
    }

    //Método que recebe um statment préviamente preparado e atribui os valores que serão passados para o banco de dados.
    //É private porque ele é um componente do método setParams.
    private function bindParam($statement, $key, $value)
    {

        $statement->bindParam($key, $value);

    }

    //Método para receber o statement criado no método Query e seus parâmetros, de modo a varrer o array realizando os binds necessários.
    //É private porque ele é um componente do método Query.
    //Utiliza internamente o método bindParam criado acima.
    private function setParams($statement, $parameters = array())
    {
        foreach($parameters as $key => $value) {

            $this->bindParam($statement, $key, $value);

        }
    }

    //Método para realizar uma Query no MySQL e atribuir vários parametros através de um array.
    //Utiliza internamente o método setParams.
    public function query($query, $params = array())
    {
        $stmt = $this->conn->prepare($query);

        $this->setParams($stmt, $params);

        $stmt->execute();
    }

    public function select($query, $params = array()):array
    {
        $stmt = $this->conn->prepare($query);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>