<?php

class Home extends Controller {
    
    public function orderView() {

        //Array com todos os médicos ordernados pelo id.
        $medicos = Medico::listAll();

        //Array com todos os horarios DISPONÍVEIS ordernados por data.
        $horariosD = Horario::listAllDisponible();

        //Array com todos os horarios NÃO DISPONÍVEIS ordernados por data.
        $horariosND = Horario::listAllUnavailable();


        //$dborder será um array com todos os ids dos médicos do banco de dados ordenados por id.
        $dborder = $this->getOrderInDb($medicos);

        //$orderD (Disponível) será um array dos ids dos medicos dos horários DISPONÍVEIS sem repetição em ordem de data. 
        $orderD = $this->getOrderMedicos($horariosD);

        //$orderND (Não Disponiveis) será um array dos ids dos medicos dos horários NÃO DISPONÍVEIS sem repetição em ordem de data. 
        $orderND = $this->getOrderMedicos($horariosND);

        //$idsSH (Sem Horario) será um array com os ids dos médicos que não marcaram nenhum tipo de horário.
        $idsSH = array_diff($dborder, $orderD);
        $idsSH = array_diff($idsSH, $orderND);

        //$orderCO (Completamente Ocupado) será um array com os ids dos médicos sem horários vagos.
        $orderCO = array_diff($orderND, $orderD);   

        //print_r($dborder);

        //print_r($orderD);
        //print_r($orderND);
        //print_r($orderCO);
        //print_r($idsSH);

        //Array final que servirá para ordenar a view.
        //Com tudo isso, a ordem estará conforme foi pedido nas referências.
        //E seguirá o seguinte padrão:
        //Médicos com horários disponíveis aparecendo pela data disponível mais próxima.
        //Médicos completamente ocupados aparecendo pela data mais próxima.
        //Médicos que não registraram nenhum horário.

        $finalOrder = array_merge($orderD, $orderCO);
        $finalOrder = array_merge($finalOrder, $idsSH);
        //print_r($finalOrder);

        return $finalOrder;

    }

    public function getOrderInDb($medicos)
    {
        $allids = Array();
        foreach($medicos as $medico)
        {
            $allids[] = $medico['id'];
        }

        return $allids;
    }

    public function getOrderMedicos($horarios)
    {
        $idmedicoapparition = Array();
        foreach($horarios as $horario)
        {
            $idmedicoapparition[] = $horario['id_medico'];
        }

        $order = array_unique($idmedicoapparition);

        return $order;
    }

}

?>