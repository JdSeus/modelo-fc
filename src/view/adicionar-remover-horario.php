<?php

    $id_medico = $_POST['id_medico'];


    $medico = new Medico();
    $medico->getMedico($id_medico);

    $horarios = Horario::listAllFromMedico($id_medico);


?>

<!DOCTYPE html>
<html>

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
            <div>
                <form class=form-left action="adicionar-horario-post" method="POST">
                    <h1>Adicionar Horários</h1>
                    <div>
                        <label for="form-name">Nome</label>
                        <input id="form-name" name="form-name" readonly="readonly" type="text" value="<?php echo $medico->getnome(); ?>" maxlength="255"
                            required minlength="6">
                    </div>
                    <div>
                        <label for="form-horario">Data e Hora</label>
                        <input id="form-horario" name="form-horario" type="datetime-local" placeholder="dd-mm-yyyy      hh:mm" maxlength="255"
                            required minlength="6">
                    </div>
                    <div>
                        <input id="id_medico" name="id_medico" type="hidden" value=<?php echo $medico->getid() ?>>
                        <button type="submit">Adicionar Horário</button>
                    </div>
                    <div>
                        <a href="index.php">Voltar para a Página Inicial</a>
                    </div>
                </form>
            </div>

            <div class="horarios-cadastrados">
                <div class="horarios-configurados">
                    <ul>
                    <h1>Horarios Configurados</h1>
                        <?php
                        foreach($horarios as $horario)
                        {
                        ?>
                            <li>
                                <div>
                                    <form class="lista-horarios" action="remover-horario-post" method="POST">
                                        <input name="id_horario" type="hidden" value=<?php echo $horario["id"];  ?>></input>
                                        <input name="id_medico" type="hidden" value=<?php echo $horario["id_medico"];  ?>></input>
                                        <div>
                                            <p><?php echo formatarStringData(($horario["data_horario"])); ?></p>
                                            <?php
                                            if ($horario["horario_agendado"] == "0")
                                            {
                                                ?>
                                                    <button type="submit">Remover</button>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </form>
                                </div>
                            </li>
                        <?php
                        //Fim do foreach
                        };
                        ?>
                    </ul>
                </div>
            </div>
    </div>

    </main>


    </div>


<?php
    getJavaScript();
?>
</body>

</html>