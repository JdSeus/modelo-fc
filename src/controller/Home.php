<?php

class Home extends Controller {

    public function OrderView() {

        //Armazenando o momento presente.
        $now = new DateTime('now');

        //Array com todos os horarios DISPONÍVEIS ordenados por data.
        $horariosD = Horario::listAllDisponible();

        //Criação do array que guardará todos os horarios DISPONÍVEIS a partir do momento presente.
        $horariosDAfterNow = array();

        //Array que guarda todos os indices dos médicos com horários DISPONÍVEIS, tanto antes quanto depois
        $orderMedicosIdsD = $this->getNoRepeatFieldFrom($horariosD, 'id_medico');;

        //Filtro que selecionará quem irá entrar no $horariosDAfterNow.
        foreach ($horariosD as $horario)
        {
            $data = $horario['data_horario'];
            $data = new DateTime($data);

            //Variável que vê a diferença entre as datas. 
            $difference = (date_diff($now, $data));

            //Se o invert for 0, a data se passá no futuro. Se o invert for 1, a data já passou.
            //Para salvar apenas as datas futuras, o teste é feito com invert == 0
            if ($difference->invert == 0)
            {
                $horariosDAfterNow[] = $horario;
            }
        } 

        //Array que guarda todos os indices dos médicos com horários DISPONÍVEIS, depois do momento presente.
        //Essa váriavel é a mais importante para o funcionamento correto do ordenamento.
        //Na váriavel de ordenamento global $finalOrder, ele será a primeira parte
        $orderMedicosIdsDAfterNow = $this->getNoRepeatFieldFrom($horariosDAfterNow, 'id_medico');


        ///////////////////////////////////////////////////////////////////
        //A partir daqui é programada a ordenação dos médicos com horários totalmente ocupados e os sem horarios registrados.

        //Ordenação dos que estão completamente ocupados

            //Array com todos os horarios NÃO DISPONÍVEIS (OCUPADOS) ordenados por data.
            $horariosND = Horario::listAllUnavailable();

            //Criação do array que guardará todos os horarios NÃO DISPONÍVEIS a partir do momento presente.
            $horariosNaoDAfterNow = array();

            //Filtro que selecionará quem irá entrar no $horariosNaoDAfterNow.
            foreach ($horariosND as $horario)
            {
                $data = $horario['data_horario'];
                $data = new DateTime($data);

                //Variável que vê a diferença entre as datas. 
                $difference = (date_diff($now, $data));

                //Se o invert for 0, a data se passá no futuro. Se o invert for 1, a data já passou.
                //Para salvar apenas as datas futuras, o teste é feito com invert == 0
                if ($difference->invert == 0)
                {
                    $horariosNaoDAfterNow[] = $horario;
                }
            }
            
            //Array que guarda todos os indices dos médicos com horários NÃO DISPONÍVEIS, depois do momento presente.
            $orderMedicosIdsNaoDAfterNow = $this->getNoRepeatFieldFrom($horariosNaoDAfterNow, 'id_medico');

            //$orderMedicosIdsND guardará a ordem que deve aparecer o Id de cada médico que tenha algum horário Ocupado.
            $orderMedicosIdsND = $this->getNoRepeatFieldFrom($horariosND, 'id_medico');

            //Como os médicos que tem horários disponíveis podem ter horários ocupados, fazendo esse diff teremos um array apenas com os completamente ocupados depois do presente.
            $orderMedicosIdsCOAfterNow = array_diff($orderMedicosIdsNaoDAfterNow, $orderMedicosIdsD );

        //Ordenação dos que não registraram nenhum horário
            //Para conseguir os indices dos médicos sem horarios registrados, será necessário ter a lista de médicos.
            $medicosAll = Medico::listAll();

            //Aqui é formado um array com os indices de todos os médicos.
            $allidsMedico = $this->getNoRepeatFieldFrom($medicosAll, 'id');

            //$orderMedicosSemH guardará a ordem que deve aparecer o Id dos médicos que não tem horário registrado.
            //O principio para isso é:
            //Medico - Medico com HD - Medico com HND = Medico que não registrou horário
            //Retirando os que tem horários disponíveis.
            $orderMedicosSemH = array_diff($allidsMedico, $orderMedicosIdsD);

            //Retirando os que tem horários não disponiveis.
            $orderMedicosSemH = array_diff($orderMedicosSemH, $orderMedicosIdsND);

            //Não é necessário ver se é depois do presente poque não há nenhum horário registrado.
        ////////////////////////////////////////////////////////////////////////////
        
        
        //Montagem do array de ordenamento final

        $finalOrder = $orderMedicosIdsDAfterNow;
        $finalOrder = array_merge($finalOrder, $orderMedicosIdsCOAfterNow);
        $finalOrder = array_merge($finalOrder, $orderMedicosSemH);

        //print_r($allidsMedico);
        //print_r($orderMedicosIdsDAfterNow );
        //print_r($orderMedicosIdsCOAfterNow);
        //print_r($orderMedicosSemH);
        //print_r($finalOrder);

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





//Métodos que inspiraram o codigo acima
/*
    public function getIdsMedicoFromMedico($horarios)
    {
        $idmedicoapparition = Array();
        foreach($horarios as $horario)
        {
            $idmedicoapparition[] = $horario['id'];
        }

        $order = array_unique($idmedicoapparition);

        return $order;
    }
*/
/*
    public function getIdsMedicoFromHorario($horarios)
    {
        $idmedicoapparition = Array();
        foreach($horarios as $horario)
        {
            $idmedicoapparition[] = $horario['id_medico'];
        }

        $order = array_unique($idmedicoapparition);

        return $order;
    }
*/
/*
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
*/
}

?>