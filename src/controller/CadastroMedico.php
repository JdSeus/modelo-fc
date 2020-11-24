<?php

class CadastroMedico extends Controller {

    //Classe que controla a página que cadastra novos médicos.

    private $name;
    private $email;
    private $password;


    private $erro = null;

    //get que entrega o erro ocorrido.
    public function geterro()
    {
        return $this->erro;
    }

    //Método que realiza o cadastro de um novo médico, checando se os campos estão com o tamanho correto.
    public function makeNewCadastro($form_name, $form_email, $form_password) {
        $this->name = $form_name;
        $this->email = $form_email;
        $this->password = $form_password;

        if ($this->checklenghts() == true)
        {
            if ($this->checkEmail())
            {
                $this->registerMedico($this->name,$this->email,$this->password);
            }
            else
            {
                $this->erro = "E-mail inválido.";
            }
        }
        //Caso os campos estejam com tamanho incorreto, é enviado o erro "Tamanhos incorretos". Lembrando que o Front-End já impede isso de ocorrer.
        else
        {
            $this->erro = "Tamanhos incorretos.";
        }
        
    }

    //Método que verifica se o email digitado é valido.
    public function checkEmail()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //Método que checa no BackEnd se os campos do form estão com o tamanho correto.
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

    //Método chamado para registrar o médico no banco de dados, com a senha criptografada.
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