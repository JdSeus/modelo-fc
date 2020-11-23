<?php

class Home extends Controller {

    public function OrderView() {

        $now = new DateTime('now');
        
        $horariosD = Horario::listAllDisponible();

        $horariosDAfterNow = array();
        $horariosDBeforeNow = array();

        //Array com o indice dos médicos de todos os horários disponíves independente do tempo.
        $orderMedicosIdsD = $this->getNoRepeatFieldFrom($horariosD, 'id_medico');;

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

        $orderMedicosIdsDAfterNow = $this->getNoRepeatFieldFrom($horariosDAfterNow, 'id_medico');
        $orderMedicosIdsDBeforeNow = $this->getNoRepeatFieldFrom($horariosDBeforeNow, 'id_medico');
        
        $orderMedicosIdsDBeforeNow = array_diff($orderMedicosIdsDBeforeNow, $orderMedicosIdsDAfterNow);

        /////////////////////////////////////////
        //Lista dos completamente ocupados
        $horariosND = Horario::listAllUnavailable();

        //CO Completamente Ocupados
        $orderMedicosIdsND = $this->getNoRepeatFieldFrom($horariosND, 'id_medico');

        $orderMedicosIdsCO = array_diff($orderMedicosIdsND, $orderMedicosIdsD );

        /////////////////////////////////////
        //Lista dos Médicos sem Horarios
        $medicosAll = Medico::listAll();

        $allIdsMedico = $this->getNoRepeatFieldFrom($medicosAll, 'id');

        $orderMedicosSemH = array_diff($allIdsMedico, $orderMedicosIdsD);

        $orderMedicosSemH = array_diff($orderMedicosSemH, $orderMedicosIdsND);

        ////////////////////////////////////

        echo "<br>";
        print_r($orderMedicosIdsDAfterNow);
        echo "<br>";
        print_r($orderMedicosIdsDBeforeNow);



        $finalOrder = $orderMedicosIdsDAfterNow;
        $finalOrder = array_merge($finalOrder, $orderMedicosIdsDBeforeNow); 
        $finalOrder = array_merge($finalOrder, $orderMedicosIdsCO); 
        $finalOrder = array_merge($finalOrder, $orderMedicosSemH); 

        return $finalOrder;
        
    }

    //Esse método retornará um array com os valores do $fieldname de uma $list sem repetição.
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