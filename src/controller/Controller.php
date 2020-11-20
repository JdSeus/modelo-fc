<?php

class Controller {

    public static function CreateView($viewName) {
        require("view/$viewName.php");
    }

}

?>