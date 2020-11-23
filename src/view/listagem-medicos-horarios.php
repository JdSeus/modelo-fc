<?php

$medicos = $_REQUEST['medicos'];
$horarios = $_REQUEST['horarios'];
$order = $_REQUEST['order'];

//print_r($medicos);
//print_r($horarios);

    
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
            <!-- COMEÇO DO FOREACH DE MEDICO -->
            <?php 
            foreach($order as $key):
                $medico = new Medico();
                $medico->getMedico($key);
                $horarios = Horario::listAllFromMedico($medico->getid());
            ?>

            <div class="lista-medicos">
                <div class="infomedico">
                    <div>
                        <h1><?php echo $medico->getnome(); ?></h1>
                    </div>
                    <div>
    
                        <form class="infobutton" action="editar-cadastro-medico" method="POST">
                            <input type="hidden" name="id" value= "<?php echo $medico->getid(); ?>"></input>
                            <button>Editar Cadastro</button>
                        </form>

                            
                        <form class="infobutton" action="adicionar-remover-horario" method="POST">
                            <input type="hidden" name="id_medico" value= "<?php echo $medico->getid(); ?>"></input>
                            <button>Configurar Horários</button>
                        </form>

                    </div>
                </div>
                <div class="horarios">
                    <ul>
                    <?php
                        //COMEÇO DO FOREACH DE HORARIO
                        foreach($horarios as $horario):
                        ?>
                            <li>
                                <form action="change-horario-post" method="POST">
                                    <input type="hidden" name="horario_id" value="<?php echo $horario['id']; ?>" >
                                    <button class="
                                    <?php
                                        if ($horario['horario_agendado'] == 0)
                                        {
                                            echo "disponivel";
                                        }
                                        else
                                        {
                                            echo "marcado";
                                        }
                                    ?>
                                    " type="submit"><?php echo formatarStringData(($horario["data_horario"])); ?></button>
                                </form>
                            </li>                          
                        <?php
                        endforeach;
                        //FIM DO FOREACH DE HORARIO
                        ?>
                    </ul>
                </div>
            </div>

            <!-- FIM DO FOREACH DE MEDICO -->
            <?php endforeach; ?>

        </main>

    </div>
<?php
    getJavaScript();
?>

</body>

</html>