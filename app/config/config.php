<?php

// Database Parameters

define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PASS','mone');
define('DB_NAME','amvc');

// App Root
define('APPROOT',dirname(dirname(__FILE__)));

// used define to create a constant variable. APPROOT is the variable name.
// used too dirname to get the exact directory name we want, so it ended at app.

// URL Root

define('URLROOT', 'http://localhost/alexymvc/');

// Site Name

define('SITENAME', 'AlexyMVC');