<?php

// START SESSIONS
session_start();

// ERROR REPORTING
error_reporting(E_ALL);
ini_set("display_errors", 1);

// NASTAVENI CEST
define('KONTROLERY', 'application/core/controllers/');
define('MODELY', 'application/core/models/');
define('POHLEDY', 'application/core/views/pages/');
define('SABLONA', 'application/core/views/');

// URL PROJEKTU
/*
define('WEB_DOMAIN', 'http://quatrofin.cz/');
define('PODSLOZKA', '');
 */
define('WEB_DOMAIN', 'http://localhost/WEB/');
define('PODSLOZKA', 'WEB/');

/*
  define('DB_TYPE', 'mysql');
  define('DB_HOST', 'students.kiv.zcu.cz');
  define('DB_DATABASE_NAME', 'db1_vyuka');
  define('DB_USER_LOGIN', 'db1_vyuka');
  define('DB_USER_PASSWORD', 'db1_vyuka');
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_DATABASE_NAME', 'db1');
define('DB_USER_LOGIN', 'root');
define('DB_USER_PASSWORD', 'root');

// DEFINICE TABULEK
define('TABLE_PREFIX', '');
define('UZIVATEL', TABLE_PREFIX.'uzivatel');
define('DISKUZE', TABLE_PREFIX.'diskuze');
define('ODPOVED', TABLE_PREFIX.'odpoved');

// NACTE TWIG
require_once 'application/packages/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

// NACTE FUNKCE
require 'config/functions.inc.php';

// NACTE TRIDY
spl_autoload_register(function($trida) {
    if (preg_match('#Db#', $trida)) {
        require_once(MODELY . $trida . ".class.php");
    } 
    else {
        require_once(KONTROLERY . $trida . ".class.php");
    }
});

?>