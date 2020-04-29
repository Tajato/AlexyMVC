<?php

// Load Config

require_once 'config/config.php';

/* Load libraries

require_once 'libraries/Controller.php';
require_once 'libraries/Core.php';
require_once 'libraries/Database.php';
*/
/* They're going to be times when you have to load about 20 libraries and your code will look repeatitive
to offset this, we can use an autoloader found below. 
The require_once for each library wouldn't be needed anymore, since we using the autoloader,
the autoloader, is used from the url to access the page you want to, so you type the class name and it gets there
*/

// Auto Load Libraries

spl_autoload_register(function($className)
{
    require_once 'libraries/'. $className . '.php';
});