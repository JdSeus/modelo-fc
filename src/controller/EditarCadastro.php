<?php

class EditarCadastro extends Controller {

    //Classe que controla a página que edita o médico.

    private $name;
    private $past_password;
    private $new_password;
    private $id_medico;

    private $erro = null;

    //get que entrega o erro ocorrido.
    public function geterro()
    {
        return $this->erro;
    }

    //Método principal, que atualiza o médico.
    public function updateCadastro($form_name, $form_past_password, $form_new_password, $id) {

        $this->name = $form_name;
        $this->past_password = $form_past_password;
        $this->new_password = $form_new_password;
        $this->id_medico = $id;

        //Checagem dos comprimentos dos campos.
        if ($this->checklenghts() == true)
        {
            //Checagem para ver se a senha antiga é igual a que está no banco de dados.
            if ($this->comparePasswords($this->past_password))
            {
                //Método que atualiza o médico.
                $this->updateMedico();
            }
            //Se por acaso a senha não for igual, será enviado o erro "Senhas antiga errada".
            else
            {
                $this->erro = "Senhas antiga errada";
            }

        }
        //Caso os campos estejam com tamanho incorreto, é enviado o erro "Tamanhos incorretos". Lembrando que o Front-End já impede isso de ocorrer.
        else
        {
            $this->erro = "Tamanhos incorretos";
        }
    }

    //Método que checa no BackEnd se os campos do form estão com o tamanho correto.
    public function checkLenghts() {
        
        if (strlen($this->name) < 6) {
            return false;
        }
        else
        {
            if (strlen($this->past_password) < 6) {
                return false;
            }
            else
            {
                if (strlen($this->new_password) < 6) {
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }

    }

    //Método que verificará se o campo de senha antiga é igual à que está no banco de dados.
    public function comparePasswords($password) {

        $medico = new Medico();

        $medico->getMedico($this->id_medico);

        $passwordOnDb = $medico->getsenha();

        if (Medico::criptoPassword($password) == $passwordOnDb)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    //Método chamado para atualizar o médico no banco de dados, com a senha criptografada.
    public function updateMedico() {

        $medico = new Medico();

        $medico->getMedico($this->id_medico);

        $medico->setnome($this->name);

        $new_password = Medico::criptoPassword($this->new_password);

        $medico->setsenha($new_password);

        $medico->update();


    }

}

?>