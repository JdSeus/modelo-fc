<?php

class Route {
    
    public static $validRoutes = array();

    public static function set($route, $function) 
    {
        self::$validRoutes[] = $route;

        if ($_GET['url'] == $route) {
            $function->__invoke();
        }
    }

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