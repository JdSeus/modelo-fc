<?php

    $medico = $_REQUEST['medico'];
    //print_r($medico);

    if (isset($_POST['erro']))
    {
        $erro = $_POST['erro'];
        echo $erro;
        echo "<br>";
    }
    else
    {
        $erro = 0;
        echo "sem erros";
        echo "<br>";
    }
?>

<!DOCTYPE html>
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
                <button>Cadastro de Médico</button>
            </div>
        </nav>

        <main>
            <div>
                <form action="editar-cadastro-medico-post" method="post">
                    <h1>Editar médico</h1>
                    <div>
                        <label for="form-name">Nome</label>
                        <input id="form-name" name="form-name" type="text" placeholder="Insira o nome do profissional" value="<?php echo $medico->getnome() ?>"  maxlength="255"
                            required minlength="6">
                    </div>
                    <div>
                        <label for="form-past-password">Senha Antiga</label>
                        <input id="form-past-password" name="form-past-password" type="password" placeholder="Insira a senha antiga"
                            maxlength="255" required minlength="6">
                    </div>
                    <div>
                        <label for=" form-new-password">Nova Senha</label>
                        <input id="form-new-password" name="form-new-password" type="password"
                            placeholder="Escolha uma nova senha forte e segura" maxlength="255" required minlength="6">
                    </div>

                    <?php
                    if ($erro !== 0) {
                        ?>
                        <div class="message">
                        <p><?php echo $erro ?></p>
                        </div>
                        <?php
                    }
                    ?>

                    <div>
                        <input id="id" name="id" type="hidden" value=<?php echo $medico->getid() ?>>
                        <button type="submit">Atualizar Cadastro</button>
                    </div>
                    <div>
                        <a href="index.php">Voltar para a Página Inicial</a>
                    </div>
                </form>
            </div>
        </main>


    </div>

<?php
    getJavaScript();
?>
</body>

</html>