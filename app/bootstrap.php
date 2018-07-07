<?php
// Load Config
require_once 'config/config.php';

# Load Libraries | old way
//require_once 'lib/Core.php';
//require_once 'lib/Controller.php';
//require_once 'lib/Database.php';

# Autoload Core Libraries | new way
# this is effective if we are to create more
# libraries in the future
spl_autoload_register(function($className){
    require_once 'lib/' . $className . '.php';
});
?>
