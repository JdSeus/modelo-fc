<?php
/*
* É recomendado que a configuração da URL base, caso necessário, seja nesse arquivo.
* Veja o exemplo:
*/

//define("URL", "http://localhost/modelo-teste-facilconsulta.com.br/src/");

//Configuração do Fuso Horario
date_default_timezone_set('America/Sao_Paulo');

//Função utilizada no Template para facilitar o requerimento da folha de estilo.
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

//Função utilizada no Template para facilitar o requerimento dos códigos Javascript
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

/*
* Exemplo de utilização da URL base no carregamento de arquivo .css:
* <link rel="stylesheet" type="text/css" href="<?php echo URL;?>model/css/style.css">
*/
