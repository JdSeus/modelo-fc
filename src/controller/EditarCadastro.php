<?php

class EditarCadastro extends Controller {

    private $name;
    private $past_password;
    private $new_password;
    private $id_medico;

    private $erro = null;

    public function geterro()
    {
        return $this->erro;
    }

    public function updateCadastro($form_name, $form_past_password, $form_new_password, $id) {

        $this->name = $form_name;
        $this->past_password = $form_past_password;
        $this->new_password = $form_new_password;
        $this->id_medico = $id;

        if ($this->checklenghts() == true)
        {
            if ($this->comparePasswords($this->past_password))
            {
                $this->updateMedico();
            }
            else
            {
                $this->erro = "Senhas não batem";
            }

        }
        else
        {
            $this->erro = "Tamanhos incorretos";
        }
    }

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