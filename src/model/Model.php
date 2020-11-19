<?php

class Model {

    private $values = [];

    //Método mágico __call
    //__call() é disparado ao invocar métodos inacessíveis em um contexto de objeto.
    //Servirá para criar dinamicamente os getters e setters.
    public function __call($name, $args)
    {
        //Servirá para identificar se o método é get ou set. Ex: Se $name for getId, salvará 'get' no $method.
        $method = substr($name, 0, 3);
        //Servirá para identificar o restante do método. Ex: Se $name for getId, salvará 'Id' no $fieldName.
        $fieldName = substr($name, 3, strlen($name));

        switch($method)
        {
            //Se o metodo chamado for get, retornará o valor correspondente do $fieldName.
            case "get":
                //Operador ternário é necessário porque o campo pode estar em branco no banco de dados.
                return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
            break;
            //Se o método chamado for set, atribuirá o valor ao $fieldName.
            case "set":
                $this->values[$fieldName] = $args[0];
            break;
        }

    }

    //O objetivo do método setData é criar dinamicamente os atributos do Model.
    public function setData($data = array())
    {   
        //Ele fará isso atribuindo dinâmicamente os atributos segundo os nomes do array $data.
        //O $data é um array que contém as informações da coluna e campo do banco de dados.
        foreach($data as $key => $value)
        {
            //Criação dinâmica de atributo.
            $this->{"set".$key}($value);
        }

    }

    //retornará o array com os valores.
    public function getValues()
    {
        return $this->values;
    }

}

?>