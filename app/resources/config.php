
<?php
/*
    To include config file:
    
    <?php require_once("/var/www/html/Stressful/resources/config.php"); ?>
    
    Other infos i didn't want to add to config file (basically db credentials), are defined in "config_local.php", specified in the ".gitignore"

*/
require_once("config_local.php");

$config = array(
    "paths" => array(
        "resources" => "/Stressful/resources"
    ),
    "info" => array(
        "topbar" => array('Home', 'Career', 'Profile'),
    )
);

$config = array_merge($config, $config_local);
 

defined("PUBLIC_HTML_PATH")
    or define("PUBLIC_HTML_PATH", "http://localhost/Stressful/public_html");

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));

defined("FRAMEWORK_PATH")
    or define("FRAMEWORK_PATH", '/Stressful/resources/library');
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
 

ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 
?>