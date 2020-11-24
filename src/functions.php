<?php

    function generatePassword(string $password) {

        return md5($password);
        
    }

    function formatarDatetimeData($Data) {
        $date = $Data;

        $string = $date->format('d-m-Y H:i');

        $string = str_replace('-','/', $string);
        return $string;
    }
    

    function formatarStringData($string) {

        $stringArray = explode ( " " , $string);
        
        $stringArray[0] = explode("-", $stringArray[0]);

        $stringArray[1] = explode(":", $stringArray[1]);

        $string = $stringArray[0][2]. '/' . $stringArray[0][1]. '/' . $stringArray[0][0] . ' às ' . $stringArray[1][0] . ':' . $stringArray[1][1];

        return $string;
    }

?>