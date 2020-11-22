<?php

    print_r($_POST);
    $id_medico = $_POST['id_medico'];
    echo "<br>";
    echo $id_medico;

    $medico = new Medico();
    $medico->getMedico($id_medico);

    $horarios = Horario_medico::listAll($id_medico);

    echo "<br>";
    print_r($horarios);
    echo "<br>";

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
                <button>Cadastro de Médico</button>
            </div>
        </nav>

        <main>
            <div>
                <form class=form-left action="adicionar-remover-horario-post" method="POST">
                    <h1>Adicionar Horários</h1>
                    <div>
                        <label for="form-name">Nome</label>
                        <input id="form-name" name="form-name" readonly="readonly" type="text" value="<?php echo $medico->getnome(); ?>" maxlength="255"
                            required minlength="6">
                    </div>
                    <div>
                        <label for="form-email">Data e Hora</label>
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
                <h1>Horarios Configurados</h1>
                <div class="horarios-configurados">
                    <ul>
                        <?php
                      //  foreach($horarios as $horario)
                        //{
                        ?>
                            <li>
                                <p><?php //echo $horario->getdata_horario() ?></p>
                                <a href="#">Remover</a>
                            </li>
                        <?php
                       // };
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