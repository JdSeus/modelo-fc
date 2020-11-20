<?php

?>

<!DOCTYPE html>
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
                <button>Cadastro de Médico</button>
            </div>
        </nav>

        <main>
            <div>
                <form action="cadastro-medico-post" method="post">
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
                    <div>
                        <button type="submit">Realizar Cadastro</button>
                    </div>
                    <div>
                        <a href="#">Voltar para a Página Inicial</a>
                    </div>
                </form>
            </div>
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