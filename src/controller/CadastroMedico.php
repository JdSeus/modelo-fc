<?php

class CadastroMedico extends Controller {

    private $name;
    private $email;
    private $password;

    private $minlenght = false;

    public function makeNewCadastro($form_name, $form_email, $form_password) {
        $this->name = $form_name;
        $this->email = $form_email;
        $this->password = $form_password;

        if ($this->checklenghts() == true)
        {
            $this->registerMedico($this->name,$this->email,$this->password);
        }
        
    }

    public function checkLenghts() {
        
        if (strlen($this->name) < 6) {
            return false;
        }
        else
        {
            if (strlen($this->email) < 6) {
                return false;
            }
            else
            {
                if (strlen($this->password) < 6) {
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }

    }

    public function registerMedico($name, $email, $password) {

        $medico = new Medico();

        $medico->setnome($name);
        $medico->setemail($email);
        $password = Medico::criptoPassword($password);
        $medico->setsenha($password);

        $medico->save();


    }

}

?>