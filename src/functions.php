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

        $string = $stringArray[0][2]. '/' . $stringArray[0][1]. '/' . $stringArray[0][0] . ' ' . $stringArray[1][0] . ':' . $stringArray[1][1];

        return $string;
    }

    function getMetaAndStyle() {
        ?>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="res/css/bootstrap.min.css" type="text/css">
        <!-- Meu Estilo -->
        <link rel="stylesheet" href="res/css/facilconsulta.css" type="text/css">

        <?php
    }

    function getJavaScript() {
    ?>
    <!-- FIM DO CÓDIGO -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="res/js/jquery-3.5.1.js"></script>
    <script src="res/js/bootstrap.js"></script>

    <!-- Meu Código -->
    <script src="res/js/myjs.js" type="text/javascript"></script>

    <?php
    }

?>