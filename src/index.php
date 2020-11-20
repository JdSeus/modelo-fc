<?php

spl_autoload_register(function ($class_name) {
  if (file_exists('model/'. $class_name . '.php')) {
      require_once('model/'. $class_name . '.php');

  } else if (file_exists('controller/'. $class_name . '.php')) {
      require_once('controller/'. $class_name . '.php');

  } else if (file_exists('view/'. $class_name . '.php')) {
    require_once('view/'. $class_name . '.php');

}
});

require_once("functions.php");
require_once("Routes.php");

?>