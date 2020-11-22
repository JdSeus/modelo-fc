<?php

    $medicos = $_REQUEST['medicos'];
?>

<!--<!DOCTYPE html> -->
<html lang="pt-br">

<head>
<?php 
    getMetaAndStyle();
?>
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
                    <div>
    
                        <form class="infobutton" action="editar-cadastro-medico" method="POST">
                            <input type="hidden" name="id" value= "<?php echo $medico["id"]; ?>"></input>
                            <button>Editar Cadastro</button>
                        </form>

                            
                        <form class="infobutton" action="adicionar-remover-horario" method="POST">
                            <input type="hidden" name="id_medico" value= "<?php echo $medico["id"]; ?>"></input>
                            <button>Configurar Horários</button>
                        </form>

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
<?php
    getJavaScript();
?>

</body>

</html>