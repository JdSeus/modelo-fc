<?php

    $medicos = $_REQUEST['medicos'];
?>

<!--<!DOCTYPE html> -->
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="res/css/bootstrap.min.css" type="text/css">
    <!-- Meu Estilo -->
    <link rel="stylesheet" href="res/css/facilconsulta.css" type="text/css">
</head>

<body>
    <div class="container-fluid">
        <nav>
            <div>
                <a href="cadastro-medico"><button>Cadastro de Medico</button></a>
            </div>
        </nav>

        <main>
            <!-- LEITURA DO ARRAY DE MÉDICO -->
            <?php foreach($medicos as $medico): ?>

            <div class="lista-medicos">
                <div class="infomedico">
                    <div>
                        <h1><?php echo $medico['nome']; ?></h1>
                    </div>
                    <div class="infobuttons">
                        <a><button>Configurar Horários</button></a>
                        <a href="view/editar-cadastro-medico.html"><button>Editar Cadastro <?php echo $medico['id'] ?></button></a>
                    </div>
                </div>
                <div class="horarios">
                    <ul>
                        <li>
                            <button>16/11/2020 às 07:00</button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- FIM DA LEITURA DO ARRAY DE MÉDICO -->
            <?php endforeach; ?>

        </main>


    </div>

    <!-- FIM DO CÓDIGO -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="res/js/jquery-3.5.1.js"></script>
    <script src="res/js/bootstrap.js"></script>

    <!-- Meu Código -->
    <script src="res/js/myjs.js" type="text/javascript"></script>

</body>

</html>