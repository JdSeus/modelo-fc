<?php

class ControllerCadastro extends Controller {

    private $name;
    private $email;
    private $password;

    private $erro = true;
   
    public function __construct($form_name, $form_email, $form_password) {
        $this->name = $form_name;
        $this->email = $form_name;
        $this->password = $form_name;

        if ($this->findError() == false)
        {
          //  $this->registerMedico($this->name,$this->email,$this->password);
            echo "medico registrado";
        }
    }

    public function findError() {
        
        if (strlen($this->name) < 6) {
            $this->erro = true;
        }
        else
        {
            if (strlen($this->email) < 6) {
                $this->erro = true;
            }
            else
            {
                if (strlen($this->password) < 6) {
                    $this->erro = true;
                }
            }
        }

        if ($this->erro == 0)
        {
            $this->erro = false;
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