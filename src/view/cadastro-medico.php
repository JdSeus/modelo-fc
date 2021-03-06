<?php

    if (isset($_POST['erro']))
    {
        $erro = $_POST['erro'];
    }
    else
    {
        $erro = 0;
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
        <nav class="menu">
            <div>
                <a href="cadastro-medico"><button>Cadastro de Medico</button></a>
            </div>
        </nav>

        <main>
            <div>
                <form class="criar-editar" action="cadastro-medico-post" method="post">
                    <h1>Cadastro de médico</h1>
                    <div>
                        <label for="form-name">Nome</label>
                        <input id="form-name" name="form-name" type="text" placeholder="Insira o nome do profissional" maxlength="255"
                            required minlength="6">
                    </div>
                    <div>
                        <label for="form-email">E-mail</label>
                        <input id="form-email" name="form-email" type="email" placeholder="exemplo@dominio.com.br" maxlength="255"
                            required minlength="6">
                    </div>
                    <div>
                        <label for=" form-password">Senha</label>
                        <input id="form-password" name="form-password" type="password" placeholder="Escolha uma senha forte e segura"
                            maxlength="255" required minlength="6">
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
                        <button type="submit">Realizar Cadastro</button>
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