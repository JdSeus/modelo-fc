<?php

class Route {
    
	//A base para o funcionamento dessa classe é o redirecionamento feito no arquivo .htaccess que redireciona todas as urls para o index.php

    //Parâmetro que guarda as rotas válidas.
    public static $validRoutes = array();

    //Método que salva a rota no parâmetro de rotas válidas.
    public static function set($route, $function) 
    {
        self::$validRoutes[] = $route;

        if ($_GET['url'] == $route) {
            $function->__invoke();
        }
    }

    //Método que realiza um Post dos parâmetros passados por ele e redireciona para a rota passada.
    public static function postAndGo($route, $params)
    {
        ?>
        <form id="postAndGo" action="<?php echo $route ?>" method="post">
        <?php
        foreach ($params as $key => $value)
        {
        ?>
            <input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>"></input>
        <?php
        }
        ?>
        </form>
        <script type="text/javascript">

        window.onload = function () { 
            document.forms['postAndGo'].submit(); 
        } 

        </script>
        <?php
    }
    
}

?>