<?php

class Controller {

	//Classe das quais os outros controllers extendem.

    public static function CreateView($viewName) {
        require("view/$viewName.php");
    }

}

?>