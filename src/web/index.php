<?php
    use Framework\WebApplication;
    use Katzgrau\KLogger\Logger;

    define('DS',DIRECTORY_SEPARATOR);
    define('ROOT_PATH', dirname(__DIR__));
    //define('ROOT_URL','http://seb.local');
    define('DEBUG', true);

    include ROOT_PATH. '/vendors/autoload.php';
    $config = include ROOT_PATH.'/conf/config.php';


    $GLOBALS['logger'] = new Logger(ROOT_PATH.'/logs');
    if(DEBUG) $GLOBALS['logger']->debug(__FILE__." - Lancement de l'application");

    WebApplication::getApplication()->run($config);


