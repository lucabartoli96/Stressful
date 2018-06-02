<?php 
require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');

session_start();

if( !Connection::set() ) {
    $db = $config['db'];
    Connection::set($db['host'], $db['username'], $db['password'], $db['database']);
}

?>