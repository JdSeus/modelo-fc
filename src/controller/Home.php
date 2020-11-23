<?php

class Home extends Controller {

    //Classe que controla o index.php

    //Método que ordena os médicos da página inicial.
    public function OrderView() {

        //Provavelmente o método mais complexo do teste, por isso vai ser bem comentado.
        //O objetivo era criar o seguinte padrão de ordenamento:
        //MEDICOS COM OS HORÁRIOS DISPONIVEIS PARA O FUTURO MAIS PRÓXIMO.
        //MEDICOS QUE TINHAM HORÁRIOS DISPONÍVEIS NO PASSADO.
        //MÉDICOS COMPLETAMENTE OCUPADOS.
        //MÉDICOS SEM HORÁRIOS REGISTRADOS.

        //Captura do momento presente. Lembrando que o fuso horário foi configurado no arquivo config.php
        $now = new DateTime('now');
        
        //$horariosD recebe um array com todos os horários disponíveis do banco de dados.
        $horariosD = Horario::listAllDisponible();

        //Setamento das variaveis que serão usadas posteriormente.
        $horariosDAfterNow = array();
        $horariosDBeforeNow = array();

        //Array com o indice dos médicos de todos os horários DISPONIVEIS sem repetição.
        $orderMedicosIdsD = $this->getNoRepeatFieldFrom($horariosD, 'id_medico');;

        //Esse foreach varrerá todos os horários disponíveis e gerará 2 arrays:
        //$horariosDAfterNow terá os horários DISPONIVEIS após o momento presente.
        //$horariosDBeforeNow terá os horários DISPONIVEIS anteriores ao momento presente.
        foreach ($horariosD as $horario)
        {
            $data = $horario['data_horario'];
            $data = new DateTime($data);

            $difference = (date_diff($now, $data));

            if ($difference->invert == 0)
            {
                $horariosDAfterNow[] = $horario;
            }
            else
            {
                $horariosDBeforeNow[] = $horario;
            }
        } 

        //Criação dos arrays com o indice dos médicos dos horários DISPONIVEIS antes e depois do AGORA, sem repetição.
        $orderMedicosIdsDAfterNow = $this->getNoRepeatFieldFrom($horariosDAfterNow, 'id_medico');
        $orderMedicosIdsDBeforeNow = $this->getNoRepeatFieldFrom($horariosDBeforeNow, 'id_medico');
        
        //Como pode ocorrer de um mesmo médico ter tanto 1 horário disponível, quanto 1 horário indisponivel, um dos arrays tem que retirar a repetição.
        //Os médicos com os horários DISPONIVEIS antes do AGORA não serão os mesmos que estarão nos DISPONIVEIS depois do AGORA.
        $orderMedicosIdsDBeforeNow = array_diff($orderMedicosIdsDBeforeNow, $orderMedicosIdsDAfterNow);


        //CRIAÇÂO DO ORDENAMENTO DOS MÉDICOS COMPLETAMENTE OCUPADOS
        /////////////////////////////////////////
            //$horariosND recebe um array com todos os horários NÃO DISPONIVEIS (OCUPADOS) do banco de dados.
            $horariosND = Horario::listAllUnavailable();

            //Array com o indice dos médicos de todos os horários NÃO DISPONIVEIS sem repetição.
            $orderMedicosIdsND = $this->getNoRepeatFieldFrom($horariosND, 'id_medico');

            //Remoção da intersecção com os médicos com horários disponíveis, formando um array dos que estão COMPLETAMENTE OCUPADOS.
            $orderMedicosIdsCO = array_diff($orderMedicosIdsND, $orderMedicosIdsD );

        ////////////////////////////////////////


        //CRIAÇÃO DO ORDENAMENTO DOS MÉDICOS SEM HORÁRIOS REGISTRADOS
        ////////////////////////////////////////
        //Lista dos Médicos sem Horarios

            //Para criar o ordenamento dos médicos sem horários é aplicado o seguinte principio lógico.
            //MÉDICOS SEM HORARIOS = MÉDICOS - MÉDICOS COM HORARIOS DISPONIVEIS - MÉDICOS COM HORARIOS NÃO DISPONIVEIS.

            //$medicosAll recebe um array com todos os médicos do banco de dados.
            $medicosAll = Medico::listAll();

            //Array com o indice de todos os médicos que estão no banco de dados sem repetição (O que o próprio banco já impossibilita).
            $allIdsMedico = $this->getNoRepeatFieldFrom($medicosAll, 'id');

            //Remoção dos médicos com horários disponíveis do array.
            $orderMedicosSemH = array_diff($allIdsMedico, $orderMedicosIdsD);

            //Remoção dos médicos com horários não disponíveis do array.
            //Array dos médicos sem horários.
            $orderMedicosSemH = array_diff($orderMedicosSemH, $orderMedicosIdsND);

        ///////////////////////////////////////

        //CRIAÇÂO DO ARRAY FINAL DE ORDENAMENTO
        //SÂO INSERIDOS OS ARRAYS NA SEGUINTE ORDEM:
        //MEDICOS COM OS HORÁRIOS DISPONIVEIS PARA O FUTURO MAIS PRÓXIMO.
        //MEDICOS QUE TINHAM HORÁRIOS DISPONÍVEIS NO PASSADO.
        //MÉDICOS COMPLETAMENTE OCUPADOS.
        //MÉDICOS SEM HORÁRIOS REGISTRADOS.

        $finalOrder = $orderMedicosIdsDAfterNow;
        $finalOrder = array_merge($finalOrder, $orderMedicosIdsDBeforeNow); 
        $finalOrder = array_merge($finalOrder, $orderMedicosIdsCO); 
        $finalOrder = array_merge($finalOrder, $orderMedicosSemH); 

        //RETORNO DO ARRAY DE ORDENAMENTO
        return $finalOrder;
        
    }

    //Esse método retornará um array com os valores do $fieldname de uma $list não permitindo repetição.
    public function getNoRepeatFieldFrom($list, $fieldname)
    {
        $fieldapparition = Array();
        foreach($list as $key)
        {
            $fieldapparition[] = $key[$fieldname];
        }

        $order = array_unique($fieldapparition);

        return $order;
    }
}

?>